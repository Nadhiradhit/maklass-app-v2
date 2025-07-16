<div class="space-y-4" id="detailModalContent">
    <div class="flex gap-8 flex-wrap">
        <div>
            <h4 class="text-lg">Ruangan Lab</h4>
            <h2 class="text-xl font-semibold">{{ $booking->room->name }}</h2>
        </div>
        <div>
            <h4 class="text-lg">Kegiatan / Acara</h4>
            <h2 class="text-xl font-semibold">{{ $booking->booking_purpose }}</h2>
        </div>
    </div>

    <div class="flex justify-between items-start flex-wrap gap-4">
        <div>
            <h4 class="text-lg">Penanggung Jawab</h4>
            <h2 class="text-xl font-semibold">{{ $booking->responsible }}</h2>
        </div>
        <div>
            <h4 class="text-lg">Jadwal Peminjaman</h4>
            <h2 class="text-xl font-semibold">
                @php
                    \Carbon\Carbon::setLocale('id');
                    setlocale(LC_TIME, 'id_ID.UTF-8', 'id_ID', 'indonesian');
                    $startDate = $booking->booking_start_datetime
                        ? \Carbon\Carbon::parse($booking->booking_start_datetime)->locale('id')
                        : null;
                @endphp
                {{ $startDate ? $startDate->isoFormat('dddd, DD MMMM YYYY') : '-' }},
                <br>
                {{ $booking->booking_start_datetime ? \Carbon\Carbon::parse($booking->booking_start_datetime)->format('H:i') : '-' }} -
                {{ $booking->booking_end_datetime ? \Carbon\Carbon::parse($booking->booking_end_datetime)->format('H:i') : '-' }}
            </h2>
        </div>
    </div>

    <div>
        <h4 class="text-lg">Deskripsi Kegiatan</h4>
        <div class="bg-gray-100 p-4 rounded-md h-32 overflow-y-auto">
            <p class="text-gray-700">{{ $booking->purpose }}</p>
        </div>
    </div>

    <div class="flex items-start flex-wrap gap-4 justify-between">
        <h4 class="text-lg">Dibuat pada:
            <span class="font-semibold">{{ $booking->created_at->isoFormat('dddd, DD MMMM YYYY') }}</span>
        </h4>

        @if($booking->status == 'pending')
            <div class="flex space-x-2">
                <form action="{{ route('landing.admin.booking.update', ['id' => $booking->id]) }}" method="post">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="approved">
                    <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition-colors">
                        Setujui
                    </button>
                </form>

                <button type="button" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition-colors" onclick="openRejectModal({{ $booking->id }})">
                    Tolak
                </button>
            </div>
        @else
            <div>
                @if($booking->status == 'approved')
                    <span class="px-4 py-2 bg-green-600 text-white rounded">Disetujui</span>
                @elseif($booking->status == 'rejected')
                    <span class="px-4 py-2 bg-red-600 text-white rounded">Ditolak</span>
                @endif
            </div>
        @endif
    </div>
</div>
