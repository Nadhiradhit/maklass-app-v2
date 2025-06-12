@section('title', 'Jadwal Lab')

@extends('components.layouts.layout-dashboard')

@php
    $dayOrder = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];

@endphp

@section('content')
    <div class="px-3 sm:px-4 lg:px-6 py-4 sm:py-6 md:py-8 mx-auto ">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h1 class="text-2xl font-semibold text-secondary-900">Jadwal Pemakaian Lab</h1>
                <h2 class="text-lg text-secondary-600 mt-1">Berikut adalah jadwal pemakaian lab yang telah terdaftar.</h2>
            </div>
        </div>
        <div class="mt-4">
            @foreach ($dayOrder as $day)
    <div class="mb-6">
        <h1 class="text-xl font-semibold text-secondary-800 mb-2">{{ $day }}</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            @if($groupedCombinedData->has($day) && $groupedCombinedData->get($day)->isNotEmpty())
                @php
                    $itemsForThatDay = $groupedCombinedData->get($day);
                @endphp
                @foreach ($itemsForThatDay as $data)
                    <div class="bg-white shadow-md rounded-lg p-4 mb-4 hover:shadow-lg transition-shadow duration-200
                        @if($data['type'] === 'booking') border-l-4 border-blue-500 @else border-l-4 border-green-500 @endif">
                        <h2 class="text-lg font-semibold text-secondary-800 mb-2">
                            @if($data['type'] === 'booking')
                                <i class="fas fa-calendar-alt text-blue-600"></i>
                            @else
                                <i class="fas fa-chalkboard-teacher text-green-600"></i>
                            @endif
                            {{ $data['title'] }}
                        </h2>
                        <div class="space-y-1">
                            <p class="text-sm text-secondary-600">
                                <span class="font-medium">
                                    @if($data['type'] === 'booking')
                                        Peminjam:
                                    @else
                                        Dosen Pengajar:
                                    @endif
                                </span> {{ $data['lecturer_name'] }}
                            </p>
                            @if($data['type'] === 'booking')
                                <p class="text-sm text-secondary-600">
                                    <span class="font-medium">Hari Pelaksanaan:</span> {{ $data['day_name'] }}
                                </p>
                            @endif
                            <p class="text-sm text-secondary-600">
                                <span class="font-medium">Waktu Pelaksanaan:</span>
                                @if($data['type'] === 'booking')
                                    {{ $data['start_time'] }} - {{ $data['end_time'] }}
                                @else
                                    {{ $data['start_time'] }} - {{ $data['end_time'] }}
                                @endif

                            </p>
                            <p class="text-sm text-secondary-600">
                                <span class="font-medium">Ruangan:</span> {{ $data['room_name'] }}
                            </p>
                        </div>
                    </div>
                @endforeach
            @else
        </div>
            <div class="bg-gray-50 rounded-lg p-4 mb-4">
                <p class="text-secondary-800 italic text-center">Belum ada jadwal atau peminjaman untuk hari {{ $day }}</p>
            </div>
        @endif
    </div>
    @endforeach
        </div>
    </div>
@endsection
