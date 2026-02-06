<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Notification;

class MidtransCallbackController extends Controller
{
    public function callback(){
        // set konfigurasi midtrans
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');

        // buat instance midtrans notification
        $notification = new Notification();

        // Assign ke variabel untuk memudahkan coding
        $status = $notification->transaction_status;
        $type = $notification->payment_type;
        $fraud = $notification->fraud_status;
        $orderId = $notification->order_id;

        // cari transaksi bedasarkan ID
        $booking = Booking::findOrFail($orderId);

        // Handle notification status midtrans
        if($status == 'capture') {
            if ($type == 'credit_card') {
                if ($fraud == 'challange') {
                    $booking->payment_status = 'pending';
                }else {
                    $booking->payment_status = 'success';
                }
            }
        }else if ($status == 'settlement'){
            $booking->payment_status = 'success';
        }else if ($status == 'pending') {
            $booking->payment_status = 'pending';
        }else if($status == 'deny'){
            $booking->payment_status = 'cancelled';
        }else if($status == 'expired') {
            $booking->payment_status = 'cancelled';
        }else if ($status == 'cancel'){
            $booking->payment_status = 'cancelled';
        }

        // Simpan transaksi
        $booking->save();
        
        // return Response
        return response()->json([
            'meta' => [
                'code' => 200,
                'message' => 'Midtrans Notification Success'
            ]
        ]);
    }
}
