@role('Admin')
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Branches') }}
            </h2>
        </x-slot>

        <div class="py-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        @if(session('success'))
                            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
                                {{ session('success') }}
                            </div>
                        @endif

                        <a href="{{ route('branches.create') }}" class="inline-block px-4 py-2 bg-gray-800 text-white rounded-md mb-4 hover:bg-blue-600">
                            Tambah Cabang
                        </a>

                        <div class="overflow-x-auto">
                            <x-table>
                                <x-slot name="header">
                                    <tr>
                                        <th class="px-4 py-2">#</th>
                                        <th class="px-4 py-2">Nama Cabang</th>
                                        <th class="px-4 py-2">Lokasi</th>
                                        <th class="px-4 py-2">Foto</th>
                                        <th class="px-4 py-2">Status</th>
                                        <th class="px-4 py-2">Aksi</th>
                                    </tr>
                                </x-slot>
                                @foreach ($branches as $branch)
                                    <tr>
                                        <td class="px-4 py-2">{{ ($branches->currentPage() - 1) * $branches->perPage() + $loop->iteration }}</td>
                                        <td class="px-4 py-2">{{ $branch->name }}</td>
                                        <td class="px-4 py-2">{{ $branch->location }}</td>
                                        <td class="px-4 py-2">
                                            @if($branch->photo && file_exists(public_path('storage/' . $branch->photo)))
                                                <img src="{{ asset('storage/' . $branch->photo) }}" 
                                                     alt="{{ $branch->name }}" 
                                                     class="w-24 h-24 object-cover rounded"
                                                />
                                            @else
                                                <span class="text-gray-400">No image</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-2">
                                            @if($branch->status)
                                                <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-sm">Active</span>
                                            @else
                                                <span class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-sm">Inactive</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-2 space-x-2">
                                            <a href="{{ route('branches.update', $branch->id) }}" 
                                               class="inline-block px-3 py-1 bg-gray-800 text-white rounded-md hover:bg-yellow-600">
                                                Edit
                                            </a>
                                            <form action="{{ route('branches.destroy', $branch->id) }}" 
                                                  method="POST" 
                                                  class="inline" 
                                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus cabang ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="px-3 py-1 bg-red-500 text-white rounded-md hover:bg-red-600">
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </x-table>
                        </div>

                        <div class="mt-6">
                            {{ $branches->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
@else
    <div class="p-8">
        <p class="text-center text-red-600 font-semibold">Anda tidak memiliki izin untuk mengakses halaman ini.</p>
    </div>
@endrole