@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Galeri Saya</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('gallery.create') }}" class="btn btn-primary mb-3">Upload Foto Baru</a>

    <div class="row">
        @forelse ($galleries as $gallery)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="{{ asset('storage/' . $gallery->image_path) }}" class="card-img-top" alt="{{ $gallery->title }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $gallery->title }}</h5>
                        <p class="card-text">{{ Str::limit($gallery->description, 100) }}</p>
                        <a href="{{ route('gallery.show', $gallery->id) }}" class="btn btn-sm btn-info">Lihat Detail</a>

                        <form action="{{ route('gallery.destroy', $gallery->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus foto ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p>Belum ada foto di galeri.</p>
        @endforelse
    </div>
</div>
@endsection
