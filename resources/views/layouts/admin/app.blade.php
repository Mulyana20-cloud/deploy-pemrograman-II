<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - BeautyStore</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Alpine.js untuk fitur toggle responsive sidebar mobile -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100 font-sans antialiased" x-data="{ sidebarOpen: false }">

    <div class="min-h-screen flex flex-col md:flex-row">

        <!-- Mobile Sidebar Overlay (Background gelap saat sidebar terbuka di HP) -->
        <div 
            x-show="sidebarOpen" 
            @click="sidebarOpen = false" 
            class="fixed inset-0 z-40 bg-black bg-opacity-50 md:hidden"
            x-transition.opacity
        ></div>

        <!-- Sidebar (Responsive: Hidden di mobile, muncul jika sidebarOpen true, permanen di layar md ke atas) -->
        <aside 
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed inset-y-0 left-0 z-50 w-64 bg-white shadow-lg transform transition-transform duration-300 ease-in-out md:translate-x-0 md:static md:inset-auto md:flex-shrink-0 flex flex-col"
        >
            @include('layouts.admin.sidebar')
        </aside>

        <!-- Main Content Wrapper -->
        <div class="flex-1 flex flex-col min-w-0 min-h-screen">

            <!-- Navbar / Header (Dilengkapi tombol hamburger untuk toggle sidebar di HP) -->
            <header class="bg-white shadow-sm sticky top-0 z-30 flex items-center justify-between px-4 py-3 md:px-6">
                <!-- Tombol Trigger Sidebar Mobile -->
                <button @click="sidebarOpen = !sidebarOpen" class="md:hidden text-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-300 rounded-lg p-1">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>

                <!-- Load Navbar bawaan Anda -->
                <div class="flex-1 ml-2 md:ml-0">
                    @include('layouts.admin.navbar')
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="flex-1 w-full max-w-7xl mx-auto p-4 md:p-8">
                @if(session('success'))
                <div id="alert-success" class="mb-5 rounded-xl bg-green-100 px-5 py-3 text-green-700 shadow-sm transition duration-500">
                    {{ session('success') }}
                </div>
                @endif

                @if(session('error'))
                <div id="alert-error" class="mb-5 rounded-xl bg-red-100 px-5 py-3 text-red-700 shadow-sm transition duration-500">
                    {{ session('error') }}
                </div>
                @endif

                @yield('content')
            </main>

        </div>

    </div>

    <!-- Script otomatis untuk menghilangkan alert setelah beberapa detik -->
    <script>
        setTimeout(function(){
            ['alert-success', 'alert-error'].forEach(function(id){
                let alert = document.getElementById(id);
                if(alert){
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                }
            });
        }, 5000);
    </script>

</body>
</html>