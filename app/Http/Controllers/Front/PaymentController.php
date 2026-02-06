<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(Request $request, $bookingId)
    {
        $booking = Booking::with('item.brand', 'item.type')->findOrFail($bookingId);
        
        return view('payment', [
            'booking' => $booking
        ]);
    }

    // public function detail(Request $request, $bookingId)
    // {

    // }

    public function update(Request $request, $bookingId)
    {
        // return $request->all();

        // Load booking data
        $booking = Booking::findOrFail($bookingId);

        // Set Payment Method
        $booking->payment_method = $request->payment_method;

        // Handle midtrans payment_method
        if($request->payment_method == 'midtrans'){
            // Set your Merchant Server Key
            \Midtrans\Config::$serverKey = config('services.midtrans.serverKey');
            // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
            \Midtrans\Config::$isProduction = config('services.midtrans.isProduction');
            // Set sanitization on (default)
            \Midtrans\Config::$isSanitized = config('services.midtrans.isSanitized');
            // Set 3DS transaction for credit card to true
            \Midtrans\Config::$is3ds = config('services.midtrans.is3ds');

            // Get USD to IDR rate from https:://www.exchangerate-api.com/ using Guzzle
            $client = new \GuzzleHttp\Client();
            $response = $client->request('GET', 'https://api.exchangerate-api.com/v4/latest/USD');
            $body = $response->getBody();
            $rate = json_decode($body)->rates->IDR;

            // Convert to IDR
            $totalPrice = $booking->total_price * $rate;

            // Create Midtrans Params
            // Doc : https://api-docs.midtrans.com/#change-a-credit-card
            // untuk melihat complete request midtrans : https://docs.midtrans.com/reference/request-body-json-parameter
            $midtransParams = [
                'transaction_details' => [
                    'order_id' => "TESTING-" . $booking->id,
                    'gross_amount' => (int) $totalPrice,
                ],
                'customer_detail' => [
                    'first_name' => $booking->customer_name,
                    'email' => $booking->customer_email,
                ],
                'enable_payments' => ['gopay', 'bank_transfer'],
            ];

            // Get Snap payment Page url
            $paymentUrl = \Midtrans\Snap::createTransaction($midtransParams)->redirect_url;

            // save payment url to booking
            $booking->payment_url = $paymentUrl;

            // save booking
            $booking->save();

            // Redirect to payment url
            return redirect($paymentUrl);
        }
    
    }

    public function success(Request  $request)
    {
        return view('success');
    }
}
