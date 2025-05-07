@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@section('title', 'Register Maklass')

<x-layouts.layout-auth>
    <div class="flex flex-col-reverse md:flex-row-reverse items-stretch justify-center w-full max-w-6xl min-h-[500px] md:min-h-[600px] lg:min-h-[700px] transition-opacity opacity-100 duration-750 starting:opacity-0 border border-gray-100 rounded-xl overflow-hidden shadow-[0_8px_30px_rgb(0,0,0,0.06)]">

        <div class="flex flex-col items-center justify-center w-full md:w-1/2 p-4 sm:p-6 md:p-8 z-10">
            <svg width="118" height="66" viewBox="0 0 118 66" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-14 w-14 sm:h-16 sm:w-16 md:h-20 md:w-20 lg:h-24 lg:w-24">
                <g clip-path="url(#clip0_534_5172)">
                    <path d="M57.2687 59.2755C52.4741 63.5094 46.0813 66 39.1558 66.2491H38.0903L30.3657 37.3585L22.3748 7.22264C27.7021 2.73962 34.3612 0 41.5531 0V0.249057L49.2777 29.1396L57.2687 59.2755Z" fill="#7AD2EA"/>
                    <path d="M95.6252 59.0264C90.8307 63.2604 84.7042 65.7509 78.0451 66H76.4469V65.5019L68.7223 36.6113L60.7313 6.97358C66.0586 2.49057 72.7178 0 79.9097 0L87.6343 28.6415L95.6252 59.0264Z" fill="#7AD2EA"/>
                    <path d="M41.8194 0V0.249057L30.6321 37.1094L27.702 46.8226C23.9729 58.2792 12.7856 66 0 66L14.3837 19.4264C15.9819 14.4453 18.6456 10.2113 22.6411 6.97358C27.702 2.73962 34.3612 0 41.8194 0Z" fill="#16677C"/>
                    <path d="M79.9097 0L68.7224 36.6113L65.526 46.8226C63.9278 51.8038 60.9978 56.0377 57.2687 59.2755C52.4741 63.5094 46.0813 66 39.1558 66.2491C38.8894 66.2491 38.3567 66.2491 38.0903 66.2491L49.2777 29.3887L52.2077 19.4264C53.8059 14.4453 56.7359 10.2113 60.7314 6.97358C66.0587 2.49057 72.7179 0 79.9097 0Z" fill="#16677C"/>
                    <path d="M118 0L103.616 46.8226C102.284 51.5547 99.3544 55.7887 95.6252 59.0264C90.8307 63.2604 84.7042 65.7509 78.0451 66C77.5124 66 76.9796 66 76.1805 66L76.4469 65.5019L87.6343 28.6415L90.5643 19.4264C94.027 7.96981 105.214 0 118 0Z" fill="#16677C"/>
                </g>
                <defs>
                    <clipPath id="clip0_534_5172">
                        <rect width="118" height="66" fill="white"/>
                    </clipPath>
                </defs>
            </svg>
            <h2 class="mt-4 sm:mt-6 text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold text-center">Daftar Ke <span class="text-secondary-700 uppercase">Maklass</span></h2>

            <form class="w-full max-w-sm sm:max-w-md mt-4 sm:mt-6 px-2 sm:px-0" method="POST" action="{{ route('register.submit') }}">
                @csrf

                <x-form.input
                    type="text"
                    id="name"
                    name="name"
                    label="Masukkan Nama"
                    placeholder="Masukkan nama anda"
                    :value="old('name')"
                    class="@error('name') border-red-500 @enderror"
                    required
                />

                <x-form.input
                    type="email"
                    id="email"
                    name="email"
                    label="Masukkan Email Polimedia"
                    placeholder="Masukkan email anda"
                    :value="old('email')"
                    pattern="[a-zA-Z0-9._%+-]+@polimedia\.ac\.id"
                    class="@error('email') border-red-500 @enderror"
                    required
                />

                <x-form.input
                    type="password"
                    id="password"
                    name="password"
                    label="Masukkan Password"
                    placeholder="Masukkan password anda"
                    hasToggle="true"
                    class="@error('password') border-red-500 @enderror"
                />

                    {{-- <x-form.input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        label="Konfirmasi Password"
                        placeholder="Konfirmasi password anda"
                        hasToggle="true"
                        class="@error('password_confirmation') border-red-500 @enderror"
                    /> --}}

                <x-form.button type="submit">
                    Daftar
                </x-form.button>
            </form>
            <div class="mt-4 flex gap-2">
                <p class="text-sm sm:text-base text-gray-800">
                    Sudah Punya Akun?
                </p>
                <a href="{{ route('login')}}" class="text-sm sm:text-base text-secondary-700 hover:underline">
                    Masuk
                </a>
            </div>
        </div>

        <div class="w-full md:h-auto md:w-1/2 relative">
            <div class="hidden md:block h-full w-full relative">
                <img src="{{ asset('assets/images/login-background-maklass.png') }}" alt="Register Background - Maklass 2025" class="h-full w-full object-cover rounded-r-lg">
                <div class="absolute flex items-center gap-4 bottom-10 right-15 max-w-md bg-white/90 backdrop-blur-sm p-3 rounded-lg shadow-lg transform hover:translate-y-[-5px] transition-all duration-500">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" class="text-black size-14"><path d="M240-200h120v-240h240v240h120v-360L480-740 240-560v360Zm-80 80v-480l320-240 320 240v480H520v-240h-80v240H160Zm320-350Z"/></svg>
                    <p class="text-sm text-gray-800 leading-relaxed">
                        Maklass merupakan sebuah layanan website untuk ruangan yang berada pada <span class="text-indigo-600">Kampus Polimedia Jakarta.</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-layouts.layout-auth>
