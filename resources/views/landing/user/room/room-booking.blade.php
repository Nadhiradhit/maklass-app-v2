@section ('title', 'Dashboard User')

@extends('components.layouts.layout-dashboard')

@php
    $currentPath = request()->path();
    $today = \Carbon\Carbon::now()->toDateString();
    $week = \Carbon\Carbon::now()->addDays(7)->toDateString();
    $groupedData = $data->groupBy('status');
@endphp

@section('content')
    <div class="px-3 sm:px-4 lg:px-6 py-4 sm:py-6 md:py-8 mx-auto">
        <h1 class="text-xl md:text-2xl font-semibold text-secondary-900">Reservasi Ruangan Laboratorium</h1>

        <div class="flex flex-col md:flex-row md:justify-between mt-8 mb-4 gap-4">
            <div class="flex gap-4 font-semibold text-lg items-center">
                <a href="{{ route('landing.user.room.room-booking') }}" class="{{ str_contains($currentPath, 'booking') ? 'border-b-2 border-secondary-800 text-secondary-800' : 'text-secondary-800 hover:text-secondary-700 active:text-secondary-200' }}">List Permintaan</a>
                {{-- <a href="#" class="{{ str_contains($currentPath, 'schedule') ? 'border-b-2 border-secondary-800 text-secondary-800' : 'text-secondary-800 hover:text-secondary-700 active:text-secondary-200' }}">Ruangan Lab</a> --}}
            </div>

            <a href="{{ route('landing.user.room.room-booking', ['show_modal' => true]) }}" class="bg-secondary-800 text-white px-4 py-2 rounded-md cursor-pointer hover:bg-secondary-700">
                Tambah Reservasi Ruangan
            </a>
        </div>

        @if(request('show_modal'))
            <div class="fixed inset-0 bg-gray-900/70 bg-opacity-50 overflow-y-auto h-full w-full z-50 flex items-center justify-center">
                <div class="relative p-5 border w-full md:w-1/2 max-h-[90vh] overflow-y-auto shadow-lg rounded-md bg-white">
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
                        <h3 class="text-lg font-semibold leading-6 text-gray-900 mb-4">Tambah Peminjaman Lab</h3>
                        <form action="{{ route('landing.user.room.room-booking.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="flex flex-col md:flex-row gap-4 mt-4">
                                <div class="md:w-1/2 w-full">
                                    <label for="booking_purpose" class="block text-sm font-medium text-gray-700">Acara atau kegiatan :</label>

                                    <input type="text" name="booking_purpose" id="booking_purpose" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-secondary-500 focus:ring-secondary-500 p-2" value="{{ old('booking_purpose') }}" required>
                                </div>
                                <div class="md:w-1/2 w-full">
                                    <label for="responsible" class="block text-sm font-medium text-gray-700">Penanggung jawab :</label>

                                    <input type="text" name="responsible" id="responsible" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-secondary-500 focus:ring-secondary-500 p-2" value="{{ old('responsible') }}">
                                </div>
                            </div>
                            <div class="mt-4">
                                <label for="purpose" class="block text-sm font-medium text-gray-700">Keperluan :</label>

                                <textarea name="purpose" id="purpose" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-secondary-500 focus:ring-secondary-500 p-2">{{ old('purpose') }}</textarea>
                            </div>

                            <div class="flex flex-col md:flex-row gap-4 mt-4">
                                <div class="md:w-1/2 w-full">
                                    <label for="booking_start_datetime" class="block text-sm font-medium text-gray-700">Mulai Peminjaman :</label>

                                    <input type="datetime-local" name="booking_start_datetime" id="booking_start_datetime"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-secondary-500 focus:ring-secondary-500 p-2" value="{{ old('booking_start_datetime') }}" required>
                                    <span id="start-datetime-error" class="text-red-500 text-xs">
                                        @error('booking_start_datetime')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="md:w-1/2 w-full">
                                    <label for="booking_end_datetime" class="block text-sm font-medium text-gray-700">Selesai Peminjaman :</label>

                                    <input type="datetime-local" name="booking_end_datetime" id="booking_end_datetime"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-secondary-500 focus:ring-secondary-500 p-2" value="{{ old('booking_end_datetime') }}" required>
                                    <span id="end-datetime-error" class="text-red-500 text-xs">
                                        @error('booking_end_datetime')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="mt-4">
                                <label for="room_laboratory_id" class="block text-sm font-medium text-gray-700">Ruangan yang akan dipinjam :</label>
                                <select name="room_laboratory_id" id="room_laboratory_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-secondary-500 focus:ring-secondary-500 p-2" required>
                                    <option value="">Pilih Ruangan</option>
                                    @foreach($laboratories as $lab)

                                        <option value="{{ $lab->id }}" {{ old('room_laboratory_id') == $lab->id ? 'selected' : '' }}>{{ $lab->name }} {{ $lab->room }}</option>
                                    @endforeach
                                </select>
                                @error('room_laboratory_id')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mt-4">
                                <label for="file_attachment" class="block text-sm font-medium text-gray-700">Lampiran (Surat Permohonan Peminjaman Ruangan yang sudah ditandatangani oleh pimpinan Polimedia):</label>

                                <input type="file" name="file_attachment" id="file_attachment" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-secondary-500 focus:ring-secondary-500 p-2">
                                @error('file_attachment')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="flex justify-end space-x-3 mt-5">
                                <a href="{{ route('landing.user.room.room-booking') }}"
                                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">
                                    Batal
                                </a>
                                <button type="submit" id="submit-booking"
                                    class="px-4 py-2 bg-secondary-800 text-white rounded-md hover:bg-secondary-700">
                                    Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif

        <div class="w-full m5-4">
            @foreach ($groupedData as $status => $items)
                <div class="mb-8">
                    @php
                        $statusTitle = '';
                        $statusClass = '';
                        switch ($status) {
                            case 'pending':
                                $statusTitle = 'Menunggu Persetujuan';
                                $statusClass = 'bg-yellow-200 text-yellow-800';
                                break;
                            case 'approved':
                                $statusTitle = 'Disetujui';
                                $statusClass = 'bg-green-200 text-green-800';
                                break;
                            case 'rejected':
                                $statusTitle = 'Ditolak';
                                $statusClass = 'bg-red-200 text-red-800';
                                break;
                            default:
                                $statusTitle = ucfirst($status);
                                $statusClass = 'bg-gray-200';
                        }
                    @endphp
                    <h3 class="text-xl font-semibold mb-4 capitalize">{{ $statusTitle }}</h3>
                    @forelse ($items as $item)
                        <div class="bg-white shadow-md rounded-lg p-4 mb-4 hover:shadow-lg transition-shadow duration-200">
                            <div class="bg-secondary-50 md:p-4 flex flex-col items-start md:flex-row md:items-center justify-between gap-4">
                                <div>
                                    <h2 class="font-semibold text-lg text-secondary-900">{{$item->booking_purpose}}</h2>
                                    <p>Penanggung Jawab: {{$item->responsible}}</p>
                                    <p>Keperluan: {{$item->purpose}}</p>
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
                                    <p>Tanggal Peminjaman: {{ $startDate ? $startDate->isoFormat('dddd, DD MMMM YYYY') : '-' }}</p>
                                    <p>Waktu Peminjaman: {{ $item->booking_start_datetime ? \Carbon\Carbon::parse($item->booking_start_datetime)->format('H:i') . ' - ' . \Carbon\Carbon::parse($item->booking_end_datetime)->format('H:i') : '-'}}</p>
                                    @if($item->status == 'rejected')
                                        <p class="text-red-600">Alasan Penolakan: {{ $item->reason }}</p>
                                    @endif
                                </div>
                                <div class="{{ $statusClass }} px-3 py-2 rounded-md text-center">
                                    <p>{{ $statusTitle }}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-600">Tidak ada peminjaman dengan status "{{ $statusTitle }}".</p>
                    @endforelse
                </div>
            @endforeach
        </div>



    </div>
@endsection
