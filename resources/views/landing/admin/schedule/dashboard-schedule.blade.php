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

        <div class="flex justify-end my-4 w-full">
            <a href="{{ route('landing.admin.schedule.dashboard', ['show_modal' => true]) }}" class="bg-secondary-800 text-white px-4 py-2 rounded-md cursor-pointer hover:bg-secondary-700 w-full md:w-auto">
                Tambah Jadwal Pembelajaran
            </a>
        </div>

        @if (request('show_modal'))
            <div class="fixed inset-0 bg-gray-900/70 bg-opacity-50 overflow-y-auto h-auto w-full z-50 flex items-center justify-center">
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
                                <input type="text" name="title_schedule" id="title_schedule"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-secondary-500 focus:ring-secondary-500 p-2 @error('title_schedule') border-red-500 @enderror"
                                    value="{{ old('title_schedule') }}">
                                @error('title_schedule')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="md:w-1/2 w-full">
                                <label for="lecturer_name" class="block text-sm font-medium text-gray-700">Dosen :</label>
                                <input type="text" name="lecturer_name" id="lecturer_name"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-secondary-500 focus:ring-secondary-500 p-2 @error('lecturer_name') border-red-500 @enderror"
                                    value="{{ old('lecturer_name') }}">
                                @error('lecturer_name')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="mt-4">
                            <label for="description" class="block text-sm font-medium text-gray-700">Keperluan :</label>
                            <textarea name="description" id="description" rows="3"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-secondary-500 focus:ring-secondary-500 p-2 @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <label for="semester_id" class="block text-sm font-medium text-gray-700">Semester :</label>
                            <select name="semester_id" id="semester_id" {{-- Corrected name from 'semester' to 'semester_id' --}}
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-secondary-500 focus:ring-secondary-500 p-2 @error('semester_id') border-red-500 @enderror">
                                <option value="">Pilih Semester</option>
                                @foreach ($semesters as $semester)
                                    <option value="{{ $semester->id }}" {{ old('semester_id') == $semester->id ? 'selected' : '' }}>{{ $semester->name }}</option>
                                @endforeach
                            </select>
                            @error('semester_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <label for="schedule_day_of_week" class="block text-sm font-medium text-gray-700">Hari Mata Kuliah :</label>
                            {{-- Changed to a select dropdown for controlled input based on your validation rule 'in:Senin,Selasa,Rabu,Kamis,Jumat' --}}
                            <select name="schedule_day_of_week" id="schedule_day_of_week"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-secondary-500 focus:ring-secondary-500 p-2 @error('schedule_day_of_week') border-red-500 @enderror">
                                <option value="">Pilih Hari</option>
                                @foreach (['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'] as $day)
                                    <option value="{{ $day }}" {{ old('schedule_day_of_week') == $day ? 'selected' : '' }}>{{ $day }}</option>
                                @endforeach
                            </select>
                            @error('schedule_day_of_week')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex flex-col md:flex-row gap-4 mt-4">
                            <div class="md:w-1/2 w-full">
                                <label for="schedule_start_time" class="block text-sm font-medium text-gray-700">Mulai Jam Mata Kuliah :</label>
                                <input type="time" name="schedule_start_time" id="schedule_start_time"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-secondary-500 focus:ring-secondary-500 p-2 @error('schedule_start_time') border-red-500 @enderror"
                                    value="{{ old('schedule_start_time') }}" required>
                                @error('schedule_start_time')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                                <span id="start-datetime-error" class="text-red-500 text-xs"></span>
                            </div>
                            <div class="md:w-1/2 w-full">
                                <label for="schedule_end_time" class="block text-sm font-medium text-gray-700">Selesai Jam Mata Kuliah :</label>
                                <input type="time" name="schedule_end_time" id="schedule_end_time"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-secondary-500 focus:ring-secondary-500 p-2 @error('schedule_end_time') border-red-500 @enderror"
                                    value="{{ old('schedule_end_time') }}" required>
                                @error('schedule_end_time')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                                <span id="end-datetime-error" class="text-red-500 text-xs"></span>
                            </div>
                        </div>
                        <div class="mt-4">
                            <label for="room_laboratory_id" class="block text-sm font-medium text-gray-700">Ruangan :</label>
                            <select name="room_laboratory_id" id="room_laboratory_id"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-secondary-500 focus:ring-secondary-500 p-2 @error('room_laboratory_id') border-red-500 @enderror">
                                <option value="">Pilih Ruangan</option>
                                @foreach ($rooms as $room)
                                    <option value="{{ $room->id }}" {{ old('room_laboratory_id') == $room->id ? 'selected' : '' }}>{{ $room->name }}</option>
                                @endforeach
                            </select>
                            @error('room_laboratory_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
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
                        <th scope="col" class="px-6 py-3 w-20">
                            No
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nama Ruangan
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Mata Kuliah
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Jadwal Mata Kuliah
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Semester
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Dosen
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($schedules as $schedule)
                        <tr class="border-gray-200 odd:bg-white even:bg-gray-100 text-center">
                            <td scope="row" class="px-6 py-4 whitespace-nowrap">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $schedule->room->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $schedule->title_schedule }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $schedule->schedule_day_of_week }}, {{ $schedule->schedule_start_time }} - {{ $schedule->schedule_end_time }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $schedule->semester->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $schedule->lecturer_name }}
                            </td>
                            <td class="px-6 py-6 space-x-2">
                                {{-- <a href="{{ route('landing.admin.schedule.dashboard', ['update_id' => $schedule->id])}}" class="text-blue-600 hover:underline">Ubah</a>
                                @if(request('update_id') == $schedule->id)
                                    <div class="fixed inset-0 bg-gray-900/70 bg-opacity-50 overflow-y-auto h-full w-full z-50 flex items-center justify-center">
                                        <div class="relative p-5 border w-full max-w-md mx-4 shadow-lg rounded-md bg-white">
                                            <div class="mt-3">
                                                <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Ubah Jadwal Mata Kuliah</h3>
                                                <form action="{{ route('landing.admin.schedule.update', $schedule->id) }}" method="POST" class="space-y-4 text-start">
                                                    @csrf
                                                    @method('PUT')
                                                    <div>
                                                        <label for="name" class="block text-sm font-medium text-gray-700">Jadwal Mata Kuliah</label>
                                                        <input type="text" name="title_schedule" id="title_schedule" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-secondary-500 focus:ring-secondary-500 p-2" value="{{ $schedule->title_schedule }}">
                                                    </div>
                                                    <div>
                                                        <label for="lecturer_name" class="block text-sm font-medium text-gray-700">Nama Dosen:</label>
                                                        <input type="text" name="lecturer_name" id="lecturer_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-secondary-500 focus:ring-secondary-500 p-2" value="{{ $schedule->lecturer_name }}">
                                                    </div>
                                                    <div class="flex justify-end space-x-3 mt-5">
                                                        <a href="{{ route('landing.admin.schedule.dashboard') }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">
                                                        Batal
                                                        </a>
                                                        <button type="submit" class="px-4 py-2 bg-secondary-800 text-white rounded-md hover:bg-secondary-700">
                                                            Simpan
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endif --}}
                                <a href="{{ route('landing.admin.schedule.dashboard', ['delete_id' => $schedule->id]) }}" class="text-red-600 hover:underline">Hapus</a>
                                @if(request('delete_id') == $schedule->id)
                                <div class="fixed inset-0 bg-gray-900/70 bg-opacity-50 overflow-y-auto h-full w-full z-50 flex items-center justify-center">
                                    <div class="relative p-5 border w-96 shadow-lg rounded-md bg-white">
                                        <div class="mt-3">
                                            <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Konfirmasi Hapus</h3>
                                            <p class="mb-4">Apakah Anda yakin ingin menghapus data ini?</p>
                                            <form action="{{ route('landing.admin.schedule.delete', $schedule->id) }}" method="POST" class="flex justify-end space-x-3">
                                                @csrf
                                                @method('DELETE')
                                                <a href="{{ route('landing.admin.schedule.dashboard') }}"
                                                   class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">
                                                    Batal
                                                </a>
                                                <button type="submit"
                                                        class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </td>
                            {{-- <td class="px-6 py-4 text-center">
                                <a href="{{ route('landing.admin.schedule.edit', $schedule->id) }}" class="text-blue-600 hover:text-blue-800">Edit</a>
                                <form action="{{ route('landing.admin.schedule.delete', $schedule->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 ml-2">Hapus</button>
                                </form>
                            </td> --}}
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4">Tidak ada jadwal yang tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
