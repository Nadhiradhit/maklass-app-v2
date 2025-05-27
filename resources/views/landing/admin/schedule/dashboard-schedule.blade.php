@section('title', 'Jadwal Lab')

@extends('components.layouts.layout-dashboard')

@php
    $currentPath = request()->path();
@endphp

@section('content')
    <div class="px-3 sm:px-4 lg:px-6 py-4 sm:py-6 md:py-8 mx-auto">
        <div class="flex gap-4 font-semibold">
            <a href="{{ route('landing.admin.room.dashboard') }}" class="text-2xl {{ str_contains($currentPath, 'room') ? 'border-b-2 border-secondary-800 text-secondary-800' : 'text-secondary-800 hover:text-secondary-700 active:text-secondary-200' }}">Ruangan Lab</a>
            <a href="{{ route('landing.admin.schedule.dashboard') }}" class="text-2xl {{ str_contains($currentPath, 'schedule') ? 'border-b-2 border-secondary-800 text-secondary-800' : 'text-secondary-800 hover:text-secondary-700 active:text-secondary-200' }}">Jadwal Lab</a>
        </div>

        <div class="flex justify-end my-4">
            <a href="{{ route('landing.admin.schedule.dashboard', ['show_modal' => true]) }}" class="bg-secondary-800 text-white px-4 py-2 rounded-md cursor-pointer hover:bg-secondary-700">
                Tambah Jadwal
            </a>
        </div>

        <div>

        </div>
    </div>
@endsection
