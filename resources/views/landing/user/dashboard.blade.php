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

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 xs:gap-4 md:gap-6 lg:gap-8 mt-10">
            <div class="bg-white shadow-md rounded-xl overflow-hidden transition-all duration-300 hover:shadow-lg w-full h-full px-4 py-6">
                <div class="flex justify-between">
                    <div class="flex items-center gap-4">
                        <svg width="42" height="43" viewBox="0 0 42 43" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect y="0.5" width="42" height="42" rx="8" fill="#1B4D71"/>
                            <path d="M31.6667 9.5H10.3334C8.86669 9.5 7.66669 10.7 7.66669 12.1667V26.8333C7.66669 28.3 8.86669 29.5 10.3334 29.5H14.3334L13 30.8333V33.5H29V30.8333L27.6667 29.5H31.6667C33.1334 29.5 34.3334 28.3 34.3334 26.8333V12.1667C34.3334 10.7 33.1334 9.5 31.6667 9.5ZM31.6667 26.8333H10.3334V12.1667H31.6667V26.8333Z" fill="#FEFEFE"/>
                            </svg>
                        <h3 class="text-2xl font-bold text-[#1D4766]">Class Monitoring</h3>
                    </div>
                </div>
                <div class="grid grid-cols-5 gap-4 mt-4">
                    @foreach ($roomData as $item)
                    <div class="flex flex-col items-center justify-center rounded-lg size-28 transition-all duration-200
                    @if($item->status === 'booked')
                        bg-red-100 hover:bg-red-200 border-2 border-red-300
                    @else
                        bg-green-100 hover:bg-green-200 border-2 border-green-300
                    @endif">
                            <p class="text-lg font-semibold text-neutral-950">{{ $item->room }}</p>
                        </div>
                    @endforeach
                </div>
                <div class="flex justify-end">
                    <div class="flex items-center gap-2 mt-4 mr-4">
                        <div class="bg-red-500 size-4 rounded"></div>
                        <p>Ruangan Terpakai</p>
                    </div>
                    <div>
                        <div class="flex items-center gap-2 mt-4 mr-4">
                            <div class="bg-green-500 size-4 rounded"></div>
                            <p>Ruangan Tersedia</p>
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <a href="#" class="text-sm font-semibold text-white bg-gray-600 px-4 py-2 rounded-md">See All</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
