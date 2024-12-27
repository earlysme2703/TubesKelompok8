<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Book') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-4">
                        <div class="space-x-2">
                            @role('Admin')
                                <x-primary-button tag="a" href="{{ route('book.create') }}">Tambah Data Buku</x-primary-button>
                                <x-primary-button tag="a" href="{{ route('book.print') }}">Print PDF</x-primary-button>
                                <x-primary-button tag="a" href="{{ route('book.export') }}" target="_blank">Export Excel</x-primary-button>
                                <x-primary-button x-data=""
                                    x-on:click.prevent="$dispatch('open-modal', 'import-book')">{{ __('Import Excel') }}</x-primary-button>
                            @endrole
                        </div>

                        <form 
                            id="bookshelf-filter-form"
                            method="GET" 
                            action="{{ route('book') }}" 
                            class="flex flex-col items-end space-y-2 w-1/3"
                        >
                            <select 
                                name="bookshelf_id" 
                                id="bookshelf_id" 
                                class="form-select mt-1 block w-full"
                                onchange="this.form.submit()"
                            >
                                <option value="">Semua Rak</option>
                                @foreach ($bookshelves as $bookshelf)
                                    <option 
                                        value="{{ $bookshelf->id }}" 
                                        {{ request('bookshelf_id') == $bookshelf->id ? 'selected' : '' }}
                                    >
                                        {{ $bookshelf->code }} - {{ $bookshelf->name }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                    </div>

                    <x-table>
                        <x-slot name="header">
                            <tr class="py-10">
                                <th scope="col">#</th>
                                <th scope="col">Judul</th>
                                <th scope="col">Penulis</th>
                                <th scope="col">Tahun</th>
                                <th scope="col">Penerbit</th>
                                <th scope="col">Kota</th>
                                <th scope="col">Cover</th>
                                <th scope="col">Kode Rak</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </x-slot>
                        @foreach ($books as $book)
                        <tr>
                            <td>{{ ($books->currentPage() - 1) * $books->perPage() + $loop->iteration }}</td>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->author }}</td>
                            <td>{{ $book->year }}</td>
                            <td>{{ $book->publisher }}</td>
                            <td>{{ $book->city }}</td>
                            <td>
                                <img 
                                    src="{{ asset('storage/cover_buku/' . $book->cover) }}" 
                                    alt="{{ $book->title }} Cover" 
                                    width="100" 
                                    class="object-cover"
                                />
                            </td>
                            <td>{{ $book->bookshelf->code }} - {{ $book->bookshelf->name }}</td>
                            <td>
                                @role('Admin') <!-- Akses untuk pustakawan -->
                                    <x-primary-button tag="a" href="{{ route('book.edit', $book->id) }}">Edit</x-primary-button>
                                    <x-danger-button x-data=""
                                        x-on:click.prevent="$dispatch('open-modal', 'confirm-book-deletion')"
                                        x-on:click="$dispatch('set-action', '{{ route('book.destroy', $book->id) }}')">
                                        {{ __('Delete') }}
                                    </x-danger-button>
                                @endrole
                            
                                @role('mahasiswa') <!-- Akses untuk mahasiswa -->
                                    <x-primary-button tag="button" disabled>Pinjam</x-primary-button>
                                    <x-primary-button tag="button" disabled>Kembalikan</x-primary-button>
                                @endrole
                            </td>
                        </tr>
                        @endforeach
                    </x-table>

                    <!-- Pagination -->
                    <div class="mt-6">
                        {{ $books->links() }}
                    </div>

                    <!-- Modals -->
                    <x-modal name="confirm-book-deletion" focusable maxWidth="xl">
                        <form method="post" x-bind:action="action" class="p-6">
                            @method('delete')
                            @csrf
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Apakah anda yakin akan menghapus data?') }}
                            </h2>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('Setelah proses dilaksanakan. Data akan dihilangkan secara permanen.') }}
                            </p>
                            <div class="mt-6 flex justify-end">
                                <x-secondary-button x-on:click="$dispatch('close')">
                                    {{ __('Cancel') }}
                                </x-secondary-button>
                                <x-danger-button class="ml-3">
                                    {{ __('Delete!!!') }}
                                </x-danger-button>
                            </div>
                        </form>
                    </x-modal>

                    <x-modal name="import-book" focusable maxWidth="xl">
                        <form method="post" action="{{ route('book.import') }}" class="p-6"
                            enctype="multipart/form-data">
                            @csrf
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Import Data Buku') }}
                            </h2>
                            <div class="max-w-xl">
                                <x-input-label for="cover" class="sr-only" value="File Import" />
                                <x-file-input id="cover" name="file" class="mt-1 block w-full" required />
                            </div>
                            <div class="mt-6 flex justify-end">
                                <x-secondary-button x-on:click="$dispatch('close')">
                                    {{ __('Batal') }}
                                </x-secondary-button>
                                <x-primary-button class="ml-3">
                                    {{ __('Upload') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </x-modal>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
