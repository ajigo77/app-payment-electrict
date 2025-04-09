<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('status-title', 'Error')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 flex items-center justify-center min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-xl mx-auto bg-white shadow-lg rounded-2xl overflow-hidden">
            <div class="p-6 md:p-10 text-center">
                <div class="mb-6 md:mb-8">
                    <img src="@yield('illustration-src')" alt="@yield('status-title')"
                        class="mx-auto w-1/2 max-w-xs h-auto object-contain" />
                </div>

                <div class="space-y-4">
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">
                        @yield('status-heading')
                    </h1>

                    <p class="text-gray-600 text-sm md:text-base mb-6">
                        @yield('status-message')
                    </p>

                    <div class="flex justify-center space-x-4">
                        @yield('action-buttons')
                    </div>
                </div>
            </div>
        </div>

        @if (config('app.debug'))
            <div class="max-w-xl mx-auto mt-6 bg-red-50 border border-red-200 rounded-lg p-4 text-sm text-red-700">
                @yield('debug-info')
            </div>
        @endif
    </div>
</body>

</html>
