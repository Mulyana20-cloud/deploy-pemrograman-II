<aside
    id="adminSidebar"

    class="
    fixed
    inset-y-0
    left-0
    z-50
    w-72
    bg-white
    border-r
    border-gray-100
    flex
    flex-col
    transform
    -translate-x-full
    md:translate-x-0
    transition-transform
    duration-300
    overflow-hidden
    "
>


    {{-- BRAND --}}
    <div class="shrink-0 px-8 py-8 border-b border-gray-100">


        <h1 class="text-2xl font-bold text-[#172033]">
            BeautyStore
        </h1>


        <p class="mt-1 text-sm text-gray-400">
            Admin Panel
        </p>


    </div>






    {{-- MENU --}}
    <nav
        class="
        flex-1
        overflow-y-auto
        px-5
        py-8
        "
    >



        {{-- MAIN MENU --}}
        <p class="mb-4 text-xs uppercase tracking-wider text-gray-400">
            Main Menu
        </p>



        <a
            href="{{ route('admin.dashboard') }}"

            class="
            flex
            items-center
            gap-3
            rounded-xl
            px-4
            py-3
            transition

            {{ request()->is('admin/dashboard')
                ? 'bg-pink-50 text-pink-600 font-semibold'
                : 'text-gray-700 hover:bg-gray-50'
            }}
            "
        >

            <span>
                ▣
            </span>

            Dashboard


        </a>







        {{-- CATALOG --}}
        <p class="mb-4 mt-8 text-xs uppercase tracking-wider text-gray-400">
            Catalog
        </p>



        <a
            href="/admin/products"

            class="
            flex
            items-center
            gap-3
            rounded-xl
            px-4
            py-3
            transition

            {{ request()->is('admin/products*')
                ? 'bg-pink-50 text-pink-600 font-semibold'
                : 'text-gray-700 hover:bg-gray-50'
            }}
            "
        >

            <span>
                ▣
            </span>

            Products


        </a>





        <a
            href="/admin/categories"

            class="
            flex
            items-center
            gap-3
            rounded-xl
            px-4
            py-3
            transition

            {{ request()->is('admin/categories*')
                ? 'bg-pink-50 text-pink-600 font-semibold'
                : 'text-gray-700 hover:bg-gray-50'
            }}
            "
        >

            <span>
                ▤
            </span>

            Categories


        </a>








        {{-- SALES --}}
        <p class="mb-4 mt-8 text-xs uppercase tracking-wider text-gray-400">
            Sales
        </p>



        <a
            href="/admin/orders"

            class="
            flex
            items-center
            gap-3
            rounded-xl
            px-4
            py-3
            transition

            {{ request()->is('admin/orders*')
                ? 'bg-pink-50 text-pink-600 font-semibold'
                : 'text-gray-700 hover:bg-gray-50'
            }}
            "
        >

            <span>
                ▤
            </span>

            Orders


        </a>





        <a
            href="/admin/payments"

            class="
            flex
            items-center
            gap-3
            rounded-xl
            px-4
            py-3
            transition

            {{ request()->is('admin/payments*')
                ? 'bg-pink-50 text-pink-600 font-semibold'
                : 'text-gray-700 hover:bg-gray-50'
            }}
            "
        >

            <span>
                ▭
            </span>

            Payments


        </a>





        <a
            href="{{ route('sales.commissions') }}"

            class="
            flex
            items-center
            gap-3
            rounded-xl
            px-4
            py-3
            transition

            {{ request()->routeIs('sales.commissions')
                ? 'bg-pink-50 text-pink-600 font-semibold'
                : 'text-gray-700 hover:bg-gray-50'
            }}
            "
        >

            <span>
                💰
            </span>

            Komisi Sales


        </a>









        {{-- USERS --}}
        <p class="mb-4 mt-8 text-xs uppercase tracking-wider text-gray-400">
            Users
        </p>





        <a
            href="/admin/customers"

            class="
            flex
            items-center
            gap-3
            rounded-xl
            px-4
            py-3
            transition

            {{ request()->is('admin/customers*')
                ? 'bg-pink-50 text-pink-600 font-semibold'
                : 'text-gray-700 hover:bg-gray-50'
            }}
            "
        >

            <span>
                ♟
            </span>

            Customers


        </a>






        <a
            href="/admin/sales"

            class="
            flex
            items-center
            gap-3
            rounded-xl
            px-4
            py-3
            transition

            {{ request()->routeIs('admin.sales.index')
                ? 'bg-pink-50 text-pink-600 font-semibold'
                : 'text-gray-700 hover:bg-gray-50'
            }}
            "
        >

            <span>
                ♙
            </span>

            Manajemen Sales


        </a>




    </nav>







    {{-- LOGOUT --}}
    <div
        class="
        shrink-0
        border-t
        border-gray-100
        bg-white
        px-5
        py-6
        "
    >


        <a
            href="/logout"

            class="
            flex
            w-full
            items-center
            justify-center
            gap-2
            rounded-xl
            border
            border-pink-500
            py-3
            font-semibold
            text-pink-600
            transition

            hover:bg-pink-500
            hover:text-white
            "
        >

            ↪ Logout


        </a>


    </div>



</aside>





{{-- MOBILE OVERLAY --}}
<div

    id="adminOverlay"

    class="
    hidden
    fixed
    inset-0
    z-40
    bg-black/40
    md:hidden
    "

>
</div>