<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    @vite("resources/css/app.css", "resources/js/app.js")
</head>
<body class="overflow-hidden">

    <div class="flex h-screen font-plus-jakarta" x-data="{ sidebarOpen: false }">

        <x-navbar.sidebar :sidebarOpen="'sidebarOpen'"/>

        <div class="flex-grow flex flex-col overflow-y-auto">
            <header class="flex items-center justify-between px-3 sm:px-4 lg:px-6 py-3 xs:py-4 sm:h-16 md:h-18 lg:h-20 shadow-sm sticky top-0 bg-white z-10">
                <div class="flex items-center">
                    <button @click="sidebarOpen = !sidebarOpen" class="md:hidden mr-4 text-secondary-900">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    <h1 class="text-lg xs:text-xl sm:text-2xl md:text-3xl text-secondary-900 font-bold">
                        Selamat Datang Di Maklass
                    </h1>
                </div>

                <div class="flex items-center w-auto justify-end xs:w-auto">
                    <svg width="32" height="32" viewBox="0 0 42 42" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 xs:w-9 xs:h-9 sm:w-10 sm:h-10 md:w-11 md:h-11 lg:w-12 lg:h-12">
                        <g clip-path="url(#clip0_257_997)">
                            <path d="M20.6118 20.6117C24.4078 20.6117 27.4824 17.5371 27.4824 13.7411C27.4824 9.94513 24.4078 6.87054 20.6118 6.87054C16.8158 6.87054 13.7412 9.94513 13.7412 13.7411C13.7412 17.5371 16.8158 20.6117 20.6118 20.6117ZM20.6118 24.047C16.0257 24.047 6.87061 26.3487 6.87061 30.9176V34.3529H34.353V30.9176C34.353 26.3487 25.1979 24.047 20.6118 24.047Z" fill="#1B4D71"/>
                        </g>
                        <defs>
                            <clipPath id="clip0_257_997">
                                <rect width="41.2235" height="41.2235" fill="white"/>
                            </clipPath>
                        </defs>
                    </svg>
                    <div class="text-secondary-900 ml-2">
                        @auth
                            <h4 class="text-sm xs:text-base sm:text-lg font-semibold truncate max-w-32 xs:max-w-none">{{ auth()->user()->name }}</h4>
                            <p class="text-xs sm:text-sm font-normal">As User</p>
                        @endauth
                    </div>
                </div>
            </header>
            <main class="p-4 flex-grow">
                @yield('content')
            </main>
        </div>
    </div>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

</body>
</html>
