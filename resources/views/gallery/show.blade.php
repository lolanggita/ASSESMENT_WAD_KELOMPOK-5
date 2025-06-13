@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $gallery->title }}</h1>

    <div class="mb-4">
        <img src="{{ asset('storage/' . $gallery->image_path) }}" class="img-fluid" alt="{{ $gallery->title }}">
    </div>

    <p><strong>Deskripsi:</strong></p>
    <p>{{ $gallery->description ?? '-' }}</p>

    <a href="{{ route('gallery.index') }}" class="btn btn-primary">Kembali ke Galeri</a>
</div>
@endsection
