    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Users') }}
            </h2>
        </x-slot>

        <div class="py-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <x-table>
                            <x-slot name="header">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th> <!-- Kolom baru untuk menampilkan role -->
                                    <th>Created At</th>
                                </tr>
                            </x-slot>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @foreach ($user->roles as $role) <!-- Menampilkan role pengguna -->
                                            <span class="inline-block px-2 py-1 text-xs font-semibold text-green-800 bg-green-200 rounded-full">{{ $role->name }}</span>
                                        @endforeach
                                    </td>
                                    <td>{{ $user->created_at->format('d-m-Y H:i') }}</td>
                                </tr>
                            @endforeach
                        </x-table>

                        <!-- Pagination -->
                        <div class="mt-6">
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>

