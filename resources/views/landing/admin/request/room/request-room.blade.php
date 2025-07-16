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
                    @forelse($data as $booking)
                        <tr class="border-gray-200 odd:bg-white even:bg-gray-100">
                            <td scope="row" class="px-6 py-4 whitespace-nowrap font-semibold">
                                {{ $loop->iteration + ($data->currentPage() - 1) * $data->perPage() }}
                            </td>
                            <td>{{ $booking->user->name }}</td>
                            <td class="px-6 py-4">{{ $booking->booking_purpose }}</td>
                            <td class="px-6 py-4">{{ $booking->responsible }}</td>
                            <td class="px-6 py-4">{{ $booking->room->name }} {{ $booking->room->room }}</td>
                            <td class="px-6 py-4 text-center">
                                {{ $booking->booking_start_datetime ? \Carbon\Carbon::parse($booking->booking_start_datetime)->format('d F Y') : '-' }}
                            </td>
                            <td>
                                @if($booking->status == 'pending')
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Menunggu</span>
                                @elseif($booking->status == 'approved')
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Disetujui</span>
                                @else
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Ditolak</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($booking->file_attachment)
                                    <a href="{{ asset('storage/attachments/' . $booking->file_attachment) }}" target="_blank" class="text-blue-600 hover:text-blue-800">Lihat Lampiran</a>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td>
                                <div class="flex justify-center">
                                    <button onclick="showDetailModal({{ $booking->id }})"
                                        class="py-2 px-4 bg-secondary-800 text-white rounded hover:bg-secondary-700 transition-colors">
                                        Lihat Detail
                                    </button>
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
            {{ $data->withQueryString()->links() }}
        </div>
    </div>

    <!-- Detail Modal Container -->
    <div id="detailModal" class="fixed inset-0 bg-gray-900/70 bg-opacity-50 flex items-center justify-center z-50 hidden overflow-y-auto">
        <div class="relative p-5 border w-200 md:w-1/2 shadow-lg rounded-md bg-white">
            <div id="detailModalContent">
                <p class="text-center">Memuat detail...</p>
            </div>
            <button class="mt-4 px-4 py-2 bg-secondary-800 text-white rounded hover:bg-secondary-700 transition-colors" onclick="window.location.href='{{ route('landing.admin.booking.dashboard') }}'">Tutup</button>
        </div>
    </div>



    <div id="rejectModal" class="fixed inset-0 bg-gray-900/70 bg-opacity-50 overflow-y-auto h-full w-full hidden z-[100]">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Tolak Peminjaman</h3>
                <div class="mt-2 px-7 py-3">
                    <form id="rejectForm" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status" value="rejected">
                        <label for="reason" class="block text-sm font-medium text-gray-700 text-left">Alasan Penolakan:</label>
                        <textarea name="reason" id="reason" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required></textarea>
                        <div class="items-center px-4 py-3">
                            <button type="submit" class="px-4 py-2 bg-red-600 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">Konfirmasi Tolak</button>
                            <button type="button" class="mt-3 px-4 py-2 bg-gray-300 text-gray-800 text-base font-medium rounded-md w-full shadow-sm hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500" onclick="closeRejectModal()">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script>
    function openRejectModal(bookingId) {
        document.getElementById('rejectForm').action = "{{ route('landing.admin.booking.update', ['id' => ':id']) }}".replace(':id', bookingId);
        document.getElementById('detailModal').classList.add('hidden');
        document.getElementById('detailModalContent').classList.add('hidden');
        document.getElementById('rejectModal').classList.remove('hidden');

        const form = document.getElementById('rejectForm');
            form.addEventListener('submit', function(event) {
                // Get the value of the reason textarea
                const reasonValue = document.getElementById('reason').value;
                console.log("Reason being submitted:", reasonValue);
                // You can even put a breakpoint here if you know how
                // debugger;
            }, { once: true });
    }

    function closeRejectModal() {
        document.getElementById('rejectModal').classList.add('hidden');
        document.getElementById('reason').value = '';
    }

    document.addEventListener('DOMContentLoaded', function () {
        const urlParams = new URLSearchParams(window.location.search);
        const detailId = urlParams.get('detail_id');

        if (detailId) {
            fetch(`/admin/booking-detail/${detailId}`)
                .then(response => response.text())
                .then(html => {
                    document.getElementById('detailModalContent').innerHTML = html;
                    document.getElementById('detailModal').classList.remove('hidden');
                })
                .catch(error => {
                    document.getElementById('detailModalContent').innerHTML = '<p class="text-red-500">Gagal memuat detail.</p>';
                    document.getElementById('detailModal').classList.remove('hidden');
                });
        }
    });

    function showDetailModal(id) {
    fetch(`/dashboard-admin/booking-detail/${id}`)
        .then(response => {
            if (!response.ok) throw new Error('Modal detail tidak ditemukan');
            return response.text();
        })
        .then(html => {
            document.getElementById('detailModalContent').innerHTML = html;
            document.getElementById('detailModal').classList.remove('hidden');
        })
        .catch(error => {
            console.error(error);
            document.getElementById('detailModalContent').innerHTML = '<p class="text-center text-red-600">Gagal memuat detail.</p>';
        });
}
</script>
@endpush
