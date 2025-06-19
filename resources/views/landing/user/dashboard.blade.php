@section('title', 'Dashboard User')

@extends('components.layouts.layout-dashboard')

@section('content')
<div>
    @php
        use Carbon\Carbon;
        $currentDate = Carbon::now()->locale('id');
        $formattedDate = $currentDate->translatedFormat('l, d F Y');
    @endphp
    <div class="px-3 xs:px-4 sm:px-6 md:px-10 lg:px-14 xl:px-20 py-4 sm:py-6 md:py-8 mx-auto">
        <h1 class="text-2xl xs:text-3xl sm:text-4xl font-bold text-secondary-900 mb-4 sm:mb-6 md:mb-8">
            Ruangan Maklass
        </h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 xs:gap-4 md:gap-6 lg:gap-8 mt-2">
            <div class="bg-white shadow-md rounded-xl overflow-hidden transition-all duration-300 hover:shadow-lg">
                <div class="p-3 xs:p-4 sm:p-5 md:p-6">
                    <h3 class="text-lg xs:text-xl sm:text-2xl md:text-3xl font-bold text-secondary-900">Ruangan Kosong</h3>
                    <p class="text-sm xs:text-base sm:text-lg md:text-xl text-secondary-700 font-semibold mt-1">{{ $formattedDate }}</p>

                    <div class="relative h-16 xs:h-20 sm:h-24 md:h-28 lg:h-32 mt-2 sm:mt-4">
                        <h1 class="text-4xl xs:text-5xl sm:text-6xl md:text-7xl lg:text-8xl font-bold text-[#1D4766] absolute right-0 bottom-0">
                            {{ $roomData->count() }}
                        </h1>
                    </div>
                </div>
            </div>

            <div class="bg-secondary-800 shadow-lg rounded-xl overflow-hidden transition-all duration-300 hover:shadow-xl">
                <div class="p-3 xs:p-4 sm:p-5 md:p-6">
                    <h3 class="text-lg xs:text-xl sm:text-2xl md:text-3xl font-bold text-white">Ruangan Terpakai</h3>
                    <p class="text-sm xs:text-base sm:text-lg md:text-xl text-white font-semibold mt-1">{{ $formattedDate }}</p>

                    <div class="relative h-16 xs:h-20 sm:h-24 md:h-28 lg:h-32 mt-2 sm:mt-4">
                        <h1 class="text-4xl xs:text-5xl sm:text-6xl md:text-7xl lg:text-8xl font-bold text-white absolute right-0 bottom-0">
                            {{ $roomData->count() }}
                        </h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 xs:gap-4 md:gap-6 lg:gap-8 mt-2">
            <div class="bg-white shadow-md rounded-xl overflow-hidden transition-all duration-300 hover:shadow-lg">
                <div class="p-3 xs:p-4 sm:p-5 md:p-6">
                    <h3 class="text-lg xs:text-xl sm:text-2xl md:text-3xl font-bold text-secondary-900">Monitor Peminjaman Ruangan Lab</h3>
                </div>
                <p>ini monitor peminjaman ruangan lab</p>
            </div>

            <div class="bg-white shadow-md rounded-xl overflow-hidden transition-all duration-300 hover:shadow-lg">
                <div class="p-3 xs:p-4 sm:p-5 md:p-6">
                    <h3 class="text-lg xs:text-xl sm:text-2xl md:text-3xl font-bold text-secondary-900">Permintaan Peminjaman</h3>
                </div>
                <div>
                    @foreach ($bookingData as $item)
                    @php
                        \Carbon\Carbon::setLocale('id');
                        setlocale(LC_TIME, 'id_ID.UTF-8', 'id_ID', 'indonesian');
                        $startDate = $item->booking_start_datetime
                            ? \Carbon\Carbon::parse($item->booking_start_datetime)->locale('id')
                            : null;
                        $endDate = $item->booking_end_datetime
                            ? \Carbon\Carbon::parse($item->booking_end_datetime)->locale('id')
                            : null;
                    @endphp
                    <div class="p-3 xs:p-4 sm:p-5 md:p-6 flex justify-between">
                        <p class="text-sm md:text-lg font-bold text-secondary-900">{{ $item->purpose }}</p>
                        <p class="text-sm md:text-lg text-secondary-700 font-semibold mt-1">{{ $item->room->name }}</p>
                        <p class="text-sm md:text-lg text-secondary-700 font-semibold mt-1">{{ $startDate ? $startDate->isoFormat('dddd, DD MMMM YYYY') : '-' }}</p>
                        <p class="text-sm md:text-lg text-secondary-700 font-semibold mt-1">@if($item->status == 'pending')
                            <span class="px-2 py-1 text-sm md:text-lg font-semibold rounded-full bg-yellow-100 text-yellow-800">Menunggu</span>
                            @elseif($item->status == 'approved')
                            <span class="px-2 py-1 text-sm md:text-lg font-semibold rounded-full bg-green-100 text-green-800">Disetujui</span>
                            @elseif($item->status == 'rejected')
                            <span class="px-2 py-1 text-sm md:text-lg font-semibold rounded-full bg-red-100 text-red-800">Ditolak</span>
                            @else
                            -
                            @endif
                        </p>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>

    </div>
</div>
@endsection
