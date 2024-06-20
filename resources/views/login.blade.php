<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link href="/resources/css/style.css" rel="stylesheet">
</head>

<body
    class="bg-slate-900 m-auto bg-[url('https://flowbite.s3.amazonaws.com/docs/jumbotron/hero-pattern.svg')] dark:bg-[url('https://flowbite.s3.amazonaws.com/docs/jumbotron/hero-pattern-dark.svg')]">
    <section id="#">
        <div class="align-content-center px-4 mx-auto max-w-7xl sm:px-6 lg:px-8 mt-20">
            <div class="max-w-2xl mx-auto text-center">
                <h2 class="text-3xl font-bold leading-tight text-white sm:text-4xl lg:text-5xl">Selamat Datang Kembali!
                </h2>
                <p class="max-w-xl mx-auto mt-4 text-base leading-relaxed text-gray-600">Silahkan masuk ke akun anda</p>
            </div>
            <div class="max-w-md mx-auto mt-4 md:mt-8">
                <div
                    class="overflow-hidden bg-white rounded-md shadow-md bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg">
                    <div class="px-4 py-6 sm:px-8 sm:py-7">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="bg-red-200 rounded-md px-2 py-2 mb-2">
                                    @foreach ($errors->all() as $item)
                                        <li>{{ $item }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="" method="POST">
                            @csrf
                            <div class="space-y-5">
                                <!-- Logo and Title Section -->
                                <div class="text-center">
                                    <img src="/img/bkpm.png" alt="Logo" class="mx-auto w-30 h-20" />
                                    <!-- Add your logo path -->
                                    <h1 class="mt-4 text-2xl font-bold text-gray-500">Office Sentry</h1>
                                </div>

                                <!-- Email Field -->
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-400">Alamat
                                        email</label>
                                    <div class="mt-2.5 relative text-gray-400 focus-within:text-gray-600">
                                        <div
                                            class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                            </svg>
                                        </div>
                                        <input type="email" value="{{ old('email') }}" name="email"
                                            placeholder="Masukkan email anda"
                                            class="w-full py-4 pl-10 pr-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-slate-500 dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                                    </div>
                                </div>

                                <!-- Password Field -->
                                <div>
                                    <div class="flex items-center justify-between">
                                        <label for="password"
                                            class="block text-sm font-medium text-gray-400">Password</label>
                                        {{-- <a href="#" title="" class="text-sm font-medium text-orange-500 transition-all duration-200 hover:text-orange-600 focus:text-orange-600 hover:underline">Forgot password?</a> --}}
                                    </div>
                                    <div class="mt-2.5 relative text-gray-400 focus-within:text-gray-600">
                                        <div
                                            class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4" />
                                            </svg>
                                        </div>
                                        <input type="password" name="password" placeholder="Masukkan password anda"
                                            class="block w-full py-4 pl-10 pr-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-slate-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-slate-500 dark:focus:ring-slate-500 dark:focus:border-slate-500 w-full" />
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div>
                                    <button name="submit" type="submit"
                                        class="inline-flex items-center justify-center w-full px-4 py-4 text-base font-semibold text-white transition-all duration-200 bg-blue-600 border border-transparent rounded-md focus:outline-none hover:bg-blue-700 focus:bg-blue-700 mt-4">
                                        Login
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
