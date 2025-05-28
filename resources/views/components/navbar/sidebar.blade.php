<nav x-data="{ openDropdown: null, isMobile: window.innerWidth < 768 }"
     @resize.window="isMobile = window.innerWidth < 768"
     :class="{
         'w-full md:w-[270px]': !isMobile || (isMobile && sidebarOpen),
         'w-0 overflow-hidden': isMobile && !sidebarOpen,
         'fixed inset-y-0 left-0 z-50': isMobile
     }"
     class="bg-[#2C6A89] h-screen transition-all duration-300 rounded-lg-tr rounded-lg-br">

    <!-- Tombol close untuk mobile -->
    <button x-show="isMobile && sidebarOpen"
            @click="sidebarOpen = false"
            class="absolute top-4 right-4 text-white p-1 rounded-full hover:bg-[#1d5a78]">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>

    <div class="px-3 py-4 h-full flex flex-col">
        <div class="py-3">
            <svg width="200" height="35" viewBox="0 0 215 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M38.6175 43.1094C35.3845 46.1887 31.0737 48 26.4037 48.1811H25.6852L20.4764 27.1698L15.0879 5.25283C18.6802 1.99245 23.1706 0 28.0202 0V0.181132L33.2291 21.1925L38.6175 43.1094Z" fill="#7AD2EA"/>
                <path d="M64.4818 42.9283C61.2487 46.0075 57.1176 47.8189 52.6272 48H51.5495V47.6377L46.3406 26.6264L40.9521 5.0717C44.5445 1.81132 49.0349 0 53.8845 0L59.0933 20.8302L64.4818 42.9283Z" fill="#7AD2EA"/>
                <path d="M28.1997 0V0.181132L20.6558 26.9887L18.68 34.0528C16.1654 42.3849 8.62155 48 0 48L9.69925 14.1283C10.7769 10.5057 12.5731 7.42641 15.2673 5.0717C18.68 1.99245 23.1704 0 28.1997 0Z" fill="white"/>
                <path d="M53.8847 0L46.3409 26.6264L44.1855 34.0528C43.1078 37.6755 41.132 40.7547 38.6174 43.1094C35.3843 46.1887 31.0735 48 26.4035 48.1811C26.2239 48.1811 25.8647 48.1811 25.6851 48.1811L33.2289 21.3736L35.2047 14.1283C36.2824 10.5057 38.2582 7.42641 40.9524 5.0717C44.5447 1.81132 49.0351 0 53.8847 0Z" fill="white"/>
                <path d="M79.5698 0L69.8705 34.0528C68.9725 37.4943 66.9967 40.5736 64.4821 42.9283C61.249 46.0075 57.1178 47.8189 52.6274 48C52.2682 48 51.909 48 51.3701 48L51.5497 47.6377L59.0936 20.8302L61.0694 14.1283C63.4044 5.79623 70.9482 0 79.5698 0Z" fill="white"/>
                <path d="M82.4438 38.9434L88.91 16.1207H92.5023L97.352 30.0679H95.5558L108.309 16.1207H111.901L105.435 38.9434H100.405L104.357 24.8151L105.075 24.9962L96.8131 34.0528H93.4004L90.1673 24.9962L91.0654 24.8151L87.1139 38.9434H82.4438Z" fill="white"/>
                <path d="M108.129 38.9434L123.576 16.1207H128.066L130.401 38.9434H125.013L123.576 20.1056H125.372L113.158 38.9434H108.129ZM114.415 34.7773L115.673 30.6113H127.887L126.629 34.7773H114.415Z" fill="white"/>
                <path d="M132.736 38.9434L139.202 16.1207H144.232L137.766 38.9434H132.736ZM146.387 38.9434L140.639 26.9887L152.494 16.1207H158.781L145.489 28.0754L146.028 26.083L152.674 39.1245H146.387V38.9434Z" fill="white"/>
                <path d="M154.829 38.9434L161.295 16.1207H166.325L159.858 38.9434H154.829ZM158.601 38.9434L159.858 34.4151H170.995L169.737 38.9434H158.601Z" fill="white"/>
                <path d="M170.096 38.9434L185.543 16.1207H190.034L192.369 38.9434H186.98L185.543 20.1056H187.339L175.125 38.9434H170.096ZM176.383 34.7773L177.64 30.6113H189.854L188.597 34.7773H176.383Z" fill="white"/>
                <path d="M200.631 39.3056C198.835 39.3056 197.218 38.9434 196.14 38.4C195.063 37.8566 193.985 36.9509 193.267 35.683L197.398 32.4226C197.937 33.3283 198.475 33.8717 199.194 34.4151C199.912 34.9585 200.99 35.1396 202.068 35.1396C203.145 35.1396 204.044 34.9585 204.762 34.5962C205.48 34.2339 205.84 33.6905 206.019 32.966C206.199 32.4226 206.199 31.8792 205.84 31.517C205.48 31.1547 205.121 30.7924 204.582 30.4302C204.044 30.0679 203.325 29.8868 202.786 29.7056C202.068 29.5245 201.529 29.1622 200.81 28.8C200.092 28.4377 199.553 28.0754 199.014 27.532C198.475 26.9887 198.116 26.4453 198.116 25.7207C197.937 24.9962 198.116 23.9094 198.296 22.8226C198.655 21.3736 199.374 20.1056 200.272 19.2C201.17 18.1132 202.427 17.3887 203.684 16.8453C205.121 16.3019 206.558 16.1207 207.995 16.1207C209.612 16.1207 211.049 16.483 212.126 17.0264C213.204 17.5698 214.102 18.2943 214.641 19.2L210.33 22.4604C209.791 21.7358 209.252 21.1924 208.714 20.8302C208.175 20.4679 207.456 20.2868 206.558 20.2868C205.66 20.2868 204.942 20.4679 204.403 20.8302C203.864 21.1924 203.325 21.5547 203.145 22.2792C202.966 22.8226 202.966 23.366 203.325 23.7283C203.684 24.0905 204.044 24.4528 204.582 24.6339C205.121 24.8151 205.84 25.1773 206.379 25.3585C207.097 25.5396 207.815 25.9019 208.354 26.2641C208.893 26.6264 209.612 26.9887 209.971 27.532C210.33 28.0754 210.689 28.8 210.869 29.5245C211.049 30.249 210.869 31.3358 210.689 32.6037C210.15 34.7773 208.893 36.4075 206.917 37.6754C205.66 38.7622 203.325 39.3056 200.631 39.3056Z" fill="white"/>
            </svg>
        </div>

        <div class="pt-16 flex-grow">
            @if(auth()->check())
                @if(auth()->user()->role === 'admin')
                <ul class="space-y-4 text-lg font-semibold text-white">
                    <!-- Dashboard Link -->
                    <li class="flex items-center gap-2 p-2 rounded-md hover:bg-[#1d5a78] w-full">
                        <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_257_1858)">
                                <path d="M4 17.3333H14.6667V4H4V17.3333ZM4 28H14.6667V20H4V28ZM17.3333 28H28V14.6667H17.3333V28ZM17.3333 4V12H28V4H17.3333Z" fill="#FEFEFE"/>
                            </g>
                            <defs>
                                <clipPath id="clip0_257_1858">
                                    <rect width="32" height="32" fill="white"/>
                                </clipPath>
                            </defs>
                        </svg>
                        <x-navbar.nav-link :active="request()->routeIs('dashboard-admin')" href="/dashboard-admin" class="block">
                            Beranda
                        </x-navbar.nav-link>
                    </li>

                    {{-- Dropdown List Link --}}
                    <div x-data="{ openDropdown: false }" class="w-full">
                        <li class="relative cursor-pointer">
                            <button @click="openDropdown = !openDropdown"
                                    class="flex items-center justify-between w-full rounded-md p-2 hover:bg-[#1d5a78] cursor-pointer">
                                <span class="flex items-center gap-2">
                                    <svg width="24" height="24" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_257_1846)">
                                            <path d="M23.9997 2.66669H7.99967C6.53301 2.66669 5.33301 3.86669 5.33301 5.33335V26.6667C5.33301 28.1334 6.53301 29.3334 7.99967 29.3334H23.9997C25.4663 29.3334 26.6663 28.1334 26.6663 26.6667V5.33335C26.6663 3.86669 25.4663 2.66669 23.9997 2.66669ZM7.99967 5.33335H14.6663V16L11.333 14L7.99967 16V5.33335Z" fill="#FEFEFE"/>
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_257_1846">
                                                <rect width="32" height="32" fill="white"/>
                                            </clipPath>
                                        </defs>
                                    </svg>
                                    <span>Manajemen Lab</span>
                                </span>
                                <svg :class="{'transform rotate-180': openDropdown }" class="w-4 h-4 transition-transform duration-300" fill="currentColor"viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                            <ul x-show="openDropdown"
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 transform -translate-y-2"
                                x-transition:enter-end="opacity-100 transform translate-y-0"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 transform translate-y-0"
                                x-transition:leave-end="opacity-0 transform -translate-y-2"
                                class="p-2 w-full bg-[#1d5a78] rounded-md space-y-4 mt-2">
                                <li class="pl-8 py-1 hover:bg-[#246b8f] rounded-md transition-colors duration-200">
                                    <x-navbar.nav-link :active="request()->routeIs('landing.admin.room.dashboard')" href="{{ route('landing.admin.room.dashboard') }}">
                                        Monitoring Ruangan Lab
                                    </x-navbar.nav-link>
                                </li>
                                <li class="pl-8 py-1 hover:bg-[#246b8f] rounded-md transition-colors duration-200">
                                    <x-navbar.nav-link :active="request()->routeIs('landing.admin.booking.dashboard')" href="{{ route('landing.admin.booking.dashboard')}}">
                                        Permintaan Ruangan Lab
                                    </x-navbar.nav-link>
                                </li>
                            </ul>
                        </li>
                        <li class="flex items-center gap-2 p-2 rounded-md hover:bg-[#1d5a78] w-full transition-all duration-300"
                            :class="{ 'mt-4': openDropdown, 'mt-4': !openDropdown }">
                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_257_2290)">
                                    <path d="M22 16C23.84 16 25.32 14.5067 25.32 12.6667C25.32 10.8267 23.84 9.33335 22 9.33335C20.16 9.33335 18.6666 10.8267 18.6666 12.6667C18.6666 14.5067 20.16 16 22 16ZM12 14.6667C14.2133 14.6667 15.9866 12.88 15.9866 10.6667C15.9866 8.45335 14.2133 6.66669 12 6.66669C9.78663 6.66669 7.99996 8.45335 7.99996 10.6667C7.99996 12.88 9.78663 14.6667 12 14.6667ZM22 18.6667C19.56 18.6667 14.6666 19.8934 14.6666 22.3334V25.3334H29.3333V22.3334C29.3333 19.8934 24.44 18.6667 22 18.6667ZM12 17.3334C8.89329 17.3334 2.66663 18.8934 2.66663 22V25.3334H12V22.3334C12 21.2 12.44 19.2134 15.16 17.7067C14 17.4667 12.88 17.3334 12 17.3334Z" fill="#FEFEFE"/>
                                </g>
                                <defs>
                                    <clipPath id="clip0_257_2290">
                                        <rect width="32" height="32" fill="white"/>
                                    </clipPath>
                                </defs>
                            </svg>
                            <x-navbar.nav-link :active="request()->routeIs('landing.admin.user.dashboard')" href="{{ route('landing.admin.user.dashboard') }}">
                                Manage User
                            </x-navbar.nav-link>
                        </li>
                    </div>
                </ul>
                @elseif (auth()->user()->role === 'user')
                <ul class="space-y-8 text-lg font-semibold text-white">

                    <li class="flex items-center gap-2 p-2 rounded-md hover:bg-[#1d5a78]">
                        <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_257_1858)">
                                <path d="M4 17.3333H14.6667V4H4V17.3333ZM4 28H14.6667V20H4V28ZM17.3333 28H28V14.6667H17.3333V28ZM17.3333 4V12H28V4H17.3333Z" fill="#FEFEFE"/>
                            </g>
                            <defs>
                                <clipPath id="clip0_257_1858">
                                    <rect width="32" height="32" fill="white"/>
                                </clipPath>
                            </defs>
                        </svg>
                        <x-navbar.nav-link :active="request()->routeIs('landing.user.dashboard')" href="{{ route('landing.user.dashboard') }}" class="block">
                            Beranda
                        </x-navbar.nav-link>
                    </li>

                    <li class="flex items-center gap-2 p-2 rounded-md hover:bg-[#1d5a78]">
                         <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_257_1858)">
                                <path d="M4 17.3333H14.6667V4H4V17.3333ZM4 28H14.6667V20H4V28ZM17.3333 28H28V14.6667H17.3333V28ZM17.3333 4V12H28V4H17.3333Z" fill="#FEFEFE"/>
                            </g>
                            <defs>
                                <clipPath id="clip0_257_1858">
                                    <rect width="32" height="32" fill="white"/>
                                </clipPath>
                            </defs>
                        </svg>
                        <x-navbar.nav-link :active="request()->routeIs('landing.user.schedule.dashboard')" href="{{ route('landing.user.schedule.dashboard') }}" class="block">
                            Jadwal Lab
                        </x-navbar.nav-link>
                    </li>

                    {{-- Dropdown List Link --}}
                    <div x-data="{ openDropdown: false }" class="w-full">
                        <li class="relative cursor-pointer">
                            <button @click="openDropdown = !openDropdown" class="flex items-center justify-between w-full rounded-md p-2 hover:bg-[#1d5a78] cursor-pointer">
                                <span class="flex items-center gap-2">
                                    <svg width="24" height="24" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_257_1846)">
                                            <path d="M23.9997 2.66669H7.99967C6.53301 2.66669 5.33301 3.86669 5.33301 5.33335V26.6667C5.33301 28.1334 6.53301 29.3334 7.99967 29.3334H23.9997C25.4663 29.3334 26.6663 28.1334 26.6663 26.6667V5.33335C26.6663 3.86669 25.4663 2.66669 23.9997 2.66669ZM7.99967 5.33335H14.6663V16L11.333 14L7.99967 16V5.33335Z" fill="#FEFEFE"/>
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_257_1846">
                                                <rect width="32" height="32" fill="white"/>
                                            </clipPath>
                                        </defs>
                                    </svg>
                                    <span>Cari Kelas</span>
                                </span>
                                <svg :class="{ 'transform rotate-180': openDropdown === 'class' }" class="w-4 h-4 transition-transform" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                            <ul x-show="openDropdown"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 transform -translate-y-2"
                            x-transition:enter-end="opacity-100 transform translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 transform translate-y-0"
                            x-transition:leave-end="opacity-0 transform -translate-y-2" class="p-2 absolute w-full h-auto bg-[#1d5a78] rounded-md space-y-2 mt-4">
                                <li class="pl-8 py-1 hover:bg-[#246b8f] rounded-md transition-colors duration-200">
                                    <x-navbar.nav-link :active="request()->routeIs('landing.user.room.room-booking')" href="{{ route('landing.user.room.room-booking')}}">
                                        Permintaan Ruangan Kelas
                                    </x-navbar.nav-link>
                                </li>
                            </ul>
                        </li>
                    </div>
                </ul>
                @endif
            @endif
        </div>


        <form method="POST" action="{{ route('logout') }}" class="w-full">
            @csrf
            <button type="submit" class="flex items-center gap-2 w-full text-left px-2 py-2 hover:bg-[#1d5a78] rounded-md transition-colors duration-200 text-white font-semibold">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                    <polyline points="16 17 21 12 16 7"></polyline>
                    <line x1="21" y1="12" x2="9" y2="12"></line>
                </svg>
                <span>Logout</span>
            </button>
        </form>

    </div>


</nav>
