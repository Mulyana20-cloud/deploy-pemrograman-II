<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<meta name="csrf-token" content="{{ csrf_token() }}">


<title>
BeautyStore
</title>


@vite(['resources/css/app.css','resources/js/app.js'])


</head>


<body class="font-sans antialiased">


<div class="
min-h-screen
bg-[#faf7f5]
flex
items-center
justify-center
px-4
py-8
">



    <!-- LEFT BRAND DESKTOP -->

    <div class="
    hidden
    lg:flex
    fixed
    left-0
    top-0
    h-screen
    w-1/2
    bg-[#f8ebe5]
    items-center
    justify-center
    ">


        <div class="text-center max-w-md px-8">


            <img
            src="{{ asset('images/logo.jpg') }}"
            class="
            w-56
            h-56
            object-cover
            rounded-full
            mx-auto
            shadow-lg
            ">


            <h1 class="
            mt-8
            text-4xl
            font-bold
            text-[#172033]
            ">

                BeautyStore

            </h1>


            <p class="
            mt-3
            text-lg
            text-gray-600
            ">

                Skincare & Fashion Store

            </p>


            <p class="
            mt-5
            text-gray-500
            leading-relaxed
            ">

                Discover premium skincare and fashion
                products carefully selected for your
                everyday beauty.

            </p>



            <div class="
            mt-8
            flex
            justify-center
            gap-5
            text-sm
            text-gray-500
            ">


                <span>
                    ✨ Premium Product
                </span>


                <span>
                    🔒 Secure Payment
                </span>


                <span>
                    🚚 Fast Delivery
                </span>


            </div>


        </div>


    </div>





    <!-- FORM -->

    <div class="
    w-full
    lg:absolute
    lg:right-0
    lg:w-1/2
    flex
    justify-center
    ">



        <div class="
        w-full
        max-w-md
        ">



            <div class="
            bg-white
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



</div>


</body>

</html>