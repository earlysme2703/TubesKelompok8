<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Selamat Datang, ".Auth()->user()->name." !") }}
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mt-4">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __( Auth()->user()->name. ", jangan lupa tugas mu banyak, kerjain dari sekarang.\n") }}
                    
                    <table>
                        <thead>
                            <tr>
                                <th style="text-align: left">Daftar Tugas</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>PWL: Tenggat 14 Desember Jam 13.00</td>
                            </tr>
                            <tr>
                                <td>TBO: Model</td>
                            </tr>
                            <tr>
                                <td>Mobile: Laporan dan Link YT (Selasa)</td>
                            </tr>
                            <tr>
                                <td>MPPL: PPT Kelompok</td>
                            </tr>
                            <tr>
                                <td>Praktikum PWL: Presentasi</td>
                            </tr>
                            <tr>
                                <td>TKTI: Revisi Laporan + PPT</td>
                            </tr>
                            <tr>
                                <td>MULMED: Tubes</td>
                            </tr>
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
