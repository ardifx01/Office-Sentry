<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard Pengawas</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="/resources/css/app.css" rel="stylesheet">
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
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 10;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
            /* Dimmed background */
        }

        .modal-content {
            background-color: #1f2937;
            /* bg-gray-800 */
            margin: 10% auto;
            padding: 20px;
            border: 1px solid #535353;
            width: 50%;
            /* Smaller modal */
            border-radius: 0.5rem;
        }

        .close {
            float: right;
            font-size: 1.5rem;
            font-weight: bold;
            color: #f6f3f3;
            /* Text color for close button */
        }

        .close:hover,
        .close:focus {
            color: #d1d5db;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>

<body class="bg-gray-400 dark:bg-gray-900 m-auto">
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
                            </button>
                        </div>
                        <button id="theme-toggle" type="button"
                            class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
                            <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                            </svg>
                            <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                                    fill-rule="evenodd" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                        <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse ml-4">
                            <p class="relative inline font-inter font-normal text-transparent text-18 leading-normal">
                                <span type="text-wrapper text-white"
                                    class="text-gray-900 dark:text-white font-medium rounded-lg text-sm text-center">Selamat
                                    datang
                                    {{ Auth::user()->name }}</span><br>
                            </p>
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
                    <a href="/dashboard/pengawas"
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
                    <ul id="dropdown-example-1" class="py-2 space-y-2 hidden">
                        <li>
                            <a href="/pengawas/office-boys"
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
                        <ul id="dropdown-example" class="py-2 space-y-2 hidden">
                            <li>
                                <a href="/pengawas/tracking"
                                    class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Tracking
                                </a>
                            </li>
                            <li>
                                <a href="/pengawas/rolling-task"
                                    class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Rolling
                                    Tugas
                                </a>
                            </li>
                            <li>
                                <a href="/pengawas/monitorings"
                                    class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Tugas
                                    Office Boy</a>
                            </li>
                            <li>
                                <a href="/pengawas"
                                    class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Perizinan
                                    Office Boy</a>
                            </li>
                        </ul>
                    </li>
                    <ul class="pt-4 mt-4 space-y-2 font-medium border-t border-gray-200 dark:border-gray-700">
                        <li>
                            <a href="/pengawas/tracking-results"
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
        <div class="mt-16">
            <div class="gap-4 mb-4">
                @if (session('success'))
                    <!-- Success Modal -->
                    <!-- Main modal -->
                    <div class="alert alert-success">
                        <div id="successModal" tabindex="-1" aria-hidden="true"
                            class="overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 flex justify-center items-center w-full md:inset-0 h-modal md:h-full bg-black bg-opacity-50">
                            <div class="relative p-4 w-full max-w-md md:h-auto">
                                <!-- Modal content -->
                                <div
                                    class="relative p-4 text-center bg-white rounded-lg shadow sm:p-5 dark:bg-gray-800 transition-opacity duration-300">
                                    <button type="button" onclick="closeModal()"
                                        class="absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white text-sm p-1.5 ml-auto inline-flex items-center"
                                        data-modal-toggle="successModal">
                                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor"
                                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                    <div
                                        class="w-12 h-12 rounded-full bg-green-100 dark:bg-green-900 p-2 flex items-center justify-center mx-auto mb-3.5">
                                        <svg aria-hidden="true" class="w-8 h-8 text-green-500 dark:text-green-400"
                                            fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="sr-only">Login Successful!</span>
                                    </div>
                                    <p class="mb-4 text-lg font-semibold text-gray-900 dark:text-white">Selamat datang
                                        di dashboard. Anda berhasil login.</p>
                                    <button data-modal-toggle="successModal" type="button" onclick="closeModal()"
                                        class="py-2 px-3 text-sm font-medium text-center text-white rounded-lg bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-900">
                                        Lanjut
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Jumbotron Start --}}
                <div
                    class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg border  py-2 px-4">
                    <h2 class="text-gray-900 dark:text-white text-2xl font-bold mb-2 mt-2">Halo Selamat Datang! 🖐️
                    </h2>
                </div>
                {{-- Jumbotron End --}}
            </div>
        </div>

        {{-- <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 w-full mb-4">
            @foreach ($statusDetails as $status => $details)
                <div
                    class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-6 md:p-8">
                    <h2 class="text-lg font-bold text-white mb-3">{{ $status }}
                        ({{ count($details) }})</h2>
                    <button onclick="openModal('{{ $status }}')"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Lihat Detail
                    </button>

                    <!-- Modal -->
                    <div id="modal-{{ $status }}" class="modal">
                        <div class="modal-content">
                            <span onclick="closeModal('{{ $status }}')" class="close">&times;</span>
                            <h4 class="font-bold text-lg mb-2 text-white">Detail {{ $status }}</h4>
                            <table
                                class="text-gray-500 text-sm rounded-lg focus:ring-blue-500 dark:bg-transparent dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500  w-full p-2.5">
                                <thead>
                                    <tr>
                                        <th class="py-4 px-4 border-b border-gray-500 bg-gray-700 text-gray-400">
                                            No
                                        </th>
                                        <th class="py-4 px-4 border-b border-gray-500 bg-gray-700 text-gray-400">
                                            Nama
                                        </th>
                                        <th class="py-4 px-4 border-b border-gray-500 bg-gray-700 text-gray-400">
                                            NIK
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($details as $index => $detail)
                                        <tr class="hover:bg-gray-700">
                                            <td
                                                class="py-6 px-4 mb-2 text-center border-b border-gray-600 bg-transparent">
                                                {{ $index + 1 }}</td>
                                            <td <td
                                                class="py-6 px-4 mb-2 text-center border-b border-gray-600 bg-transparent">
                                                {{ $detail->nama_lengkap }}
                                            </td>
                                            <td
                                                class="py-6 px-4 mb-2 text-center border-b border-gray-600 bg-transparent">
                                                {{ $detail->nik }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endforeach
        </div> --}}

        <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-2 gap-4 w-auto">

            <!--Chart Progress Harian OB Start-->
            <div class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-8 md:p-8">
                <div class="justify-between pb-4 mb-4 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-center mb-4">
                        <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white pe-1">Progress Harian
                            Office Boy</h5>
                        <svg data-popover-target="chart-info2" data-popover-placement="bottom"
                            class="w-3.5 h-3.5 text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white cursor-pointer ms-1"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm0 16a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3Zm1-5.034V12a1 1 0 0 1-2 0v-1.418a1 1 0 0 1 1.038-.999 1.436 1.436 0 0 0 1.488-1.441 1.501 1.501 0 1 0-3-.116.986.986 0 0 1-1.037.961 1 1 0 0 1-.96-1.037A3.5 3.5 0 1 1 11 11.466Z" />
                        </svg>
                        <div data-popover id="chart-info2" role="tooltip"
                            class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 w-72 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400">
                            <div class="p-3 space-y-2">
                                <h3 class="font-semibold text-gray-900 dark:text-white">Perbarui Insight Anda dengan
                                    Cepat Melalui Pilihan Tanggal yang Fleksibel</h3>
                                <p>Dapatkan visualisasi data yang lebih dinamis dan interaktif dengan fitur baru pada
                                    dashboard pengawas kami. Fitur ini memungkinkan Anda untuk melihat dan membandingkan
                                    performa tugas harian office boy dengan lebih detail dan tepat waktu.</p>
                                <h3 class="font-semibold text-gray-900 dark:text-white">Pilih Rentang Tanggal</h3>
                                <p>Temukan kebebasan dalam memantau performa Office Boy dengan fitur filter rentang
                                    tanggal kami. Fitur intuitif ini memungkinkan Anda untuk secara spesifik
                                    menyesuaikan tampilan data sesuai periode yang Anda butuhkan—mulai dari hari kemarin
                                    hingga bulan lalu. Pilih tanggal awal dan akhir, dan biarkan dashboard kami
                                    menampilkan insight yang tepat sesuai kebutuhan analisis Anda.</p>
                                <a href="#"
                                    class="flex items-center font-medium text-blue-600 dark:text-blue-500 dark:hover:text-blue-600 hover:text-blue-700 hover:underline">Read
                                    more <svg class="w-2 h-2 ms-1.5 rtl:rotate-180" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 9 4-4-4-4" />
                                    </svg></a>
                            </div>
                            <div data-popper-arrow></div>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <div
                            class="w-12 h-12 rounded-lg bg-gray-100 dark:bg-gray-700 flex items-center justify-center me-3">
                            <svg class="w-6 h-6 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 19">
                                <path
                                    d="M14.5 0A3.987 3.987 0 0 0 11 2.1a4.977 4.977 0 0 1 3.9 5.858A3.989 3.989 0 0 0 14.5 0ZM9 13h2a4 4 0 0 1 4 4v2H5v-2a4 4 0 0 1 4-4Z" />
                                <path
                                    d="M5 19h10v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2ZM5 7a5.008 5.008 0 0 1 4-4.9 3.988 3.988 0 1 0-3.9 5.859A4.974 4.974 0 0 1 5 7Zm5 3a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm5-1h-.424a5.016 5.016 0 0 1-1.942 2.232A6.007 6.007 0 0 1 17 17h2a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5ZM5.424 9H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h2a6.007 6.007 0 0 1 4.366-5.768A5.016 5.016 0 0 1 5.424 9Z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-normal text-gray-500 dark:text-gray-400 pb-1">Total jumlah office
                                boy
                            </p>
                            <h5 class="leading-none text-2xl font-bold text-gray-900 dark:text-white">
                                {{ $totalOfficeBoys }}</h5>
                        </div>
                    </div>
                    <!-- Filter Tanggal Mulai dan Tanggal Akhir -->
                    <div class="flex justify-between items-center pt-3">
                        <div class="flex items-center space-x-3">
                            <div>
                                <label for="filter_start_date" class="block text-sm font-medium text-gray-700">Start
                                    Date</label>
                                <input type="date" id="start_date" name="start_date"
                                    value="{{ request('start_date', \Carbon\Carbon::today()->subDays(7)->format('Y-m-d')) }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500 py-2.5 mt-2">
                            </div>
                            <div>
                                <label for="filter_start_date" class="block text-sm font-medium text-gray-700">End
                                    Date</label>
                                <input type="date" id="end_date" name="end_date"
                                    value="{{ request('end_date', \Carbon\Carbon::today()->format('Y-m-d')) }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500 py-2.5 mt-2">
                            </div>
                            <button onclick="updateChart()"
                                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 mt-7">Filter</button>
                        </div>
                    </div>
                </div>

                <div id="column-chart"></div>
                <div
                    class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between">
                    <div class="flex justify-between items-center pt-5">
                        <a href="/pengawas/monitorings"
                            class="uppercase text-sm font-semibold inline-flex items-center rounded-lg text-blue-600 hover:text-blue-700 dark:hover:text-blue-500  hover:bg-gray-100 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 px-3 py-2">
                            Detail
                            <svg class="w-2.5 h-2.5 ms-1.5 rtl:rotate-180" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <!--Chart Progress Harian OB End-->

            <!-- Chart Perizinan Start -->
            <div class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-8 md:p-8">
                <div class="flex justify-between">
                    <div class="flex items-center">
                        <div class="flex justify-center items-center">
                            <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white pe-1">Status
                                Perizinan Office Boy</h5>
                        </div>
                    </div>
                </div>

                <form method="GET" action="{{ route('pengawas.dashboard') }}" class="mb-4">
                    <div class="flex items-center pt-3">
                        <div class="mr-3">
                            <label for="filter_start_date" class="block text-sm font-medium text-gray-700">Start
                                Date</label>
                            <input type="date" name="filter_start_date" id="filter_start_date"
                                value="{{ $filterStartDate }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500 py-2.5 mt-2">
                        </div>
                        <div class="mr-3">
                            <label for="filter_end_date" class="block text-sm font-medium text-gray-700">End
                                Date</label>
                            <input type="date" name="filter_end_date" id="filter_end_date"
                                value="{{ $filterEndDate }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500 py-2.5 mt-2">
                        </div>
                        <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 mt-7">Filter</button>
                    </div>
                </form>

                <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded-lg">
                    <div class="grid grid-cols-3 gap-3 mb-2">
                        <dl
                            class="bg-blue-50 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px]">
                            <dt
                                class="w-8 h-8 rounded-full bg-blue-100 dark:bg-gray-500 text-blue-600 dark:text-blue-300 text-sm font-medium flex items-center justify-center mb-1">
                                {{ $totalIzin }}</dt>
                            <dd class="text-blue-600 dark:text-blue-300 text-sm font-medium">Total Izin</dd>
                        </dl>
                        <dl
                            class="bg-teal-50 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px]">
                            <dt
                                class="w-8 h-8 rounded-full bg-teal-100 dark:bg-gray-500 text-teal-600 dark:text-teal-300 text-sm font-medium flex items-center justify-center mb-1">
                                {{ $belumKembali }}</dt>
                            <dd class="text-teal-600 dark:text-teal-300 text-sm font-medium">Belum Kembali</dd>
                        </dl>
                        <dl
                            class="bg-orange-50 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px]">
                            <dt
                                class="w-8 h-8 rounded-full bg-orange-100 dark:bg-gray-500 text-orange-600 dark:text-orange-300 text-sm font-medium flex items-center justify-center mb-1">
                                {{ $sudahKembali }}</dt>
                            <dd class="text-orange-600 dark:text-orange-300 text-sm font-medium">Sudah Kembali</dd>
                        </dl>
                    </div>
                </div>

                <!-- Radial Chart -->
                <div class="py-6" id="radial-chart"></div>
            </div>
            <!-- Chart Perizinan End -->

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
        function openModal(status) {
            document.getElementById('modal-' + status).style.display = 'block';
        }

        function closeModal(status) {
            document.getElementById('modal-' + status).style.display = 'none';
        }

        window.onclick = function(event) {
            const modals = document.querySelectorAll('.modal');
            modals.forEach(modal => {
                if (event.target === modal) {
                    modal.style.display = "none";
                }
            });
        }
    </script>

    <script>
        var showNavigationBtn = document.getElementById('showNavigationBtn');
        var drawer = document.getElementById('drawer-navigation');

        showNavigationBtn.addEventListener('click', function() {
            if (drawer.style.transform === 'translateX(0%)') {
                drawer.style.transform = 'translateX(-100%)';
            } else {
                drawer.style.transform = 'translateX(0%)';
            }
        });

        var exitBtn = document.querySelector('#drawer-navigation button[data-drawer-hide="drawer-navigation"]');
        exitBtn.addEventListener('click', function() {
            drawer.style.transform = 'translateX(-100%)';
        });
    </script>

    <script>
        function closeModal() {
            var modal = document.getElementById('successModal');
            modal.classList.add('hidden');
        }
    </script>

    <!-- Fungsi Chart Progress Harian Start -->
    <script>
        var chartData = @json($chartData);

        const options = {
            colors: ["#1A56DB", "#FDBA8C"],
            series: [{
                    name: "Belum Mengerjakan Tugas",
                    data: Object.keys(chartData['Belum Dikerjakan']).map((date) => ({
                        x: date,
                        y: chartData['Belum Dikerjakan'][date] || 0, // Default jika tidak ada data
                    }))
                },
                {
                    name: "Selesai Dikerjakan",
                    data: Object.keys(chartData['Selesai Dikerjakan'] || {}).map((date) => ({
                        x: date,
                        y: chartData['Selesai Dikerjakan'][date] || 0, // Default jika tidak ada data
                    }))
                }
            ],
            chart: {
                type: "bar",
                height: "350px",
                fontFamily: "Inter, sans-serif",
                toolbar: {
                    show: false,
                },
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '45%',
                    dataLabels: {
                        position: 'top',
                    },
                    borderRadius: 5
                },
            },
            tooltip: {
                shared: true,
                intersect: false,
                y: {
                    formatter: function(value, {
                        series,
                        seriesIndex,
                        dataPointIndex,
                        w
                    }) {
                        return value + " Office Boy";
                    }
                }
            },
            xaxis: {
                type: 'category',
                categories: Object.keys(chartData['Belum Dikerjakan']).concat(Object.keys(chartData[
                        'Selesai Dikerjakan']))
                    .filter((value, index, self) => self.indexOf(value) === index),
                axisBorder: {
                    show: true,
                    color: '#78909C',
                    height: 1,
                    width: '100%',
                    offsetX: 0,
                    offsetY: 0
                },
                axisTicks: {
                    show: true,
                    borderType: 'solid',
                    color: '#78909C',
                    width: 6,
                    offsetX: 0,
                    offsetY: 0
                },
                labels: {
                    rotate: -45,
                    rotateAlways: true,
                    hideOverlappingLabels: true,
                    show: true,
                    style: {
                        colors: [],
                        fontSize: '12px',
                        fontFamily: 'Inter, sans-serif',
                        cssClass: 'apexcharts-xaxis-label',
                    },
                }
            },
            yaxis: {
                title: {
                    text: 'Jumlah Tugas',
                    style: {
                        color: '#535353',
                        fontSize: '14px',
                        fontFamily: 'Helvetica, Arial, sans-serif',
                        fontWeight: 600,
                    }
                },
                min: 0,
                labels: {
                    formatter: function(val) {
                        return parseInt(val);
                    }
                }
            },
            fill: {
                opacity: 1
            },
            legend: {
                position: 'bottom',
                horizontalAlign: 'center',
                floating: true,
                fontSize: '14px',
                fontFamily: 'Inter, sans-serif',
                fontWeight: 400,
                inverseOrder: false,
                offsetX: 0,
                offsetY: 0,
                labels: {
                    useSeriesColors: false
                },
                markers: {
                    width: 12,
                    height: 12,
                    strokeWidth: 0,
                    strokeColor: '#fff',
                    fillColors: undefined,
                    radius: 12,
                    customHTML: undefined,
                    onClick: undefined,
                    offsetX: 0,
                    offsetY: 0
                },
                itemMargin: {
                    horizontal: 5,
                    vertical: 20
                }
            },
            grid: {
                show: false,
                borderColor: '#90A4AE',
                strokeDashArray: 0,
                position: 'back',
                xaxis: {
                    lines: {
                        show: false
                    }
                },
                yaxis: {
                    lines: {
                        show: true
                    }
                },
                row: {
                    colors: undefined,
                    opacity: 0.5
                },
                column: {
                    colors: undefined,
                    opacity: 0.5
                },
                padding: {
                    top: 0,
                    right: 0,
                    bottom: 0,
                    left: 0
                },
            }
        };

        if (document.getElementById("column-chart") && typeof ApexCharts !== 'undefined') {
            const chart = new ApexCharts(document.getElementById("column-chart"), options);
            chart.render();
        }
    </script>
    <!-- Fungsi Chart Progress Harian End -->

    <script>
        function updateChart() {
            const startDate = document.getElementById('start_date').value;
            const endDate = document.getElementById('end_date').value;

            if (!startDate || !endDate) {
                alert('Please select both start and end dates.');
                return;
            }

            window.location.href = `/dashboard/pengawas?start_date=${startDate}&end_date=${endDate}`;
        }
    </script>

    <!-- Fungsi Chart Perizinan Office Boy Start -->
    <script>
        const getChartOptions = (belumKembaliPercent, sudahKembaliPercent) => {
            return {
                series: [belumKembaliPercent, sudahKembaliPercent],
                colors: ["#16BDCA", "#FDBA8C"],
                chart: {
                    height: "380px",
                    width: "100%",
                    type: "radialBar",
                    sparkline: {
                        enabled: true,
                    },
                },
                plotOptions: {
                    radialBar: {
                        track: {
                            background: '#E5E7EB',
                        },
                        dataLabels: {
                            show: false,
                        },
                        hollow: {
                            margin: 0,
                            size: "32%",
                        }
                    },
                },
                grid: {
                    show: false,
                    strokeDashArray: 4,
                    padding: {
                        left: 2,
                        right: 2,
                        top: -23,
                        bottom: -20,
                    },
                },
                labels: ["Belum Kembali", "Sudah Kembali"],
                legend: {
                    show: true,
                    position: "bottom",
                    fontFamily: "Inter, sans-serif",
                },
                tooltip: {
                    enabled: true,
                    x: {
                        show: false,
                    },
                },
                yaxis: {
                    show: false,
                    labels: {
                        formatter: function(value) {
                            return value + '%';
                        }
                    }
                }
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const belumKembaliPercent = @json($belumKembaliPercent);
            const sudahKembaliPercent = @json($sudahKembaliPercent);

            if (document.getElementById("radial-chart") && typeof ApexCharts !== 'undefined') {
                const chart = new ApexCharts(document.querySelector("#radial-chart"), getChartOptions(
                    belumKembaliPercent, sudahKembaliPercent));
                chart.render();
            }
        });
    </script>
    <!-- Fungsi Chart Perizinan Office Boy End -->

</body>

</html>
