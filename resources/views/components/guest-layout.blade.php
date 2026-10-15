<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        {{ config('app.name', 'BeautyStore') }}
    </title>


    <link rel="preconnect" href="https://fonts.bunny.net">

    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet">


    @vite(['resources/css/app.css','resources/js/app.js'])

</head>


<body class="font-sans antialiased">


<div class="
min-h-screen
bg-[#faf5f2]
flex
items-center
justify-center
px-4
py-8
">



    <!-- DESKTOP BRAND -->

    <div class="
    hidden
    lg:flex
    fixed
    left-0
    top-0
    w-1/2
    h-screen
    bg-[#f8ece6]
    items-center
    justify-center
    ">


        <div class="text-center max-w-md">


            <img
            src="{{ asset('images/logo.jpg') }}"
            class="
            w-56
            h-56
            rounded-full
            object-cover
            mx-auto
            shadow-lg
            mb-8
            ">


            <h1 class="text-4xl font-bold text-[#172033]">
                BeautyStore
            </h1>


            <p class="mt-3 text-xl text-gray-600">
                Skincare & Fashion Store
            </p>


            <p class="mt-6 text-gray-500 leading-relaxed">
                Discover premium skincare and fashion products carefully selected for your everyday beauty.
            </p>


        </div>


    </div>





    <!-- LOGIN CARD -->


    <div class="
    w-full
    max-w-md
    lg:absolute
    lg:right-0
    lg:w-1/2
    flex
    justify-center
    ">


        <div class="
        bg-white
        w-full
        rounded-3xl
        shadow-xl
        px-6
        py-8
        sm:px-10
        sm:py-10
        ">


            {{ $slot }}


        </div>


    </div>



</div>



</body>


</html>