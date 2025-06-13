@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-4">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Profil UKM</h1>
        <a href="{{ route('ukm_profiles.create') }}" class="bg-black text-white px-4 py-2 rounded hover:bg-gray-800 transition">Tambah Profil UKM</a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="py-2 px-4 border-b border-gray-300">Nama</th>
                    <th class="py-2 px-4 border-b border-gray-300">Deskripsi</th>
                    <th class="py-2 px-4 border-b border-gray-300">Logo</th>
                    <th class="py-2 px-4 border-b border-gray-300">Kontak</th>
                    <th class="py-2 px-4 border-b border-gray-300">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($ukmProfiles as $profile)
                <tr class="hover:bg-gray-50">
                    <td class="py-2 px-4 border-b border-gray-300">{{ $profile->nama }}</td>
                    <td class="py-2 px-4 border-b border-gray-300">{{ Str::limit($profile->deskripsi, 50) }}</td>
                    <td class="py-2 px-4 border-b border-gray-300">
                        @if($profile->logo)
                            <img src="{{ asset('storage/' . $profile->logo) }}" alt="Logo" class="h-12 w-12 object-contain">
                        @else
                            -
                        @endif
                    </td>
                    <td class="py-2 px-4 border-b border-gray-300">{{ $profile->kontak }}</td>
                    <td class="py-2 px-4 border-b border-gray-300 space-x-2">
                        <a href="{{ route('ukm_profiles.edit', $profile) }}" class="text-blue-600 hover:underline">Edit</a>
                        <form action="{{ route('ukm_profiles.destroy', $profile) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus profil ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="py-4 px-4 text-center text-gray-500">Belum ada profil UKM.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
