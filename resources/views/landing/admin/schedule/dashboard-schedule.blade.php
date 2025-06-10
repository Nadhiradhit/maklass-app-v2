@section('title', 'Jadwal Lab')

@extends('components.layouts.layout-dashboard')

@php
    $currentPath = request()->path();
    $today = \Carbon\Carbon::now()->toDateString();
    $week = \Carbon\Carbon::now()->addDays(7)->toDateString();
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
                    <div>
                        @if(session('success'))
                            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                                <span class="block sm:inline">{{ session('success') }}</span>
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                    <div class="mt-3">
                        <h3 class="text-lg font-semibold leading-6 text-gray-900 mb-4">Tambah Jadwal Baru</h3>
                        <form action="{{ route('landing.admin.schedule.create') }}" method="POST">
                            @csrf
                            <div class="flex flex-col md:flex-row gap-4 mt-4">
                                <div class="md:w-1/2 w-full">
                                    <label for="title_schedule" class="block text-sm font-medium text-gray-700">Mata kuliah :</label>
                                    <input type="text" name="title_schedule" id="title_schedule" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-secondary-500 focus:ring-secondary-500 p-2">
                                </div>
                                <div class="md:w-1/2 w-full">
                                    <label for="lecturer" class="block text-sm font-medium text-gray-700">Dosen :</label>
                                    <input type="text" name="lecturer" id="lecturer" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-secondary-500 focus:ring-secondary-500 p-2">
                                </div>
                            </div>
                            <div class="mt-4">
                                <label for="description" class="block text-sm font-medium text-gray-700">Keperluan :</label>
                                <textarea name="description" id="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-secondary-500 focus:ring-secondary-500 p-2"></textarea>
                            </div>
                            <div class="flex flex-col md:flex-row gap-4 mt-4">
                                <div class="md:w-1/2 w-full">
                                    <label for="schedule_start_datetime" class="block text-sm font-medium text-gray-700">Mulai Jam Mata Kuliah :</label>
                                    <input type="datetime-local" name="schedule_start_datetime" id="schedule_start_datetime"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-secondary-500 focus:ring-secondary-500 p-2" required>
                                    <span id="start-datetime-error" class="text-red-500 text-xs"></span>
                                </div>
                                <div class="md:w-1/2 w-full">
                                    <label for="schedule_end_datetime" class="block text-sm font-medium text-gray-700">Selesai Jam Mata Kuliah :</label>
                                    <input type="datetime-local" name="schedule_end_datetime" id="schedule_end_datetime"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-secondary-500 focus:ring-secondary-500 p-2" required>
                                    <span id="end-datetime-error" class="text-red-500 text-xs"></span>
                                </div>
                            </div>
                            <div class="mt-4">
                                <label for="room_laboratory_id" class="block text-sm font-medium text-gray-700">Ruangan :</label>
                                <select name="room_laboratory_id" id="room_laboratory_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-secondary-500 focus:ring-secondary-500 p-2">
                                    <option value="">Pilih Ruangan</option>
                                    @foreach ($rooms as $room)
                                        <option value="{{ $room->id }}">{{ $room->name }}</option>
                                    @endforeach
                                </select>
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

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-8">
            <table class="w-full text-sm text-left rtl:text-right text-secondary-800">
                <thead class="text-xs text-white uppercase bg-secondary-800 h-20">
                    <tr class="text-center">
                        <th scope="col" class="px-6 py-3 w-20 ">
                            No
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nama Ruangan
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Jadwal Pembelajaran
                        </th>
                        <th scope="col" class="px-6 py-3 w-1/3">
                            Deskripsi
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Dosen
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection
