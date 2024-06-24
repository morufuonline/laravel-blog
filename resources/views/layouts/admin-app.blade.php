<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title') | Admin Portal</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
        .required{
            color:#f11;
        }
        .form-control{
            width:100%;
        }

        table{
            width:100%;
        }
        table tbody td, table tbody th{
            padding:5px;
            border:1px solid #ddd;
        }
        table tbody td.action{
            width:50px;
        }
        table tbody td.action a{
            color:#f11;
        }
        table tbody td.action a:hover{
            color:#b20;
        }
        table tbody td.serial-id, table tbody th.serial-id{
            text-align:center;
        }

        .search-tb{
            width:100%;
        }
        .search-tb tbody tr td{
            padding:0px;
            border:0;
        }
        .search-tb tbody tr td input, .search-tb tbody tr td button{
            width:100%;
            padding:10px;
        }
        .search-tb tbody tr td button{
            background:#009;
            color:#fff;
        }
        .search-tb tbody tr td.search-btn-td{
            width:70px;
        }

        .pagination nav div > span{
            padding:0 12px;
            margin: 0 5px;
        }
        .pagination a{
            padding:0 12px;
            margin: 0 5px;
            background:#f11;
            color:#fff;
            border:1px solid #f11;
        }
        .pagination a:hover{
            background:#fff;
            color:#f11;
        }

        /* =========== Success and Error Message ===================== */
        .success{
        text-align:center;
        padding:15px;
        margin-top:10px;
        margin-bottom:10px;
        cursor:default;
        color: #3c763d;
        background-color: #dff0d8;
        border-color: #d6e9c6;
        }
        .success *, .success *:active, .success *:hover{
        text-decoration:none;
        color:#3c763d;
        cursor:pointer;
        }
        .success a:hover{
        text-decoration:underline;
        }
        .not-success{
        text-align:center;
        padding:15px;
        margin-top:10px;
        margin-bottom:10px;
        color: #a94442;
        background-color: #f2dede;
        border-color: #ebccd1;
        }
        .not-success *{
        color: #a94442;
        }
       </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.admin-navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
