<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">
    {{-- @include('client.components.navbar.navbar') --}}
    <div class="flex flex-col items-center justify-center min-h-screen px-6 py-8 mx-auto">
        <div class="w-full bg-white rounded-lg shadow-lg md:mt-0 sm:max-w-md xl:p-0">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl block text-center">
                    Login
                </h1>
                <form class="space-y-4 md:space-y-6" action="{{ route('auth.post.login') }}" method="post"
                    id="form">
                    @csrf
                    <div>
                        @if (Session::has('gagal'))
                            <div class="flex items-center p-4 mb-4 text-sm text-red-600 border border-red-300 rounded-lg bg-red-50"
                                role="alert">
                                <svg class="shrink-0 inline w-4 h-4 me-3" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                                </svg>
                                <div>
                                    {{ Session::get('gagal') }}
                                </div>
                            </div>
                        @endif()
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                    <input type="email" name="email" id="email"
                        class="bg-white border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 placeholder:opacity-50"
                        placeholder="Email">
                    @error('email')
                        <span class="text-red-600 text-xs md:text-sm">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="relative group">
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                    <input type="password" name="password" id="password" placeholder="Password"
                        class="bg-white border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 placeholder:opacity-50">
                    <button type="button"
                        class="absolute right-3 top-12 transform -translate-y-1/2 text-gray-400 hover:text-gray-600"
                        onclick="togglePassword()">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor"
                            class="w-5 h-5 group-focus-within:text-blue-600" id="eye-icon">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                        </svg>
                    </button>
                    @error('password')
                        <span class="text-red-600 text-xs md:text-sm">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <button type="submit"
                    class="w-full text-white bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center disabled:opacity-50 disabled:cursor-not-allowed">
                    Login
                </button>
                <p class="text-sm font-light text-gray-500 text-center">
                    Belum memiliki akun? <a href="#"
                        class="font-medium text-blue-600 hover:underline">Register</a>
                </p>
            </form>
        </div>
    </div>
</div>
<script>
    const form = document.getElementById('form');
    const submitButton = form.querySelector('button[type="submit"]');
    submitButton.disabled = true;

    form.addEventListener('keyup', function() {
        let isFormValid = true;
        for (let i = 0; i < form.elements.length; i++) {
            const element = form.elements[i];
            if (element.tagName === 'INPUT' && element.type !== 'hidden' && element.type !== 'submit') {
                if (!element.value.trim()) {
                    isFormValid = false;
                    break;
                }
            }
        }

        submitButton.disabled = !isFormValid;

        if (isFormValid) {
            submitButton.classList.remove('opacity-50', 'cursor-not-allowed');
            submitButton.classList.add('hover:bg-blue-700');
        } else {
            submitButton.classList.add('opacity-50', 'cursor-not-allowed');
            submitButton.classList.remove('hover:bg-blue-700');
        }
    });

    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eye-icon');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />`;
        } else {
            passwordInput.type = 'password';
            eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                `;
        }
    }
</script>
</body>

</html>
