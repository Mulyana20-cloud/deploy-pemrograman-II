<nav class="sticky top-0 z-50 border-b border-gray-100 bg-white">
    <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4 sm:px-6">

        <a href="{{ url('/') }}" class="text-xl font-bold tracking-tight text-slate-900 sm:text-2xl">
            BeautyStore
        </a>

        {{-- DESKTOP MENU --}}
        <div class="hidden items-center gap-8 text-sm md:flex">

            <a href="{{ url('/') }}"
               class="{{ request()->is('/') ? 'font-bold text-pink-500' : 'text-gray-500 hover:text-pink-500' }}">
                Home
            </a>

            <a href="{{ route('shop') }}"
               class="{{ request()->is('shop*') ? 'font-bold text-pink-500' : 'text-gray-500 hover:text-pink-500' }}">
                Shop
            </a>

            <a href="{{ route('categories') }}"
               class="{{ request()->is('categories') ? 'font-bold text-pink-500' : 'text-gray-500 hover:text-pink-500' }}">
                Categories
            </a>

            <a href="{{ url('/about') }}"
               class="{{ request()->is('about') ? 'font-bold text-pink-500' : 'text-gray-500 hover:text-pink-500' }}">
                About
            </a>

        </div>


        {{-- DESKTOP ACTION --}}
        <div class="hidden items-center gap-5 text-sm md:flex">

            @auth

                <a href="{{ url('/cart') }}" class="text-gray-600 hover:text-pink-500">
                    🛒 Cart
                </a>

                <a href="{{ url('/my-orders') }}" class="text-gray-600 hover:text-pink-500">
                    My Orders
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="rounded-xl bg-slate-900 px-5 py-2 text-white hover:bg-pink-500">
                        Logout
                    </button>
                </form>

            @else

                <a href="{{ route('login') }}" class="rounded-xl bg-slate-900 px-5 py-2 text-white hover:bg-pink-500">
                    Login
                </a>

            @endauth

        </div>


        {{-- MOBILE BUTTON --}}
        <button id="mobileMenuButton"
                type="button"
                class="flex h-10 w-10 items-center justify-center rounded-xl border border-gray-200 md:hidden">

            <span id="menuIcon" class="text-xl">
                ☰
            </span>

        </button>

    </div>


    {{-- MOBILE MENU --}}
    <div id="mobileMenu" class="hidden border-t border-gray-100 bg-white md:hidden">

        <div class="space-y-2 px-4 py-4">

            <a href="{{ url('/') }}" class="block rounded-xl px-4 py-3 text-sm text-gray-600 hover:bg-pink-50">
                Home
            </a>

            <a href="{{ route('shop') }}" class="block rounded-xl px-4 py-3 text-sm text-gray-600 hover:bg-pink-50">
                Shop
            </a>

            <a href="{{ route('categories') }}" class="block rounded-xl px-4 py-3 text-sm text-gray-600 hover:bg-pink-50">
                Categories
            </a>

            <a href="{{ url('/about') }}" class="block rounded-xl px-4 py-3 text-sm text-gray-600 hover:bg-pink-50">
                About
            </a>


            <div class="border-t pt-3"></div>


            @auth

                <a href="{{ url('/cart') }}" class="block rounded-xl px-4 py-3 text-sm text-gray-600 hover:bg-pink-50">
                    🛒 Cart
                </a>

                <a href="{{ url('/my-orders') }}" class="block rounded-xl px-4 py-3 text-sm text-gray-600 hover:bg-pink-50">
                    My Orders
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button class="w-full rounded-xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white hover:bg-pink-500">
                        Logout
                    </button>
                </form>

            @else

                <a href="{{ route('login') }}"
                   class="block rounded-xl bg-slate-900 px-5 py-3 text-center text-sm font-semibold text-white hover:bg-pink-500">
                    Login
                </a>

            @endauth

        </div>

    </div>

</nav>


<script>
document.addEventListener('DOMContentLoaded', function(){

    const button = document.getElementById('mobileMenuButton');
    const menu = document.getElementById('mobileMenu');
    const icon = document.getElementById('menuIcon');

    if(!button || !menu) return;

    button.addEventListener('click', function(){

        menu.classList.toggle('hidden');

        icon.textContent = menu.classList.contains('hidden') ? '☰' : '✕';

    });


    menu.querySelectorAll('a').forEach(link => {

        link.addEventListener('click', function(){
            menu.classList.add('hidden');
            icon.textContent = '☰';
        });

    });


});
</script>