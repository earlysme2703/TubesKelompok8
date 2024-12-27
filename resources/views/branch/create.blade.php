@role('Admin')
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Tambah Cabang') }}
            </h2>
        </x-slot>

        <div class="py-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <form action="{{ route('branches.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-4">
                                <label for="name" class="block text-sm font-medium text-gray-700">Nama Cabang</label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            </div>

                            <div class="mb-4">
                                <label for="location" class="block text-sm font-medium text-gray-700">Lokasi</label>
                                <input type="text" name="location" id="location" value="{{ old('location') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            </div>

                            <div class="mb-4">
                                <label for="photo" class="block text-sm font-medium text-gray-700">Foto</label>
                                <input type="file" name="photo" id="photo" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            </div>

                            <div class="mb-4">
                                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                                <select name="status" id="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                    <option value="1">Aktif</option>
                                    <option value="0">Non-Aktif</option>
                                </select>
                            </div>

                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">Simpan Cabang</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
@else
    <p class="text-center text-red-600">Anda tidak memiliki izin untuk mengakses halaman ini.</p>
@endrole
