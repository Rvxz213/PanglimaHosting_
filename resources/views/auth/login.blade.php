<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - PanglimaHosting</title>
    
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
</head>
<body class="bg-gradient-to-br from-cyan-50 to-blue-50 min-h-screen flex items-center justify-center">
    <div class="max-w-md w-full space-y-8">
        <div class="text-center">
            <div class="mx-auto w-20 h-20 bg-gradient-to-r from-cyan-500 to-blue-600 rounded-full flex items-center justify-center">
                <i class="fas fa-server text-white text-3xl"></i>
            </div>
            <h2 class="mt-6 text-3xl font-bold text-gray-900">
                PanglimaHosting
            </h2>
            <p class="mt-2 text-sm text-gray-600">
                Admin Panel Login
            </p>
        </div>
        
        <div class="bg-white rounded-lg shadow-xl p-8">
            <form class="space-y-6" action="{{ route('admin.login') }}" method="POST">
                @csrf
                
                @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    <ul class="list-disc list-inside text-sm">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">
                        Email Address
                    </label>
                    <div class="mt-1">
                        <input id="email" name="email" type="email" required 
                               value="{{ old('email') }}"
                               class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-cyan-500 focus:border-cyan-500 focus:z-10 sm:text-sm"
                               placeholder="admin@panglimahosting.com">
                    </div>
                </div>
                
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">
                        Password
                    </label>
                    <div class="mt-1">
                        <input id="password" name="password" type="password" required
                               class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-cyan-500 focus:border-cyan-500 focus:z-10 sm:text-sm"
                               placeholder="Enter your password">
                    </div>
                </div>
                
                <div>
                    <button type="submit" 
                            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 transition duration-200">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <i class="fas fa-sign-in-alt text-cyan-300 group-hover:text-cyan-200"></i>
                        </span>
                        Sign In
                    </button>
                </div>
            </form>
            
            <div class="mt-6 text-center">
                <a href="{{ route('home') }}" class="text-sm text-cyan-600 hover:text-cyan-800">
                    <i class="fas fa-arrow-left mr-1"></i>
                    Kembali ke Website
                </a>
            </div>
        </div>
        
        <div class="text-center text-xs text-gray-500">
            <p>&copy; {{ date('Y') }} PanglimaHosting. All rights reserved.</p>
        </div>
    </div>
</body>
</html> 