@section('title', 'Dashboard Admin')

@extends('components.layouts.layout-dashboard')

@section('content')
    <div class="px-3 sm:px-4 lg:px-6 py-4 sm:py-6 md:py-8 mx-auto">
        <h1 class="text-2xl font-semibold">Ruangan Lab</h1>

        <div class="grid grid-cols-1 lg:grid-cols-2 mt-4 gap-4">
            <div class="bg-secondary-100/50 rounded-lg shadow-sm p-4">
                <h3 class="text-lg font-semibold mb-2">Total Ruangan</h3>
                <p class="text-3xl font-bold text-secondary-800">{{ $data->count() }}</p>
            </div>
            <div class="bg-secondary-100/50 rounded-lg shadow-sm p-4">
                <h3 class="text-lg font-semibold mb-2">Ruangan Terpakai Hari Ini</h3>
                <p class="text-3xl font-bold text-secondary-800">{{ $data->where('is_booked', true)->count() }}</p>
            </div>
        </div>

        <div class="flex justify-end my-4">
            <a href="{{ route('landing.admin.room.dashboard', ['show_modal' => true]) }}" class="bg-secondary-800 text-white px-4 py-2 rounded-md cursor-pointer hover:bg-secondary-700">
                Tambah Ruangan
            </a>
        </div>

        @if(request('show_modal'))
        <div class="fixed inset-0 bg-gray-900/70 bg-opacity-50 overflow-y-auto h-full w-full z-50 flex items-center justify-center">
            <div class="relative p-5 border w-96 shadow-lg rounded-md bg-white">
                <div class="mt-3">
                    <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Tambah Ruangan Baru</h3>
                    <form action="{{ route('landing.admin.room.create') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label for="room" class="block text-sm font-medium text-gray-700">Kode Ruangan</label>
                            <input type="text" name="room" id="room" value="{{ old('room') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-secondary-500 focus:ring-secondary-500 p-2">
                        </div>
                        <div>
                            <label for="room_name" class="block text-sm font-medium text-gray-700">Nama Ruangan</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-secondary-500 focus:ring-secondary-500 p-2">
                        </div>
                        <div class="flex justify-end space-x-3 mt-5">
                            <a href="{{ route('landing.admin.room.dashboard') }}"
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
                <thead class="text-xs text-white uppercase bg-secondary-800">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            No
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Kode Ruangan
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nama Ruangan
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody class="font-semibold">
                    @foreach ($data as $item)
                    <tr class="border-gray-200">
                        <th scope="row" class="px-6 py-4 whitespace-nowrap">
                            {{ $loop->iteration }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $item->room }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $item->name }}
                        </td>
                        <td class="px-6 py-4 space-x-2">
                            <a href="{{ route('landing.admin.room.dashboard', ['edit_id' => $item->id]) }}" class="text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                            @if(request('edit_id') == $item->id)
                                <div class="fixed inset-0 bg-gray-900/70 bg-opacity-50 overflow-y-auto h-full w-full z-50 flex items-center justify-center">
                                    <div class="relative p-5 border w-96 shadow-lg rounded-md bg-white">
                                        <div class="mt-3">
                                            <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Edit Ruangan</h3>
                                            <form action="{{ route('landing.admin.room.update', $item->id) }}" method="POST" class="space-y-4">
                                                @csrf
                                                @method('PUT')
                                                <div>
                                                    <label for="room" class="block text-sm font-medium text-gray-700">Kode Ruangan</label>
                                                    <input type="text" name="room" id="room" value="{{ old('room', $item->room) }}"
                                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-secondary-500 focus:ring-secondary-500 p-2">
                                                </div>
                                                <div>
                                                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Ruangan</label>
                                                    <input type="text" name="name" id="name" value="{{ old('name', $item->name) }}"
                                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-secondary-500 focus:ring-secondary-500 p-2">
                                                </div>
                                                <div class="flex justify-end space-x-3 mt-5">
                                                    <a href="{{ route('landing.admin.room.dashboard') }}"
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
                            <a href="{{ route('landing.admin.room.dashboard', ['delete_id' => $item->id]) }}" class="text-red-600 dark:text-red-500 hover:underline">Hapus</a>
                            @if(request('delete_id') == $item->id)
                            <div class="fixed inset-0 bg-gray-900/70 bg-opacity-50 overflow-y-auto h-full w-full z-50 flex items-center justify-center">
                                <div class="relative p-5 border w-96 shadow-lg rounded-md bg-white">
                                    <div class="mt-3">
                                        <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Konfirmasi Hapus</h3>
                                        <p class="mb-4">Apakah Anda yakin ingin menghapus data ini?</p>
                                        <form action="{{ route('landing.admin.room.delete', $item->id) }}" method="POST" class="flex justify-end space-x-3">
                                            @csrf
                                            @method('DELETE')
                                            <a href="{{ route('landing.admin.room.dashboard') }}"
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
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

