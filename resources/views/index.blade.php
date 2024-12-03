@extends('components.layout')

@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
<div class="container mt-5">

    <!-- Notifikasi -->
    <div class="card-body">
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                {{ $message }}
            </div>
        @else
            <div class="alert alert-info">
                You are logged in!
            </div>
        @endif
    </div>

    <!-- Tombol Create (Admin Only) -->
    @if (Auth::User()->level == 'admin')
    <div class="mb-3">
        <a href="{{ route('create') }}" class="btn btn-primary">
            Create New Book
        </a>
    </div>
    @endif

    <!-- Tombol Review (Internal Reviewer/Admin) -->
    @if (Auth::User()->level == 'internal_reviewer' || Auth::User()->level == 'admin')
    <div class="mb-3">
        <a href="{{ route('reviews.create') }}" class="btn btn-secondary">
            Review Book
        </a>
    </div>
    @endif

    <!-- Tabel Buku -->
    <table class="datatable table table-striped table-bordered table-hover table-sm text-center">
        <thead class="table-light">
            <tr class="table-primary">
                <th scope="col">NO</th>
                <th scope="col">ID</th>
                <th scope="col">Gambar</th>
                <th scope="col">Judul</th>
                <th scope="col">Penulis</th>
                <th scope="col">Harga</th>
                <th scope="col">Diskon</th>
                <th scope="col">Harga setelah Diskon</th>
                <th scope="col">Tanggal Terbit</th>
                <th scope="col">Status Editorial</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($books as $index => $book)
            <tr>
                <th scope="row">{{ $index + 1 }}</th>
                <td>{{ $book->id }}</td>
                <td>
                    <img src="{{ asset('storage/img/'.$book->image) }}" class="rounded" style="width: 150px; height: 200px; object-fit: cover;">
                </td>
                <td>{{ $book->title }}</td>
                <td>{{ $book->author }}</td>
                <td>{{ "Rp" . number_format($book->harga, 2, ',', '.') }}</td>
                <td>{{ $book->discount ? $book->discount . '%' : 'Tidak ada diskon' }}</td>
                <td>Rp. {{ number_format($book->discounted_price, 0, ',', '.') }}</td>
                <td>{{ $book->tanggal_terbit }}</td>
                <td>
                        @if($book->editorial_pick)
                        <span class="badge bg-success">Yes</span>
                        @else
                        <span class="badge bg-secondary">No</span>
                        @endif
                    </td>
                <td>
                    @if (Auth::User()->level == 'admin')
                    <form action="{{ route('destroy', $book->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku ini?')" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                    <a href="{{ route('edit', $book->id) }}" class="btn btn-info btn-sm">Edit</a>
                    @endif
                    <a href="{{ route('books.show', $book->id) }}" class="btn btn-primary btn-sm">Detail</a>
                    <a href="{{ route('reviews.show', $book->id) }}" class="btn btn-secondary btn-sm">Review</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Total Buku dan Total Harga -->
    <div class="mt-3 p-3 bg-light rounded shadow-sm">
        <p class="h5">Total Buku: {{ $totalBooks }}</p>
        <p class="h5">Total Harga Buku: Rp{{ number_format($totalHarga, 2, ',', '.') }}</p>
    </div>

</div>

<!-- JQuery and DataTables JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
<script>
        new DataTable('.datatable');
        $(document).ready(function() {
            $('#booksTable').DataTable({
                paging: true,
                searching: true,
                info: true,
                ordering: true,
                lengthChange: true,
            });
        });
    </script>

@endsection
