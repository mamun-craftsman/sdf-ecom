@php
	use App\Models\Farmer;
	$id = Auth::guard('farmer')->id();
	$farmer = Farmer::findOrFail($id);
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farmer Admin Panel</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <style>
        @keyframes slideIn {
            from {
                transform: translateX(-100%);
            }
            to {
                transform: translateX(0);
            }
        }

        @keyframes slideOut {
            from {
                transform: translateX(0);
            }
            to {
                transform: translateX(-100%);
            }
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 10;
            display: none;
        }
    </style>
</head>
<body class="bg-[#D9EAF7]">
    <div class="overlay" id="overlay"></div>
    <div class="flex items-stretch min-h-screen">
        <!-- Sidebar -->
        <aside id="sidebar" class="bg-[#353535] text-white w-64 fixed h-auto overflow-y-auto transition-all transform -translate-x-full md:translate-x-0 md:relative md:flex-shrink-0 z-20">
            <div class="p-4 flex flex-col items-center relative">
                <button id="closeSidebar" class="absolute top-[-20px] right-2 text-white text-[55px] md:hidden">&times;</button>
                <img src="{{asset('/storage/'.$farmer->image)}}" class="rounded-full mb-4 w-[140px] h-[140px] object-center" alt="Company Logo">
                <a href="#" class="text-sm text-[#FF6B01]">কৃষক: {{$farmer->name}}</a>
                <div class="flex flex-col items-center space-y-2 mt-3 mb-6">
                    <!-- Verification Status -->
                    <button class="text-[10px] px-1 rounded-full text-white {{ $farmer->is_verified == 1 ? 'bg-green-500' : 'bg-red-500' }}">
                        {{ $farmer->is_verified == 1 ? 'ভেরিফায়েড' : 'ভেরিফায়েড না' }}
                    </button>
                
                    <!-- Payable Status -->
                    <button class="text-[10px] px-1 rounded-full text-white bg-blue-500">
                        পাওনা: {{ $farmer->payable }}৳
                    </button>
                
                    <!-- Due Status -->
                    <button class="text-[10px] px-1 rounded-full text-white bg-orange-500">
                        দেনা: {{ $farmer->due }}৳
                    </button>
                </div>
                
            </div>
            <nav>
                <ul class="space-y-2">
                    <li>
                        <a href="{{route('farmer.index')}}" class="block p-4 hover:bg-[#FF6B01] flex items-center">
                            <svg class="w-6 h-6 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v4m0 0H3a1 1 0 01-1-1v-2m2 3h3a1 1 0 001-1v-4m0 0H3m9-5v2m3 2v2m-6-6V5a1 1 0 011-1h4a1 1 0 011 1v7m4-6h2a2 2 0 012 2v10a2 2 0 01-2 2h-2a2 2 0 01-2-2V5a1 1 0 011-1h2a1 1 0 011 1v2" />
                            </svg>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <button class="block p-4 w-full text-left hover:bg-[#FF6B01] flex justify-between items-center" onclick="toggleDropdown('productsDropdown')">
                            <span class="flex items-center">
                                <img width="22" height="22" class="mr-2" src="https://img.icons8.com/ios/50/FFFFFF/eggplant.png" alt="eggplant"/>
                                Products
                            </span>
                            <span>&#9662;</span>
                        </button>
                        <ul id="productsDropdown" class="ml-4 mt-2 space-y-1 hidden">
                            <li><a href="#" class="block p-2 hover:bg-[#FF6B01]">My Products</a></li>
                            <li><a href="#" class="block p-2 hover:bg-[#FF6B01]">Sell Product</a></li>
                        </ul>
                    </li>
                    <li>
                        <button class="block p-4 w-full text-left hover:bg-[#FF6B01] flex justify-between items-center" onclick="toggleDropdown('ordersDropdown')">
                            <span class="flex items-center">
                                <img width="22" height="22" class="mr-2" src="https://img.icons8.com/ios/50/FFFFFF/pickup.png" alt="pickup"/>
                                Orders
                            </span>
                            <span>&#9662;</span>
                        </button>
                        <ul id="ordersDropdown" class="ml-4 mt-2 space-y-1 hidden">
                            <li><a href="#" class="block p-2 hover:bg-[#FF6B01]">Pending Orders</a></li>
                            <li><a href="#" class="block p-2 hover:bg-[#FF6B01]">All Orders</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="block p-4 hover:bg-[#FF6B01] flex items-center">
                            <img width="22" height="22" class="mr-2" src="https://img.icons8.com/ios/50/FFFFFF/mental-state.png" alt="mental-state"/>
                            Help Center
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Top Navbar -->
            <header class="bg-white shadow-md px-2 py-1 flex justify-between items-center">
                <button id="sidebarToggle" class="text-[#353535] p-2 focus:outline-none md:hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>
                <a href="{{route('home.index')}}">
                    <img src="{{asset('/home/images/logo-t.png')}}" class="w-[120px]" alt="Grameen Bazaar logo">
                </a>
                
                <div class="relative">
                    <button id="profileToggle" class="focus:outline-none">
                        <img src="{{asset('/storage/'.$farmer->image)}}" class="rounded-full w-[40px] h-[40px]" alt="Profile">
                    </button>
                    <div id="profileMenu" class="hidden absolute right-0 bg-white shadow-md mt-2 py-2 w-40 rounded-md">
                        <a href="{{route('farmer.edit')}}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Profile</a>
                        <a href="#" class="block px-4 py-2 text-[red] hover:bg-gray-100">Logout</a>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 p-6">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        // Sidebar toggle functionality
        $(document).ready(function () {
            const sidebar = $('#sidebar');
            const overlay = $('#overlay');

            $('#sidebarToggle').on('click', function () {
                sidebar.removeClass('-translate-x-full');
                sidebar.css('animation', 'slideIn 0.3s forwards');
                overlay.show();
            });

            $('#closeSidebar, #overlay').on('click', function () {
                sidebar.css('animation', 'slideOut 0.3s forwards');
                setTimeout(() => sidebar.addClass('-translate-x-full'), 300);
                overlay.hide();
            });

            // Profile dropdown toggle
            $('#profileToggle').on('click', function () {
                $('#profileMenu').toggleClass('hidden');
            });
        });

        // Dropdown toggle for sidebar menus
        function toggleDropdown(id) {
            let dropdown = document.getElementById(id);
            dropdown.classList.toggle('hidden');
        }
    </script>
    @stack('scripts')
</body>
</html>
