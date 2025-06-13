@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-10 px-4">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">Tambah Profil UKM</h1>

    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('ukm_profiles.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div>
            <label for="nama" class="block text-sm font-medium text-gray-700">Nama UKM</label>
            <input type="text" name="nama" id="nama" value="{{ old('nama') }}" required class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-black focus:border-black">
        </div>

        <div>
            <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" rows="4" required class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-black focus:border-black">{{ old('deskripsi') }}</textarea>
        </div>

        <div>
            <label for="logo" class="block text-sm font-medium text-gray-700">Logo (opsional)</label>
            <input type="file" name="logo" id="logo" accept="image/*" class="mt-1 block w-full text-gray-700">
        </div>

        <div>
            <label for="kontak" class="block text-sm font-medium text-gray-700">Kontak</label>
            <input type="text" name="kontak" id="kontak" value="{{ old('kontak') }}" required class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-black focus:border-black">
        </div>

        <div class="flex justify-end space-x-4">
            <a href="{{ route('ukm_profiles.index') }}" class="px-4 py-2 border border-gray-300 rounded hover:bg-gray-100">Batal</a>
            <button type="submit" class="bg-black text-white px-4 py-2 rounded hover:bg-gray-800 transition">Simpan</button>
        </div>
    </form>
</div>
@endsection
