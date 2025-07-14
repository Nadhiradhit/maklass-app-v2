@section('title', 'Dashboard Admin')

@extends('components.layouts.layout-dashboard')

@section('content')
    <div class="px-3 sm:px-4 lg:px-6 py-4 sm:py-6 md:py-8 mx-auto">

        <div class="flex flex-col md:flex-row md:justify-between my-4">
            <h1 class="text-xl md:text-2xl font-semibold text-secondary-900 my-5 md:my-0">Dashboard User Maklas</h1>
            <a href="{{ route('landing.admin.user.dashboard', ['show_modal' => true]) }}" class="flex items-center gap-2 bg-secondary-800 text-white px-4 py-2 rounded-md cursor-pointer hover:bg-secondary-700">
                <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"><path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z"/></svg>
                <span>Tambah User</span>
            </a>
        </div>

        @if(request('show_modal'))
            <div class="fixed inset-0 bg-gray-900/70 bg-opacity-50 overflow-y-auto h-full w-full z-50 flex items-center justify-center">
                <div class="relative p-5 border w-1/2 shadow-lg rounded-md bg-white">
                    <div class="mt-3">
                        <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Tambah User Baru</h3>
                        <form action="{{ route('landing.admin.user.create') }}" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-secondary-500 focus:ring-secondary-500 p-2">
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" name="email" id="email" value="{{ old('email') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-secondary-500 focus:ring-secondary-500 p-2">
                            </div>
                            <div class="relative">
                                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                                <input type="password" name="password" id="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-secondary-500 focus:ring-secondary-500 p-2">
                                <input type="checkbox" id="togglePassword" class="mt-2"> <label for="togglePassword" class="text-sm">Lihat Password</label>
                            </div>
                            <div>
                                <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                                <select name="role" id="role" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-secondary-500 focus:ring-secondary-500 p-2">
                                    <option value="">Pilih Role</option>
                                    <option value="admin">Admin</option>
                                    <option value="user">User</option>
                                </select>
                            </div>
                            <div class="flex justify-end space-x-3 mt-5">
                                <a href="{{ route('landing.admin.user.dashboard') }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">
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
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            No
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nama
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Email
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr class="border-gray-200 odd:bg-white even:bg-gray-100">
                            <th scope="row" class="px-6 py-4 whitespace-nowrap font-semibold">
                                {{ $loop->iteration }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $item->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->email }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->role }}
                            </td>
                            <td class="px-6 py-4 space-x-2">
                                <a href="{{ route('landing.admin.user.dashboard', ['edit_id' => $item->id]) }}" class="text-blue-600 dark:text-blue-500 hover:underline font-semibold">Edit</a>
                                @if(request('edit_id') == $item->id)
                                <div class="fixed inset-0 bg-gray-900/70 bg-opacity-50 overflow-y-auto h-full w-full z-50 flex items-center justify-center">
                                    <div class="relative p-5 border w-full md:w-1/2 shadow-lg rounded-md bg-white">
                                        <div class="mt-3">
                                            <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Edit User</h3>
                                            <form action="{{ route('landing.admin.user.update', $item->id) }}" method="POST" class="space-y-4">
                                                @csrf
                                                @method('PUT')
                                                <div>
                                                    <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                                                    <input type="text" name="name" id="name" value="{{ old('name', $item->name) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-secondary-500 focus:ring-secondary-500 p-2">
                                                </div>
                                                <div>
                                                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                                    <input type="email" name="email" id="email" value="{{ old('email', $item->email) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-secondary-500 focus:ring-secondary-500 p-2">
                                                </div>
                                                <div class="relative">
                                                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                                                    <input type="password" name="password" id="password" value="{{ old('password') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-secondary-500 focus:ring-secondary-500 p-2">
                                                </div>
                                                <div>
                                                    <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                                                    <select name="role" id="role" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-secondary-500 focus:ring-secondary-500 p-2">
                                                        <option value="">Pilih Role</option>
                                                        <option value="admin" {{ $item->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                                        <option value="user" {{ $item->role == 'user' ? 'selected' : '' }}>User</option>
                                                    </select>
                                                </div>
                                                <div class="flex justify-end space-x-3 mt-5">
                                                    <a href="{{ route('landing.admin.user.dashboard') }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">
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
                                @endif
                                <a href="{{ route('landing.admin.user.dashboard', ['delete_id' => $item->id]) }}" class="text-red-600 dark:text-red-500 hover:underline font-semibold">Hapus</a>
                                @if(request('delete_id') == $item->id)
                                <div class="fixed inset-0 bg-gray-900/70 bg-opacity-50 overflow-y-auto h-full w-full z-50 flex items-center justify-center">
                                    <div class="relative p-5 border w-96 shadow-lg rounded-md bg-white">
                                        <div class="mt-3">
                                            <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Konfirmasi Hapus</h3>
                                            <p class="mb-4">Apakah Anda yakin ingin menghapus data ini?</p>
                                            <form action="{{ route('landing.admin.user.delete', $item->id) }}" method="POST" class="flex justify-end space-x-3">
                                                @csrf
                                                @method('DELETE')
                                                <a href="{{ route('landing.admin.user.dashboard') }}"
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
    {{-- See Password --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('password');
            const toggle = document.getElementById('togglePassword');
            if (passwordInput && toggle) {
                toggle.addEventListener('change', function() {
                    passwordInput.type = this.checked ? 'text' : 'password';
                });
            }
        });
    </script>
@endsection
