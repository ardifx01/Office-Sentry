{{-- resources/views/create-office-boy.blade.php --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registrasi Akun Office Boy</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="/resources/css/style.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-success {
            animation: fadeIn 0.5s ease-out;
            /* Sesuaikan durasi dan fungsi timing sesuai kebutuhan */
        }
    </style>
</head>

<body class="bg-gray-800 m-auto">
    <nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <div class="px-3 py-4 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start rtl:justify-end">
                    <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar"
                        aria-controls="logo-sidebar" type="button"
                        class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                        <span class="sr-only">Open sidebar</span>
                        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path clip-rule="evenodd" fill-rule="evenodd"
                                d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                            </path>
                        </svg>
                    </button>
                    <a href="" class="flex items-center space-x-3 rtl:space-x-reverse">
                        <img src="/img/bkpm.png" class="h-10 w-20" alt="">
                        <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Office
                            Sentry</span>
                    </a>
                </div>
                <div class="flex items-center">
                    <div class="flex items-center ms-3">
                        <div>
                            <button type="button"
                                class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                                aria-expanded="false" data-dropdown-toggle="dropdown-user">
                                <span class="sr-only">Open user menu</span>
                            </button>
                        </div>
                        <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse ml-4">
                            <p class="relative inline font-inter font-normal text-transparent text-18 leading-normal">
                                <span type="text-wrapper text-white"
                                    class="text-white font-medium rounded-lg text-sm text-center">Halo,
                                    {{ Auth::user()->name }}</span><br>

                            </p>
                        </div>
                        <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600"
                            id="dropdown-user">
                            <div class="px-4 py-3" role="none">
                                <p class="text-sm text-gray-900 dark:text-white" role="none">
                                    Neil Sims
                                </p>
                                <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                                    neil.sims@flowbite.com
                                </p>
                            </div>
                            <ul class="py-1" role="none">
                                <li>
                                    <a href="#"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                        role="menuitem">Dashboard</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                        role="menuitem">Settings</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                        role="menuitem">Earnings</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                        role="menuitem">Sign out</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <aside id="logo-sidebar"
        class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
        aria-label="Sidebar">
        <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
            <ul class="space-y-2 font-medium">
                <li>
                    <a href="/dashboard/kabag_urdal"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 22 21">
                            <path
                                d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                            <path
                                d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                        </svg>
                        <span class="ms-3">Dashboard</span>
                    </a>
                </li>

                <li>
                    <button type="button"
                        class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                        aria-controls="dropdown-example-1" data-collapse-toggle="dropdown-example-1">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 20 18">
                            <path
                                d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z" />
                        </svg>
                        <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Users</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <ul id="dropdown-example-1" class="py-2 space-y-2">
                        <li>
                            <a href="/kabag-urdal/office-boys-index"
                                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">List
                                Office Boy</a>
                        </li>
                    </ul>
                </li>
                <ul class="pt-4 mt-4 space-y-2 font-medium border-t border-gray-200 dark:border-gray-700">
                    <li>
                        <button type="button"
                            class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                            aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                            <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 18 18">
                                <path
                                    d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z" />
                            </svg>
                            <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Fitur</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </button>
                        <ul id="dropdown-example" class="py-2 space-y-2">
                            <li>
                                <a href="/importOfficeBoy"
                                    class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 dark:bg-gray-700">Import
                                    Excel
                                </a>
                            </li>
                            <li>
                                <a href="/createOfficeBoy"
                                    class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Registrasi
                                    Office Boy
                                </a>
                            </li>
                            <li>
                                <a href="/kabag-urdal/monitorings"
                                    class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Tugas
                                    Office Boy</a>
                            </li>
                            <li>
                                <a href="/kabag-urdal/index/permission"
                                    class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Perizinan
                                    Office Boy</a>
                            </li>
                        </ul>
                    </li>
                    <ul class="pt-4 mt-4 space-y-2 font-medium border-t border-gray-200 dark:border-gray-700">
                        <li>
                            <a href="/kabag-urdal/tracking-results"
                                class="flex items-center p-1 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                                <svg class="w-7 h-7 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path opacity="0.4"
                                        d="M20 8.25V18C20 21 18.21 22 16 22H8C5.79 22 4 21 4 18V8.25C4 5 5.79 4.25 8 4.25C8 4.87 8.24997 5.43 8.65997 5.84C9.06997 6.25 9.63 6.5 10.25 6.5H13.75C14.99 6.5 16 5.49 16 4.25C18.21 4.25 20 5 20 8.25Z"
                                        fill="#718096" />
                                    <!-- Warna disesuaikan dengan warna pada SVG di "Dashboard" -->
                                    <path
                                        d="M16 4.25C16 5.49 14.99 6.5 13.75 6.5H10.25C9.63 6.5 9.06997 6.25 8.65997 5.84C8.24997 5.43 8 4.87 8 4.25C8 3.01 9.01 2 10.25 2H13.75C14.37 2 14.93 2.25 15.34 2.66C15.75 3.07 16 3.63 16 4.25Z"
                                        fill="#718096" />
                                    <!-- Warna disesuaikan dengan warna pada SVG di "Dashboard" -->
                                    <path
                                        d="M12 13.75H8C7.59 13.75 7.25 13.41 7.25 13C7.25 12.59 7.59 12.25 8 12.25H12C12.41 12.25 12.75 12.59 12.75 13C12.75 13.41 12.41 13.75 12 13.75Z"
                                        fill="#718096" />
                                    <!-- Warna disesuaikan dengan warna pada SVG di "Dashboard" -->
                                    <path
                                        d="M16 17.75H8C7.59 17.75 7.25 17.41 7.25 17C7.25 16.59 7.59 16.25 8 16.25H16C16.41 16.25 16.75 16.59 16.75 17C16.75 17.41 16.41 17.75 16 17.75Z"
                                        fill="#718096" />
                                    <!-- Warna disesuaikan dengan warna pada SVG di "Dashboard" -->
                                </svg>
                                <span class="ms-2">Riwayat Catatan</span>
                            </a>
                        </li>

                        <li>
                            <a href="/logout"
                                class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                                <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 18 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M1 8h11m0 0L8 4m4 4-4 4m4-11h3a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-3" />
                                </svg>
                                <span class="flex-1 ms-3 whitespace-nowrap">Keluar</span>
                            </a>
                        </li>
                    </ul>
        </div>
    </aside>

    <div class="p-4 sm:ml-64">
        <div class="mt-18">
            <div class="gap-4 mb-4">
                <div class="mt-16 pb-36">
                    <!-- Breadcrumbs Start -->
                    <nav class="flex" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse mt-2 mb-4">
                            <li class="inline-flex items-center">
                                <a href="/dashboard/kabag_urdal"
                                    class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                                    <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                                    </svg>
                                    Home
                                </a>
                            </li>
                            <li>
                                <div class="flex items-center">
                                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 9 4-4-4-4" />
                                    </svg>
                                    <a href="#"
                                        class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">Fitur</a>
                                </div>
                            </li>
                            <li aria-current="page">
                                <div class="flex items-center">
                                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 9 4-4-4-4" />
                                    </svg>
                                    <span
                                        class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Import
                                        Office Boy
                                </div>
                            </li>
                        </ol>
                    </nav>
                    <!-- Breadcrumbs End -->
                    <h2 class="text-2xl font-bold mb-4 text-white">Import Office Boy</h2>
                    @if (session('success'))
                        <div id="floating-alert" class="fixed bottom-0 right-0 z-50 mr-4">
                            <div class="alert alert-success">
                                <div id="alert-1"
                                    class="flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg dark:bg-gray-700 dark:text-green-400 border border-green-800">
                                    <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                                    </svg>
                                    {{ session('success') }}
                                    <button type="button"
                                        class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-transparent dark:text-green-400 dark:hover:bg-gray-600"
                                        data-dismiss-target="#alert-1" aria-label="Close">
                                        <span class="sr-only">Close</span>
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2"
                                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                var floatingAlert = document.getElementById("floating-alert");
                                var alert1 = document.getElementById("alert-1");

                                alert1.addEventListener("click", function() {
                                    floatingAlert.style.display = "none";
                                });
                            });
                        </script>
                    @endif
                    <div class="flex justify-center items-center">
                        <div class="p-8 dark:bg-gray-700 rounded-lg shadow-lg w-full mt-4">
                            <div class="mb-4">
                                <div class="bg-transparent">
                                    <h2 class="text-lg font-bold text-gray-400">Ketentuan Format</h2>
                                </div>
                                <div class="border-t border-gray-500 mt-2">
                                    <dl>
                                        <div class="mt-2">
                                            <dt class="text-gray-600 dark:text-gray-400 mb-4">• Pastikan setiap kolom
                                                dalam file Excel sesuai dengan kolom yang diperlukan.</dt>
                                        </div>
                                        <div class="mt-2">
                                            <dt class="text-gray-600 dark:text-gray-400 mb-4">• Untuk memudahkan Anda,
                                                unduh contoh format file yang diinginkan <a
                                                    href="https://docs.google.com/spreadsheets/d/17myYFmm7ZiTNXwMOsgREQ_vX_veHdN8-/export?format=xlsx"
                                                    class="text-blue-500 hover:underline">di sini</a>.</dt>
                                        </div>
                                        <div class="mt-2">
                                            <dt class="text-gray-600 dark:text-gray-400 mb-4">• Pastikan bahwa jumlah
                                                data yang Anda impor tidak
                                                melebihi batas maksimum yang ditetapkan untuk kenyamanan penggunaan
                                                sistem.</dt>
                                        </div>
                                    </dl>
                                </div>
                            </div>
                            <p class="text-gray-600 dark:text-gray-400 mb-4">
                                Impor akun Office Boy Anda melalui file Excel. Anda juga dapat menarik dan melepas file
                                Anda di sini.
                            </p>

                            <form action="{{ route('office_boys.import') }}" method="POST"
                                enctype="multipart/form-data" class="flex flex-col justify-center space-y-4">
                                @csrf
                                <div
                                    class="drop-zone w-full p-4 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer transition duration-300 ease-in-out hover:border-blue-400 flex flex-col justify-center items-center">
                                    <input type="file" name="file" id="file" class="hidden">
                                    <label for="file" id="file-label"
                                        class="text-gray-600 dark:text-gray-400 cursor-pointer bg-transparent p-16 w-full text-center rounded-lg">Drag
                                        and drop your file
                                        here or click to browse</label>
                                </div>
                                <div class="mt-4 mb-2 flex">
                                    <button type="submit"
                                        class="bg-green-500 text-white px-4 py-2 rounded-lg transition duration-300 ease-in-out hover:bg-green-600 mr-2">
                                        Import
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <script>
        const fileInput = document.getElementById('file');
        const dropZone = document.querySelector('.drop-zone');
        const fileLabel = document.getElementById('file-label');

        dropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropZone.classList.add('border-blue-500');
        });

        dropZone.addEventListener('dragleave', () => {
            dropZone.classList.remove('border-blue-500');
        });

        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropZone.classList.remove('border-blue-500');
            const file = e.dataTransfer.files[0];
            console.log('Dropped file:', file);
            fileInput.files = e.dataTransfer.files;
            fileLabel.textContent = file.name; // Update the drop zone text with the file name
        });

        fileInput.addEventListener('change', (e) => {
            const file = e.target.files[0];
            console.log('Selected file:', file);
            fileLabel.textContent = file.name; // Update the drop zone text with the file name
        });
    </script>
</body>

</html>
