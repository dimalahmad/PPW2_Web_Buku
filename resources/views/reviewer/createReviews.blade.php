
@extends('components.layout')

@section('content')
<div class="container">
    <h1>Tambah Review Buku</h1>
    <form action="{{ route('reviews.store')}}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="book_id" class="form-label">Pilih Buku</label>
            <select name="book_id" id="book_id" class="form-control" required>
                @foreach($books as $book)
                <option value="{{ $book->id }}">{{ $book->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="review" class="form-label">Review</label>
            <textarea name="review" id="review" rows="5" class="form-control" required></textarea>
        </div>
        <div id="tag" class="form-group">
            <label for="tag">Tambah Tag:</label>
            <input type="text" name="tags[]" class="form-control mb-2">
        </div>
        <button type="button" id="add-tag" class="btn btn-secondary">Tambah Tag</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
        <script>
            document.getElementById('add-tag').addEventListener('click', function() {
                const tagDiv = document.getElementById('tag');
                const newInput = document.createElement('input');
                newInput.setAttribute('type', 'text');
                newInput.setAttribute('name', 'tags[]');
                newInput.classList.add('form-control', 'mb-2');
                tagDiv.appendChild(newInput);
            });
        </script>
</div>
@endsection
