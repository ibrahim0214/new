<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" href="https://rubrik-osce.stikes-notokusumo.ac.id/asset/images/logo/logo1.png" type="image/x-icon">
        <link rel="icon" media="(max-width: 640px)" href="https://rubrik-osce.stikes-notokusumo.ac.id/asset/images/logo/logo.png">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="{{ asset('asset/vendor/fontawesome/css/all.min.css') }}">

        <!-- CSS Toastr -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- Scripts -->
        <script src="{{ asset('asset/js/jquery-3.7.1.min.js') }}" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        {{-- <script src="https://cdn.tiny.cloud/1/2mo8o4qortnc1udbhim8mf9p5qoli5nyacbdpwph24zs3n7c/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script> --}}
        <script src="https://cdn.tiny.cloud/1/olhkjfx529aim17rpbe1etqvfwnwd0ir5kdwbnbdqi5my1n1/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

        <!-- Select2 -->
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <!-- JS Toastr -->
        <script src="{{ asset('asset/js/toastr.min.js') }}" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <!-- Tiny MCE -->
    <script src="https://cdn.tiny.cloud/1/2mo8o4qortnc1udbhim8mf9p5qoli5nyacbdpwph24zs3n7c/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div wire:offline class="absolute top-0 left-0 right-0 max-w-screen-2xl mx-auto text-center z-50 bg-orange-600 text-white py-2">
            Offline
        </div>
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            <livewire:layout.navigation-daisyui />

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>

        </div>
        <footer class="footer footer-center bg-base-300 text-base-content p-4">
            <aside>
              <p>Copyright © 2024 - All right reserved by Stikes Notokusumo Yogyakarta </p>
            </aside>
        </footer>

        {{-- <script src="./node_modules/preline/dist/preline.js"></script> --}}
        <script data-navigate-once>
            $(document).ready(function() {
                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": true,
                    "preventOpenDuplicates": true,
                    "onclick": null,
                    "showDuration": "1300",
                    "hideDuration": "1000",
                    "timeOut": "2000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                    }
            })

            window.addEventListener('success', event => {
                toastr.success(event.detail[0].message)
            })
            window.addEventListener('warning', event => {
                toastr.warning(event.detail[0].message)
            })
            window.addEventListener('error', event => {
                toastr.error(event.detail[0].message)
            })

            function inArray(needle,haystack)
            {
                var count=haystack.length;
                for(var i=0;i<count;i++)
                {
                    if(haystack[i]===needle){return true;}
                }
                return false;
            }
        </script>
    </body>
</html>
