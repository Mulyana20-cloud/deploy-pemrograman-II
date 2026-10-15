<aside
id="salesSidebar"

class="
fixed
md:static
top-0
left-0
z-50
w-64
bg-white
border-r
border-gray-100
min-h-screen
flex
flex-col
transform
-translate-x-full
md:translate-x-0
transition-transform
duration-300
"
>


    {{-- BRAND --}}

    <div class="px-8 py-8 border-b border-gray-100">


        <h1 class="text-2xl font-bold text-[#172033]">

            BeautyStore

        </h1>


        <p class="text-sm text-gray-400 mt-1">

            Sales Panel

        </p>


    </div>




    <nav class="flex-1 px-5 py-8">


        <p class="text-xs uppercase tracking-wider text-gray-400 mb-4">

            Main Menu

        </p>




        <a href="{{ route('sales.dashboard') }}"

        class="
        flex
        items-center
        gap-3
        px-4
        py-3
        rounded-xl
        transition

        {{ request()->routeIs('sales.dashboard')
            ? 'bg-pink-50 text-pink-600 font-semibold'
            : 'text-gray-700 hover:bg-gray-50'
        }}
        ">


            <span>
                ▣
            </span>


            Dashboard


        </a>





        <a href="{{ route('shop') }}"

        class="
        mt-2
        flex
        items-center
        gap-3
        px-4
        py-3
        rounded-xl
        text-gray-700
        hover:bg-gray-50
        transition
        ">


            <span>
                🛍
            </span>


            Lihat Produk


        </a>


    </nav>





    <div class="px-5 pb-8">


        <form method="POST"
        action="{{ route('logout') }}">

            @csrf


            <button
            class="
            w-full
            py-3
            rounded-xl
            border
            border-pink-500
            text-pink-600
            font-medium
            hover:bg-pink-500
            hover:text-white
            transition
            ">

                ↪ Logout


            </button>


        </form>


    </div>


</aside>




{{-- OVERLAY MOBILE --}}

<div
id="salesOverlay"

class="
hidden
fixed
inset-0
bg-black/40
z-40
md:hidden
">

</div>