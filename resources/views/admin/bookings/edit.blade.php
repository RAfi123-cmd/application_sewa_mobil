<x-app-layout>
    <x-slot name="title">Admin</x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="#!" onclick="window.history.go(-1); return false;">
                ←
            </a>
            booking &raquo; Sutting &raquo; #{{ $booking->id }} {{ $booking->name }} 
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div>
                @if ($errors->any())
                    <div class="mb-5" role="alert">
                        <div class="px-4 py-2 font-bold text-white bg-red-500 rounded-t">
                            Ada Kesalahan!
                        </div>
                        <div class="px-4 py-3 text-red-700 bg-red-100 border border-t-0 border-red-400 rounded-b">
                            <p>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>                                        
                                    @endforeach
                                </ul>
                            </p>
                        </div>
                    </div> 
                @endif

                <form action="{{ route('admin.bookings.update', $booking->id) }}" class="w-full" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="flex flex-wrap px-3 mt-4 mb-6 -mx-3">
                        <div class="w-full">
                            <label for="grid-last-name" class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase">
                                Nama*
                            </label>
                            <input type="text" name="name" id="grid-last-name" value="{{ old('name') ?? $booking->name }}"
                                class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none
                                focus:bg-white focus:border-gray-500" placeholder="Nama" required>
                            <div class="mt-2 text-sm text-gray-500">
                                Nama bookings. contoh: Rafi'ul Huda.
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-wrap px-3 mt-4 mb-6 -mx-3">
                        <div class="w-full">
                            <label for="grid-last-name" class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase">
                                Alamat*
                            </label>
                            <input type="text" name="address" id="grid-last-address" value="{{ old('address') ?? $booking->address }}"
                                class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none
                                focus:bg-white focus:border-gray-500" placeholder="Alamat" required>
                            <div class="mt-2 text-sm text-gray-500">
                                Alamat bookings. contoh: Jl.Perumahan.
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-wrap px-3 mt-4 mb-6 -mx-3">
                        <div class="w-full">
                            <label for="grid-last-name" class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase">
                                Kota*
                            </label>
                            <input type="text" name="city" id="grid-last-city" value="{{ old('city') ?? $booking->city }}"
                                class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none
                                focus:bg-white focus:border-gray-500" placeholder="Kota" required>
                            <div class="mt-2 text-sm text-gray-500">
                                Kota bookings. contoh: Tangerang.
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-wrap px-3 mt-4 mb-6 -mx-3">
                        <div class="w-full">
                            <label for="grid-last-name" class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase">
                                Kode Pos*
                            </label>
                            <input type="text" name="zip" id="grid-last-zip" value="{{ old('zip') ?? $booking->zip }}"
                                class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none
                                focus:bg-white focus:border-gray-500" placeholder="Kode Pos" required>
                            <div class="mt-2 text-sm text-gray-500">
                                Kode Pos bookings. contoh: 40152.
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-wrap px-3 mt-4 mb-6 -mx-3">
                        <div class="w-full">
                            <label for="grid-last-name" class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase">
                                Status Booking
                            </label>
                            <select name="status" class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none
                                focus:bg-white focus:border-gray-500">
                                <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="done" {{ $booking->status == 'done' ? 'selected' : '' }}>Done</option>
                            </select>
                            <div class="mt-2 text-sm text-gray-500">
                                Status Booking. contoh: Pending.
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-wrap px-3 mt-4 mb-6 -mx-3">
                        <div class="w-full">
                            <label for="grid-last-name" class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase">
                                Status Pembayaran
                            </label>
                            <select name="payment_status" class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none
                                focus:bg-white focus:border-gray-500">
                                <option value="pending" {{ $booking->payment_status == 'pending' ? 'selected' : '' }}>PENDING</option>
                                <option value="success" {{ $booking->payment_status == 'success' ? 'selected' : '' }}>SUCCESS</option>
                                <option value="failed" {{ $booking->payment_status == 'failed' ? 'selected' : '' }}>FAILED</option>
                                <option value="expired" {{ $booking->payment_status == 'expired' ? 'selected' : '' }}>EXPIRED</option>
                            </select>
                            <div class="mt-2 text-sm text-gray-500">
                                Status Pembayaran. contoh: Pending.
                            </div>
                        </div>
                    </div>
                </div>    
                    <div class="flex flex-wrap mb-6 -mx-3">
                        <div class="w-full px-3 text-right">
                            <button type="submit" class="px-4 py-2 font-bold text-white bg-green-500 rounded shadow-lg hover:bg-green-700">
                                Simpan booking
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    
</x-app-layout>