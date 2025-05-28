@section ('title', 'Dashboard User')

@extends('components.layouts.layout-dashboard')

@php
    $currentPath = request()->path();

    $today = \Carbon\Carbon::now()->toDateString();
    $week = \Carbon\Carbon::now()->addDays(7)->toDateString();
@endphp

@section('content')
    <div class="px-3 sm:px-4 lg:px-6 py-4 sm:py-6 md:py-8 mx-auto">
        <h1 class="text-2xl font-semibold text-secondary-900">Reservasi Ruangan Laboratorium</h1>

        <div class="flex justify-between mt-8 mb-4">
            <div class="flex gap-4 font-semibold text-lg items-center">
                <a href="{{ route('landing.user.room.room-booking') }}" class="{{ str_contains($currentPath, 'booking') ? 'border-b-2 border-secondary-800 text-secondary-800' : 'text-secondary-800 hover:text-secondary-700 active:text-secondary-200' }}">Ruangan Lab</a>
                <a href="{{ route('landing.admin.schedule.dashboard') }}" class="{{ str_contains($currentPath, 'schedule') ? 'border-b-2 border-secondary-800 text-secondary-800' : 'text-secondary-800 hover:text-secondary-700 active:text-secondary-200' }}">List Permintaan</a>
            </div>

            <a href="{{ route('landing.user.room.room-booking', ['show_modal' => true]) }}" class="bg-secondary-800 text-white px-4 py-2 rounded-md cursor-pointer hover:bg-secondary-700">
                Peminjaman Lab
            </a>
        </div>

        <h2 class="text-2xl font-semibold">Peminjaman Ruangan</h2>

        @if(request('show_modal'))
            <div class="fixed inset-0 bg-gray-900/70 bg-opacity-50 overflow-y-auto h-full w-full z-50 flex items-center justify-center">
                <div class="relative p-5 border w-full md:w-1/2 shadow-lg rounded-md bg-white">
                    <div class="mt-3">
                        <h3 class="text-lg font-semibold leading-6 text-gray-900 mb-4">Tambah Peminjaman Lab</h3>
                        <form action="{{ route('landing.user.room.room-booking.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="flex flex-col md:flex-row gap-4 mt-4">
                                <div class="md:w-1/2 w-full">
                                    <label for="activity" class="block text-sm font-medium text-gray-700">Acara atau kegiatan :</label>
                                    <input type="text" name="activity" id="activity" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-secondary-500 focus:ring-secondary-500 p-2">
                                </div>
                                <div class="md:w-1/2 w-full">
                                    <label for="responsible" class="block text-sm font-medium text-gray-700">Penanggung jawab :</label>
                                    <input type="text" name="responsible" id="responsible" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-secondary-500 focus:ring-secondary-500 p-2">
                                </div>
                            </div>
                            <div class="mt-4">
                                <label for="purpose" class="block text-sm font-medium text-gray-700">Keperluan :</label>
                                <textarea name="purpose" id="purpose" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-secondary-500 focus:ring-secondary-500 p-2"></textarea>
                            </div>
                            <div class="flex flex-col md:flex-row gap-4 mt-4">
                                <div class="md:w-1/2 w-full">
                                    <label for="date_booking" class="block text-sm font-medium text-gray-700">Hari dan tanggal :</label>
                                    <input type="date" name="date_booking" id="date_booking" min="{{ $today }}" max="{{ $week }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-secondary-500 focus:ring-secondary-500 p-2">
                                    <span id="date-error" class="text-red-500 text-xs"></span>
                                </div>
                                <div class="md:w-1/2 w-full">
                                    <label for="time_booking" class="block text-sm font-medium text-gray-700">Waktu :</label>
                                    <select name="time_booking" id="time_booking" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-secondary-500 focus:ring-secondary-500 p-2" required>
                                        <option value="">Pilih Waktu</option>
                                        <optgroup label="Pagi">
                                            <option value="07:30 - 08:30">07:30 - 08:30</option>
                                            <option value="08:30 - 09:30">08:30 - 09:30</option>
                                            <option value="09:30 - 10:00">09:30 - 10:00</option>
                                            <option value="10:30 - 11:30">10:30 - 11:30</option>
                                            <option value="11:30 - 12:00">11:30 - 12:00</option>
                                        </optgroup>
                                        <optgroup label="Istirahat">
                                            <option value="10:00 - 10:30" disabled>10:00 - 10:30 (Istirahat)</option>
                                            <option value="12:00 - 13:00" disabled>12:00 - 13:00 (Istirahat Siang)</option>
                                        </optgroup>
                                        <optgroup label="Siang">
                                            <option value="13:00 - 14:00">13:00 - 14:00</option>
                                            <option value="14:00 - 15:00">14:00 - 15:00</option>
                                            <option value="15:00 - 16:00">15:00 - 16:00</option>
                                            <option value="16:00 - 17:00">16:00 - 17:00</option>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                            <div class="mt-4">
                                <label for="room_laboratory_id" class="block text-sm font-medium text-gray-700">Ruangan yang akan dipinjam :</label>
                                <select name="room_laboratory_id" id="room_laboratory_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-secondary-500 focus:ring-secondary-500 p-2">
                                    <option value="">Pilih Ruangan</option>
                                    @foreach($laboratories as $lab)
                                        <option value="{{ $lab->id }}">{{ $lab->name }} ({{ $lab->room }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mt-4">
                                <label for="file_attachment" class="block text-sm font-medium text-gray-700">Lampiran :</label>
                                <input type="file" placeholder="Lampiran" name="file_attachment" id="file_attachment" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-secondary-500 focus:ring-secondary-500 p-2">
                            </div>
                            <div class="flex justify-end space-x-3 mt-5">
                                <a href="{{ route('landing.user.room.room-booking') }}"
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

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-8">
            <table class="w-full text-sm text-left rtl:text-right text-secondary-800">
                <thead class="text-xs text-white uppercase bg-secondary-800 h-20">
                    <tr class="text-center">
                        <th scope="col" class="px-6 py-3 w-20">No</th>
                        <th scope="col" class="px-6 py-3">Kegiatan</th>
                        <th scope="col" class="px-6 py-3">Penanggung Jawab</th>
                        <th scope="col" class="px-6 py-3">Keperluan</th>
                        <th scope="col" class="px-6 py-3">Ruangan</th>
                        <th scope="col" class="px-6 py-3">Tanggal</th>
                        <th scope="col" class="px-6 py-3">Waktu</th>
                        <th scope="col" class="px-6 py-3">Status</th>
                        <th scope="col" class="px-6 py-3">Lampiran</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach($data as $index => $data)
                        <tr class="bg-white border-b hover:bg-secondary-50">
                            <td class="px-6 py-4 text-center">{{ $index + 1 }}</td>
                            <td class="px-6 py-4">
                                {{ $data->activity }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $data->responsible }}
                            </td>
                            <td>
                                {{ $data->purpose}}
                            </td>
                            <td class="px-6 py-4">
                                {{ $data->room->name }} ({{ $data->room->room }})
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{ \Carbon\Carbon::parse($data->date_booking)->format('d F Y') }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{ $data->time_booking }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($data->status == 'pending')
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        Pending
                                    </span>
                                @elseif($data->status == 'approved')
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                        Approved
                                    </span>
                                @else
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                        Rejected
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($data->file_attachment)
                                    <a href="{{ asset('storage/attachments/' . $data->file_attachment) }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                        Lihat Lampiran
                                    </a>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dateInput = document.getElementById('date_booking');
            const errorSpan = document.getElementById('date-error');

            dateInput.addEventListener('input', function() {
                const date = new Date(this.value);
                const day = date.getDay(); // 0 = Sunday, 6 = Saturday

                if (day === 0 || day === 6) {
                    errorSpan.textContent = "Tidak bisa memilih hari Sabtu atau Minggu.";
                    this.value = '';
                } else {
                    errorSpan.textContent = "";
                }
            });
        });
    </script>
@endsection
