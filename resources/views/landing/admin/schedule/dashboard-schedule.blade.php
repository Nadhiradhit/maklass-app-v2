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

        @if (request('show_modal'))
            <div class="fixed inset-0 bg-gray-900/70 bg-opacity-50 overflow-y-auto h-full w-full z-50 flex items-center justify-center">
                <div class="relative p-5 border w-full md:w-1/2 shadow-lg rounded-md bg-white">
                    <div class="mt-3">
                        <h3 class="text-lg font-semibold leading-6 text-gray-900 mb-4">Tambah Jadwal Baru</h3>
                        <form action="" method="POST">
                            @csrf
                            <div class="flex flex-col md:flex-row gap-4 mt-4">
                                <div class="md:w-1/2 w-full">
                                    <label for="activity" class="block text-sm font-medium text-gray-700">Jadwal pembelajaran :</label>
                                    <input type="text" name="activity" id="activity" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-secondary-500 focus:ring-secondary-500 p-2">
                                </div>
                                <div class="md:w-1/2 w-full">
                                    <label for="responsible" class="block text-sm font-medium text-gray-700">Dosen :</label>
                                    <input type="text" name="responsible" id="responsible" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-secondary-500 focus:ring-secondary-500 p-2">
                                </div>
                            </div>
                            <div class="mt-4">
                                <label for="purpose" class="block text-sm font-medium text-gray-700">Keperluan :</label>
                                <textarea name="purpose" id="purpose" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-secondary-500 focus:ring-secondary-500 p-2"></textarea>
                            </div>
                            <div class="flex justify-end space-x-3 mt-5">
                                <a href="{{ route('landing.admin.schedule.dashboard') }}"
                                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">
                                    Batal
                                </a>
                                <button type="submit"
                                    class="px-4 py-2 bg-secondary-800 text-white rounded-md hover:bg-secondary-700">
                                    Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif

        <div>

        </div>
    </div>
@endsection
