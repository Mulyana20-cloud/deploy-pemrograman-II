<header class="h-20 bg-white border-b border-gray-100 flex items-center justify-between px-4 md:px-8">


    {{-- MOBILE BUTTON --}}

    <button
        id="adminMenuButton"
        class="md:hidden w-10 h-10 rounded-xl border border-gray-200 flex items-center justify-center"
    >

        <svg id="adminOpenIcon"
        xmlns="http://www.w3.org/2000/svg"
        class="w-6 h-6"
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor">

            <path stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M4 6h16M4 12h16M4 18h16"/>

        </svg>


        <svg id="adminCloseIcon"
        xmlns="http://www.w3.org/2000/svg"
        class="hidden w-6 h-6"
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor">

            <path stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M6 18L18 6M6 6l12 12"/>

        </svg>

    </button>




    <div>

        <h2 class="text-lg md:text-xl font-bold text-[#172033]">

            {{ ucwords(str_replace('-', ' ', request()->segment(2) ?? 'Dashboard')) }}

        </h2>


        <p class="hidden sm:block text-sm text-gray-400">

            Manage your online store

        </p>

    </div>






    <div class="flex items-center gap-3">


        <div class="hidden sm:block text-right">

            <p class="font-semibold text-[#172033]">

                {{ auth()->user()->name ?? 'Administrator' }}

            </p>


            <p class="text-xs text-gray-400">

                Admin Account

            </p>

        </div>




        <div class="
        w-11
        h-11
        rounded-full
        bg-[#172033]
        text-white
        flex
        items-center
        justify-center
        font-semibold
        ">

            {{ strtoupper(substr(auth()->user()->name ?? 'A',0,1)) }}

        </div>


    </div>


</header>




<script>

document.addEventListener('DOMContentLoaded',function(){


    const button=document.getElementById('adminMenuButton');
    const sidebar=document.getElementById('adminSidebar');
    const overlay=document.getElementById('adminOverlay');
    const open=document.getElementById('adminOpenIcon');
    const close=document.getElementById('adminCloseIcon');


    if(!button) return;



    function toggleMenu(){

        sidebar.classList.toggle('-translate-x-full');

        overlay.classList.toggle('hidden');

        open.classList.toggle('hidden');

        close.classList.toggle('hidden');

    }



    button.addEventListener(
        'click',
        toggleMenu
    );


    overlay.addEventListener(
        'click',
        toggleMenu
    );


});


</script>