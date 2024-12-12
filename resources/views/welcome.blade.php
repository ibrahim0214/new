<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="{{ asset('asset/vendor/fontawesome/css/all.min.css') }}">

        <!-- CSS Toastr -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- Scripts -->
        <script src="{{ asset('asset/js/jquery-3.7.1.min.js') }}" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="https://cdn.tiny.cloud/1/2mo8o4qortnc1udbhim8mf9p5qoli5nyacbdpwph24zs3n7c/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

        <!-- Select2 -->
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <!-- JS Toastr -->
        <script src="{{ asset('asset/js/toastr.min.js') }}" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            <x-guest-navbar></x-guest-navbar>

            <!-- Page Content -->
            <main>
                <div class="py-16">
                    <div class="hero bg-base-200 min-h-screen">
                        <div class="hero-content flex-col lg:flex-row-reverse">
                            <img
                                src="{{ asset('asset/images/logo/logo1.png') }}"
                                class="max-w-sm rounded-lg" width="280px"/>
                            <div>
                            <h1 class="text-5xl font-bold">PENILAIAN OSCE BERSTANDAR NASIONAL</h1>
                            <p class="py-6">
                                Pelatihan Penguji dan Pelatih Pasien Standar OSCE (Objective Structured Clinical Examination), Metode evaluasi yang digunakan untuk menguji
                                kompetensi klinik mahasiswa atau profesional medis secara objektif.
                                <div>
                                    <x-app-info-button id="login">Get Started</x-app-info-button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </main>

        </div>
        <footer class="footer footer-center bg-base-300 text-base-content p-4">
            <aside>
              <p>Copyright © 2024 - All right reserved by Stikes Notokusumo</p>
            </aside>
        </footer>

        <script>
            $('#login').on('click', function() {
                location.href = '{{ route('login') }}';
            })
        </script>
    </body>
</html>

