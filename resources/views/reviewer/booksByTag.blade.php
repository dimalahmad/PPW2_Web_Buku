@extends('components.layout')

@section('content')
<div class="container mt-5">
    <h1>Buku dengan Tag: {{ ucfirst($tag) }}</h1>

    @if($books->isNotEmpty())
        <div class="row">
            @foreach($books as $book)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset('storage/img/'.$book->image) }}" class="card-img-top" alt="{{ $book->title }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $book->title }}</h5>
                            <a href="{{ route('books.show', $book->id) }}" class="btn btn-primary">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p>Tidak ada buku dengan tag ini.</p>
    @endif
</div>
@endsection
