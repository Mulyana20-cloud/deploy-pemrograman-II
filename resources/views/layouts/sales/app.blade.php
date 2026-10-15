<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Sales Panel
    </title>

    @vite(['resources/css/app.css','resources/js/app.js'])
</head>


<body class="bg-gray-100">


<div class="min-h-screen flex">

    @include('layouts.sales.sidebar')


    <div class="flex-1 min-w-0">

        @include('layouts.sales.navbar')


        <main class="w-full p-4 md:p-6">

            @if(session('success'))

            <div class="mb-5 rounded-xl bg-green-100 px-5 py-3 text-green-700">
                {{ session('success') }}
            </div>

            @endif


            @if(session('error'))

            <div class="mb-5 rounded-xl bg-red-100 px-5 py-3 text-red-700">
                {{ session('error') }}
            </div>

            @endif


            @yield('content')


        </main>

    </div>

</div>


</body>

</html>