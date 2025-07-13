@extends('components.layouts.layout-dashboard')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="px-3 sm:px-4 lg:px-6 py-4 sm:py-6 md:py-8 mx-auto">
        <h1 class="text-2xl font-semibold text-secondary-900">Permintaan Peminjaman Ruangan Lab</h1>

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
                        <th scope="col" class="px-6 py-3">Peminjam</th>
                        <th scope="col" class="px-6 py-3">Kegiatan</th>
                        <th scope="col" class="px-6 py-3">Penanggung Jawab</th>
                        <th scope="col" class="px-6 py-3">Ruangan</th>
                        <th scope="col" class="px-6 py-3">Tanggal Peminjaman</th>
                        <th scope="col" class="px-6 py-3">Status</th>
                        <th scope="col" class="px-6 py-3">Lampiran</th>
                        <th scope="col" class="px-6 py-3"></th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    {{-- Loop through the paginated data --}}
                    @forelse($data as $booking) {{-- Changed $data to $booking for clarity within the loop --}}
                        <tr class="bg-white border-b hover:bg-secondary-50">
                            <td class="px-6 py-4 text-center">
                                {{ $loop->iteration + ($data->currentPage() - 1) * $data->perPage() }}
                            </td>
                            <td>
                                {{ $booking->user->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $booking->booking_purpose }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $booking->responsible }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $booking->room->name }} {{ $booking->room->room }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{ $booking->booking_start_datetime ? \Carbon\Carbon::parse($booking->booking_start_datetime)->format('d F Y') : '-' }}
                            </td>
                            <td>
                                @if($booking->status == 'pending')
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        Menunggu
                                    </span>
                                @elseif($booking->status == 'approved')
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                        Disetujui
                                    </span>
                                @else
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                        Ditolak
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($booking->file_attachment)
                                    <a href="{{ asset('storage/attachments/' . $booking->file_attachment) }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                        Lihat Lampiran
                                    </a>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td>
                                <div class="flex justify-center">
                                    <a href="{{ route('landing.admin.booking.dashboard', ['detail_id' => $booking->id]) }}" class="py-2 px-4 bg-secondary-800 text-white rounded hover:bg-secondary-700 transition-colors">
                                        Lihat Detail
                                    </a>
                                    @if(request('detail_id') == $booking->id)
                                        <div class="fixed inset-0 bg-gray-900/70 bg-opacity-50 overflow-y-auto h-full w-full z-50 flex items-center justify-center text-start">
                                            <div class="relative p-5 border w-200 md:w-1/2 shadow-lg rounded-md bg-white">
                                                <div class="flex gap-8">
                                                    <div>
                                                        <h4 class="text-lg">Ruangan Lab</h4>
                                                        <h2 class="text-xl font-semibold">{{ $booking->room->name }}</h2>
                                                    </div>
                                                    <div>
                                                        <h4 class="text-lg">Kegiatan / Acara</h4>
                                                        <h2 class="text-xl font-semibold">{{ $booking->booking_purpose }}</h2>
                                                    </div>
                                                </div>
                                                <div class="flex justify-between items-center mt-4">
                                                    <div>
                                                        <h4 class="text-lg">Penanggung Jawab</h4>
                                                        <h2 class="text-xl font-semibold">{{ $booking->responsible }}</h2>
                                                    </div>
                                                    <div class="">
                                                        <h4 class="text-lg">Jadwal Peminjaman</h4>
                                                        <h2 class="text-xl font-semibold">
                                                            @php
                                                                \Carbon\Carbon::setLocale('id');
                                                                setlocale(LC_TIME, 'id_ID.UTF-8', 'id_ID', 'indonesian');
                                                                $startDate = $booking->booking_start_datetime
                                                                    ? \Carbon\Carbon::parse($booking->booking_start_datetime)->locale('id')
                                                                    : null;
                                                                $endDate = $booking->booking_end_datetime
                                                                    ? \Carbon\Carbon::parse($booking->booking_end_datetime)->locale('id')
                                                                    : null;
                                                            @endphp
                                                            {{ $startDate ? $startDate->isoFormat('dddd, DD MMMM YYYY') : '-' }},
                                                            <br>
                                                            {{ $booking->booking_start_datetime ? \Carbon\Carbon::parse($booking->booking_start_datetime)->format('H:i') : '-' }} -
                                                            {{ $booking->booking_end_datetime ? \Carbon\Carbon::parse($booking->booking_end_datetime)->format('H:i') : '-' }}
                                                        </h2>
                                                    </div>
                                                </div>
                                                <div class="flex flex-col mt-4">
                                                    <h4 class="text-lg">Deskripsi Kegiatan</h4>
                                                    <div class="bg-gray-100 p-4 rounded-md h-32 overflow-y-auto">
                                                        <p class="text-gray-700">{{ $booking->purpose }}</p>
                                                    </div>
                                                </div>

                                                <div class="flex items-center mt-4">
                                                    <h4 class="text-lg">Di buat pada: <span class="font-semibold">{{ $booking->created_at->isoFormat('dddd, DD MMMM YYYY') }}</span></h4>
                                                    @if($booking->status == 'pending')
                                                        <div class="flex space-x-2 ml-auto">
                                                            <form action="{{ route('landing.admin.booking.update', ['id' => $booking->id]) }}" method="post">
                                                                @csrf
                                                                @method('PUT')
                                                                <input type="hidden" name="status" value="approved">
                                                                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition-colors">
                                                                    Approve
                                                                </button>
                                                            </form>

                                                            <form action="{{ route('landing.admin.booking.update', ['id' => $booking->id]) }}" method="POST" class="inline">
                                                                @csrf
                                                                @method('PUT')
                                                                <input type="hidden" name="status" value="rejected">
                                                                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition-colors">
                                                                    Reject
                                                                </button>
                                                            </form>
                                                        </div>
                                                    @else
                                                        <div class="ml-auto">
                                                            @if($booking->status == 'approved')
                                                                <span class="px-4 py-2 bg-green-600 text-white rounded">
                                                                    Disetujui
                                                                </span>
                                                            @elseif($booking->status == 'rejected')
                                                                <span class="px-4 py-2 bg-red-600 text-white rounded">
                                                                    Ditolak
                                                                </span>
                                                            @endif
                                                        </div>
                                                    @endif
                                                </div>
                                                <button class="mt-4 px-4 py-2 bg-secondary-800 text-white rounded hover:bg-secondary-700 transition-colors" onclick="window.location.href='{{ route('landing.admin.booking.dashboard') }}'">Tutup</button>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-6 py-4 text-center">Tidak ada permintaan peminjaman ruangan lab yang tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $data->links() }}
        </div>

    </div>
@endsection
