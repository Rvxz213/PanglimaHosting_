<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PanglimaHosting - #1 Hosting Provider')</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'cyan': '#06b6d4',
                        'blue': '#3b82f6',
                        'purple': '#8b5cf6'
                    }
                }
            }
        }
    </script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    @yield('styles')
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <a href="{{ route('home') }}" class="flex items-center">
                            <div class="w-10 h-10 bg-gradient-to-r from-cyan-500 to-blue-600 rounded-lg flex items-center justify-center">
                                <i class="fas fa-server text-white text-xl"></i>
                            </div>
                            <span class="ml-3 text-xl font-bold bg-gradient-to-r from-cyan-600 to-purple-600 bg-clip-text text-transparent">
                                PanglimaHosting
                            </span>
                        </a>
                    </div>
                </div>
                
                <div class="flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-cyan-600 px-3 py-2 rounded-md text-sm font-medium">Beranda</a>
                    <a href="{{ route('products.index') }}" class="text-gray-700 hover:text-cyan-600 px-3 py-2 rounded-md text-sm font-medium">Produk</a>
                    <a href="{{ route('products.index', ['type' => 'vps']) }}" class="text-gray-700 hover:text-cyan-600 px-3 py-2 rounded-md text-sm font-medium">VPS</a>
                    <a href="{{ route('products.index', ['type' => 'hosting']) }}" class="text-gray-700 hover:text-cyan-600 px-3 py-2 rounded-md text-sm font-medium">Hosting</a>
                    <a href="{{ route('cart') }}" class="text-gray-700 hover:text-cyan-600 px-3 py-2 rounded-md text-sm font-medium">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="ml-1">Keranjang</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                {{ session('error') }}
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <main class="min-h-screen">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-lg font-semibold mb-4">PanglimaHosting</h3>
                    <p class="text-gray-300">#1 Hosting Provider di Indonesia</p>
                </div>
                <div>
                    <h4 class="text-md font-semibold mb-4">Layanan</h4>
                    <ul class="space-y-2 text-gray-300">
                        <li><a href="{{ route('products.index', ['type' => 'vps']) }}" class="hover:text-white">VPS</a></li>
                        <li><a href="{{ route('products.index', ['type' => 'hosting']) }}" class="hover:text-white">Shared Hosting</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-md font-semibold mb-4">Dukungan</h4>
                    <ul class="space-y-2 text-gray-300">
                        <li>Email: support@panglimahosting.com</li>
                        <li>WhatsApp: +62 812-3456-7890</li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-md font-semibold mb-4">Ikuti Kami</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-300 hover:text-white"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-gray-300 hover:text-white"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-gray-300 hover:text-white"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-300">
                <p>&copy; {{ date('Y') }} PanglimaHosting. All rights reserved.</p>
            </div>
        </div>
    </footer>

    @yield('scripts')
</body>
</html> 