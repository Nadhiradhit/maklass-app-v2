<x-layouts.layout-auth>
    <div class="flex items-center justify-center w-full h-[700px] transition-opacity opacity-100 duration-750 lg:grow starting:opacity-0 border-2 rounded-lg overflow-hidden">
        <div class="flex flex-col items-center w-1/2 p-8 z-10">
            <svg width="118" height="66" viewBox="0 0 118 66" fill="none" xmlns="http://www.w3.org/2000/svg">
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
            <h2 class="mt-6 text-4xl font-bold">Masuk Ke <span class="text-secondary-700 uppercase">Maklass</span></h2>
            <form class="w-full max-w-md mt-6">
                <div class="mb-4">
                    <label for="email" class="block text-lg font-semibold text-neutral-900 mb-2">Masukkan Email</label>
                    <input type="email" id="email" class="w-full bg-neutral-200 rounded-lg p-3" placeholder="Masukkan Email Anda">
                </div>
                <div class="mb-6">
                    <label for="password" class="block text-lg font-semibold text-neutral-900 mb-2">Masukkan Password</label>
                    <div class="relative">
                        <input type="password" id="password" class="w-full bg-neutral-200 rounded-lg p-3 pr-10" placeholder="Masukkan Password Anda">
                        <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 pr-3 flex items-center text-neutral-600 cursor-pointer ">
                            <svg xmlns="http://www.w3.org/2000/svg" id="eyeIcon" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" id="eyeSlashIcon" class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                            </svg>
                        </button>
                    </div>
                </div>
                <button type="submit" class="bg-secondary-700 text-neutral-50 p-3 w-full rounded-lg cursor-pointer hover:bg-secondary-800 transition duration-300">
                    Masuk
                </button>
            </form>
        </div>
        <div class="w-1/2 h-full relative">
            <img src="{{ asset('assets/images/login-background-maklass.png') }}" alt="Login Background - Maklass 2025" class="absolute inset-0 h-full w-full object-cover rounded-r-lg">
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const password = document.getElementById('password');
            const togglePassword = document.getElementById('togglePassword');
            const eyeIcon = document.getElementById('eyeIcon');
            const eyeSlashIcon = document.getElementById('eyeSlashIcon');

            togglePassword.addEventListener('click', function() {

                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);


                eyeIcon.classList.toggle('hidden');
                eyeSlashIcon.classList.toggle('hidden');
            });
        });
    </script>
</x-layouts.layout-auth>
