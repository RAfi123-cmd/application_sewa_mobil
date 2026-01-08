<x-app-layout>
    <x-slot name="title">Admin</x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="#!" onclick="window.history.go(-1); return false;">
                ←
            </a>
            {!! __('item &raquo; Buat') !!}
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

                <form action="{{ route('admin.items.store') }}" class="w-full" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="flex flex-wrap px-3 mt-4 mb-6 -mx-3">
                        <div class="w-full">
                            <label for="grid-last-name" class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase">
                                Nama*
                            </label>
                            <input type="text" name="name" id="grid-last-name" value="{{ old('name') }}"
                                class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none
                                focus:bg-white focus:border-gray-500" placeholder="Nama" required>
                            <div class="mt-2 text-sm text-gray-500">
                                Nama items. contoh: item 1, item 2, item 3, dsb. Wajib diisi. Maksimal 255 karakter.
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-wrap px-3 mt-4 mb-6 -mx-3">
                        <div class="w-full">
                            <label for="grid-last-name" class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase">
                                Brand*
                            </label>
                            <select name="brand_id" class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none
                                focus:bg-white focus:border-gray-500" required>
                                <option value="">Pilih Brand</option>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                                        {{ $brand->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="mt-2 text-sm text-gray-500">
                                Brand item. contoh: Porsche. Wajib diisi.
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-wrap px-3 mt-4 mb-6 -mx-3">
                        <div class="w-full">
                            <label for="grid-last-name" class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase">
                                Type*
                            </label>
                            <select name="type_id" class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none
                                focus:bg-white focus:border-gray-500" required>
                                <option value="">Pilih Type</option>
                                @foreach ($types as $type)
                                    <option value="{{ $type->id }}" {{ old('type_id') == $type->id ? 'selected' : '' }}>
                                        {{ $type->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="mt-2 text-sm text-gray-500">
                                Brand item. contoh: Electric Car. Wajib diisi.
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-wrap px-3 mt-4 mb-6 -mx-3">
                        <div class="w-full">
                            <label for="grid-last-name" class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase">
                                Fitur*
                            </label>
                            <input type="text" name="features" id="grid-last-name" value="{{ old('features') }}"
                                class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none
                                focus:bg-white focus:border-gray-500" placeholder="Nama" required>
                            <div class="mt-2 text-sm text-gray-500">
                                Fitur items. contoh: fitur 1, fitur 2, fitur 3, dsb. Wajib diisi. Dipisahkan dengan koma (,).
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-wrap px-3 mt-4 mb-6 -mx-3">
                        <div class="w-full">
                            <label for="grid-last-name" class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase">
                                Foto
                            </label>
                            <input type="file" name="photos[]" id="grid-last-name" value="{{ old('photos') }}"
                                class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none
                                focus:bg-white focus:border-gray-500" multiple
                                accept="image/png, image/jpeg, image/jpg, image/webp">
                            <div class="mt-2 text-sm text-gray-500">
                                Foto Item. Lebih dari satu foto dapat diupload. Opsional.
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 px-0 mt-4 mb-6">
                        <div class="min-w-0">
                            <label for="grid-last-name" class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase">
                                Harga*
                            </label>
                            <input type="number" name="price" id="grid-last-name" value="{{ old('price') }}"
                                class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none
                                focus:bg-white focus:border-gray-500" placeholder="Harga" required>
                            <div class="mt-2 text-sm text-gray-500">
                                Harga Item. Angka. Contoh: 100000. Wajib diisi.
                            </div>
                        </div>
                        <div class="min-w-0">
                            <label for="grid-last-name" class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase">
                                Rating
                            </label>
                            <input type="number" name="star" id="grid-last-name" value="{{ old('star') }}"
                                class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none
                                focus:bg-white focus:border-gray-500" placeholder="Rating" min="1" max="5" step=".01">
                            <div class="mt-2 text-sm text-gray-500">
                                Rating Item. Angka. Contoh: 5. Opsional.
                            </div>
                        </div>
                        <div class="min-w-0">
                            <label for="grid-last-name" class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase">
                                Review
                            </label>
                            <input type="number" name="review" id="grid-last-name" value="{{ old('review') }}"
                                class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none
                                focus:bg-white focus:border-gray-500" placeholder="Review">
                            <div class="mt-2 text-sm text-gray-500">
                                Review Item. Angka. Opsional.
                            </div>
                        </div>
                    </div>


                    
                    <div class="flex flex-wrap mb-6 -mx-3">
                        <div class="w-full px-3 text-right">
                            <button type="submit" class="px-4 py-2 font-bold text-white bg-green-500 rounded shadow-lg hover:bg-green-700">
                                Simpan item
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    
</x-app-layout>