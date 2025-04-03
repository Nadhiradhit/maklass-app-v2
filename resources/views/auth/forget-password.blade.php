@section('title', 'Login Maklass')

<x-layouts.layout-auth>
    <div class="flex mx-auto items-stretch justify-center w-3xl min-h-[500px] md:min-h-[600px] lg:min-h-[700px] transition-opacity opacity-100 duration-750 starting:opacity-0 border border-gray-100 rounded-xl overflow-hidden shadow-[0_8px_30px_rgb(0,0,0,0.06)]">

        {{-- Alert --}}
        <x-alert />

        {{-- Form Section --}}
        <div class="flex flex-col items-center justify-center w-full p-4 sm:p-6 md:p-8 z-10">
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
            <h2 class="mt-4 sm:mt-6 text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold text-center">Lupa Password <span class="text-secondary-700 uppercase">Maklass</span></h2>

            <form class="w-full max-w-sm sm:max-w-lg mt-4 sm:mt-6 px-2 sm:px-0" method="POST" action="{{ route('reset-password.submit')}}">
                @csrf

                <x-form.input
                    type="email"
                    id="email"
                    name="email"
                    label="Masukkan Email"
                    placeholder="Masukkan Email Anda"
                    :value="old('email')"
                    class="@error('email') border-red-500 @enderror"
                />

                <x-form.input
                    type="password"
                    id="password"
                    name="password"
                    label="Masukkan Password Baru"
                    placeholder="Masukkan Password Baru Anda"
                    hasToggle="true"
                    class="@error('password') border-red-500 @enderror"
                />

                <x-form.input
                    type="password"
                    id="password"
                    name="password_confirmation"
                    label="Masukkan Konfirmasi Password"
                    placeholder="Masukkan Konfirmasi Password Anda"
                    hasToggle="true"
                    class="@error('password') border-red-500 @enderror"
                />

                <x-form.button type="submit">
                    Reset Password
                </x-form.button>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const password = document.getElementById('password');
            const togglePassword = document.getElementById('togglePassword');

            if (togglePassword && password) {
                const eyeIcon = document.getElementById('eyeIcon');
                const eyeSlashIcon = document.getElementById('eyeSlashIcon');

                togglePassword.addEventListener('click', function() {
                    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                    password.setAttribute('type', type);

                    eyeIcon.classList.toggle('hidden');
                    eyeSlashIcon.classList.toggle('hidden');
                });
            }
        });
    </script>
    @endpush
</x-layouts.layout-auth>
