@extends('components.layouts.layout-dashboard')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="px-3 sm:px-4 lg:px-6 py-4 sm:py-6 md:py-8 mx-auto">
        <h1 class="text-2xl font-semibold text-secondary-900">Room Request</h1>


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
                        <th scope="col" class="px-6 py-3">Ruangan</th>
                        <th scope="col" class="px-6 py-3">Tanggal</th>
                        <th scope="col" class="px-6 py-3">Waktu</th>
                        <th scope="col" class="px-6 py-3">Lampiran</th>
                        <th scope="col" class="px-6 py-3"></th>
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
                                @if($data->file_attachment)
                                    <a href="{{ asset('storage/attachments/' . $data->file_attachment) }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                        Lihat Lampiran
                                    </a>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td>
                                <div class="flex justify-center">
                                    <a href="{{ route('landing.admin.booking.dashboard', ['detail_id' =>  $data->id]) }}" class="py-2 px-4 bg-secondary-800 text-white rounded hover:bg-secondary-700 transition-colors">
                                        Lihat
                                    </a>
                                    @if(request('detail_id') == $data->id)
                                        <div class="fixed inset-0 bg-gray-900/70 bg-opacity-50 overflow-y-auto h-full w-full z-50 flex items-center justify-center text-start">
                                            <div class="relative p-5 border w-128 shadow-lg rounded-md bg-white">
                                                <div class="flex gap-4">
                                                    <div>
                                                        <h4 class="text-lg font-semibold">Ruangan Lab</h4>
                                                        <h2 class="text-xl font-semibold">{{ $data->room->name }}</h2>
                                                    </div>
                                                    <div>
                                                        <h4 class="text-lg font-semibold">Kegiatan / Acara</h4>
                                                        <h2 class="text-xl font-semibold">{{ $data->activity }}</h2>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div>
                                                        <h4 class="text-lg font-semibold">Penanggung Jawab</h4>
                                                        <h2 class="text-xl font-semibold">{{ $data->responsible }}</h2>
                                                    </div>
                                                </div>

                                                <p><strong>Penanggung Jawab:</strong> {{ $data->responsible }}</p>
                                                <p><strong>Ruangan:</strong> {{ $data->room->name }} ({{ $data->room->room }})</p>
                                                <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($data->date_booking)->format('d F Y') }}</p>
                                                <p><strong>Waktu:</strong> {{ $data->time_booking }}</p>
                                                <p><strong>Status:</strong>
                                                    @if($data->status == 'pending')
                                                        Pending
                                                    @elseif($data->status == 'approved')
                                                        Approved
                                                    @else
                                                        Rejected
                                                    @endif
                                                </p>
                                                @if($data->file_attachment)
                                                    <p><strong>Lampiran:</strong>
                                                        <a href="{{ asset('storage/attachments/' . $data->file_attachment) }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                                            Lihat Lampiran
                                                        </a>
                                                    </p>
                                                @else
                                                    <span class="text-gray-400">-</span>
                                                @endif
                                                @if($data->status == 'pending')
                                                    <div class="flex space-x-2 mt-4">
                                                        <form action="{{ route('landing.admin.booking.update', ['id' => $data->id]) }}" method="post">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="status" value="approved">
                                                            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition-colors">
                                                                Approve
                                                            </button>
                                                        </form>

                                                        <form action="{{ route('landing.admin.booking.update', ['id' => $data->id]) }}" method="POST" class="inline">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="status" value="rejected">
                                                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition-colors">
                                                                Reject
                                                            </button>
                                                        </form>
                                                    </div>
                                                @else
                                                    <p class="mt-4 text-sm text-gray-500">Status tidak dapat diubah.</p>
                                                @endif
                                                <button class="mt-4 px-4 py-2 bg-secondary-800 text-white rounded hover:bg-secondary-700 transition-colors" onclick="window.location.href='{{ route('landing.admin.booking.dashboard') }}'">Tutup</button>
                                        </div>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
