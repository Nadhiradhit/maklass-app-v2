@section('title', 'Verifikasi Email')
<x-layouts.layout-auth>
    <div class="flex flex-col-reverse md:flex-row-reverse items-stretch justify-center w-full max-w-6xl min-h-[500px] md:min-h-[600px] lg:min-h-[700px] transition-opacity opacity-100 duration-750 starting:opacity-0 border border-gray-100 rounded-xl overflow-hidden shadow-[0_8px_30px_rgb(0,0,0,0.06)]">
        <div class="bg-white shadow-md rounded-lg p-6 w-full flex flex-col items-center justify-center">
            <h2 class="text-2xl font-bold text-center mb-4">Verifikasi Email</h2>
            <p class="text-gray-600 text-sm mb-6 text-center">
                Sebelum melanjutkan, silakan verifikasi email Anda dengan mengklik tautan yang telah kami kirimkan ke email Anda.
            </p>
            <div class="w-full max-w-md flex items-center justify-center flex-col md:flex-row gap-4">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <x-form.button type="submit" class="w-full">
                        Kirim Ulang Tautan Verifikasi
                    </x-form.button>
                </form>
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <x-form.button type="submit" class="w-full">
                        Logout
                    </x-form.button>
                </form>
            </div>
        </div>

    </div>
</x-layouts.layout-auth>
