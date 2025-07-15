@section('title', 'Dashboard Admin')

@extends('components.layouts.layout-dashboard')

@php
    use Carbon\Carbon;
    $currentDate = Carbon::now()->locale('id');
    $formattedDate = $currentDate->translatedFormat('l, d F Y');


@endphp

@section('content')
    <div class="px-3 xs:px-4 sm:px-6 md:px-10 lg:px-14 xl:px-20 py-4 sm:py-6 md:py-8 mx-auto ">
        <h1 class="text-3xl font-semibold">Overview Ruangan Lab</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 xs:gap-4 md:gap-6 lg:gap-8 mt-2">
            <div class="bg-secondary-800 shadow-lg rounded-xl overflow-hidden transition-all duration-300 hover:shadow-xl">
                <div class="p-3 xs:p-4 sm:p-5 md:p-6">
                    <h3 class="text-lg xs:text-xl sm:text-2xl md:text-3xl font-bold text-white">Ruangan Kosong</h3>
                    <p class="text-sm xs:text-base sm:text-lg md:text-xl text-white font-semibold mt-1">{{ $formattedDate }}</p>

                    <div class="relative h-16 xs:h-20 sm:h-24 md:h-28 lg:h-32 mt-2 sm:mt-4">
                        <h1 class="text-4xl xs:text-5xl sm:text-6xl md:text-7xl lg:text-8xl font-bold text-white absolute right-0 bottom-0">
                            {{ $emptyRoomsCount }}
                        </h1>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow-md rounded-xl overflow-hidden transition-all duration-300 hover:shadow-lg">
                <div class="p-3 xs:p-4 sm:p-5 md:p-6">
                    <h3 class="text-lg xs:text-xl sm:text-2xl md:text-3xl font-bold text-secondary-900">Ruangan Terpakai</h3>
                    <p class="text-sm xs:text-base sm:text-lg md:text-xl text-secondary-700 font-semibold mt-1">{{ $formattedDate }}</p>

                    <div class="relative h-16 xs:h-20 sm:h-24 md:h-28 lg:h-32 mt-2 sm:mt-4">
                        <h1 class="text-4xl xs:text-5xl sm:text-6xl md:text-7xl lg:text-8xl font-bold text-[#1D4766] absolute right-0 bottom-0">
                            {{ $occupiedRoomsCount }}
                        </h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6">
            <h1 class="text-3xl font-semibold">Notifikasi Peminjaman</h1>
            <div class="bg-white shadow-lg rounded-xl overflow-hidden transition-all duration-300 hover:shadow-xl h-full md:h-[800px] mt-4">
                @forelse ($data as $item => $data)
                <div class="flex md:flex-row flex-col md:items-center justify-between gap-4 px-6">
                    <h4 class="text-lg font-semibold">Ruangan {{ $data->room->name }}</h4>
                    <div class="flex md:flex-row flex-col gap-4 justify-between md:items-center">
                        <h6 class="text-sm font-semibold">{{ $data->user->name }}</h6>
                        @php
                        \Carbon\Carbon::setLocale('id');
                        setlocale(LC_TIME, 'id_ID.UTF-8', 'id_ID', 'indonesian');
                        $startDate = $data->booking_start_datetime
                            ? \Carbon\Carbon::parse($data->booking_start_datetime)->locale('id')
                            : null;
                        $endDate = $data->booking_end_datetime
                            ? \Carbon\Carbon::parse($data->booking_end_datetime)->locale('id')
                            : null;
                        @endphp
                        <h6 class="text-sm font-semibold">{{ $startDate ? $startDate->isoFormat('dddd, DD MMMM YYYY') : '-' }}</h6>
                        <h6>{{ $data->booking_start_datetime ? \Carbon\Carbon::parse($data->booking_start_datetime)->format('H:i') . ' - ' . \Carbon\Carbon::parse($data->booking_end_datetime)->format('H:i') : '-'}}</h6>
                        <div class="py-6 md:p-6 text-center">
                            <button class="px-4 py-2 bg-secondary-800 text-white rounded-md hover:bg-secondary-700 w-full">
                                <a href="{{ route('landing.admin.booking.dashboard') }}">Lihat Detail</a>
                            </button>
                        </div>
                    </div>
                </div>
                @empty
                    <p class="p-6 text-gray-600">Belum ada request dari user!</p>
                @endforelse

                @if ($totalPendingBookingsCount >= 5)
                    <div class="p-6">
                        <button class="px-4 py-2 bg-secondary-800 text-white rounded-md hover:bg-secondary-700">
                            <a href="{{ route('landing.admin.booking.dashboard') }}" class="text-sm">Lihat Semua</a>
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
