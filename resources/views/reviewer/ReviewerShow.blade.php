@extends('components.layout')

@section('content')
<div class="container mt-5">
    @if($reviews->isNotEmpty()) <!-- Pastikan reviews tidak kosong -->
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h1 class="h4">Review Buku</h1>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="list-group">
                            @foreach($reviews as $review)
                                <li class="list-group-item mb-3">
                                    <div class="d-flex justify-content-between">
                                        <strong>{{ $review->book->title }}</strong>
                                        <small class="text-muted">Ditulis oleh: {{ $review->user->name }} pada {{ $review->created_at->format('d M Y') }}</small>
                                    </div>
                                    <p class="mt-2"> Review : {{ $review->review }}</p>
                                    <div class="mt-3">
                                        <strong>Tags:</strong>
                                        <ul class="list-inline">
                                            @foreach(($review->tags) as $tag)
                                                <a href="{{ route('tags.show', $tag) }}" class="badge bg-secondary">{{ $tag }}</a>
                                             @endforeach
                                        </ul>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <a href="{{ route('buku') }}" class="btn btn-primary">kembali</a>
            </div>
        </div>
    @else
        <div class="alert alert-info mt-3" role="alert">
            Belum ada review untuk buku ini.
        </div>
    @endif
</div>
@endsection
