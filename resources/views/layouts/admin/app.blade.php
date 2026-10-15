<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>
Admin Panel
</title>

@vite(['resources/css/app.css','resources/js/app.js'])

</head>


<body class="bg-gray-100">


<div class="min-h-screen flex">


    @include('layouts.admin.sidebar')


    <div class="flex-1 min-w-0">


        @include('layouts.admin.navbar')


        <main class="w-full min-w-0 p-4 md:p-6">


            @if(session('success'))

            <div id="alert-success"
            class="mb-5 rounded-xl bg-green-100 px-5 py-3 text-green-700 transition duration-500">

                {{ session('success') }}

            </div>

            @endif



            @if(session('error'))

            <div id="alert-error"
            class="mb-5 rounded-xl bg-red-100 px-5 py-3 text-red-700 transition duration-500">

                {{ session('error') }}

            </div>

            @endif



            @yield('content')


        </main>


    </div>


</div>



<script>

setTimeout(function(){

    ['alert-success','alert-error'].forEach(function(id){

        let alert=document.getElementById(id);

        if(alert){

            alert.style.opacity='0';

            setTimeout(()=>alert.remove(),500);

        }

    });

},5000);


</script>


</body>

</html>