@section('title', 'Dashboard Admin')

@extends('components.layouts.layout-dashboard')

@section('content')
    <div class="px-3 xs:px-4 sm:px-6 md:px-10 lg:px-14 xl:px-20 py-4 sm:py-6 md:py-8 mx-auto ">
        <h1 class="text-2xl font-semibold">Overview Ruangan Lab</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-20 py-6 h-72 mx-auto">
            @php
                use Carbon\Carbon;
                $currentDate = Carbon::now()->locale('id');
                $formattedDate = $currentDate->translatedFormat('l, d F Y');
            @endphp
        <div class="w-full h-full bg-[#E9FEF9] p-6 rounded-xl">
            <h3 class="text-3xl font-bold text-[#1D4766]">Ruangan yang tersedia</h3>
            <p class="text-2xl text-[#0E7C6D] mt-4">{{ $formattedDate }}</p>
            <div class="relative">
                @foreach ($data as  $item)
                    <h4 class="text-8xl font-bold text-[#1D4766] absolute right-10 bottom-0 top-2">{{ $item->count() }}</h4>
                @endforeach
            </div>
        </div>
        <div class="w-full h-full bg-[#E9FEF9] p-6 rounded-xl">
            <h3 class="text-3xl font-bold text-[#1D4766]">Ruangan yang terpakai</h3>
            <p class="text-2xl text-[#0E7C6D] mt-4">{{ $formattedDate }}</p>
            <div class="relative">
                @foreach ($data as $item)
                    <h4 class="text-8xl font-bold text-[#1D4766] absolute right-10 bottom-0 top-2">{{ $item->count() }}</h4>
                @endforeach
            </div>
        </div>
        </div>

    </div>
@endsection
