@extends('layouts.main')

@section('main')
    <h3 class="mb-4">Buat Kategori Buku</h3>
    <form action="{{ route('category.store') }}" method="post">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama Kategori</label>
            <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Keterangan</label>
            <textarea name="description" id="description" rows="3"
                class="form-control">{{ old('description') }}</textarea>
        </div>
        <div>
            <a href="{{ route('category.index') }}" class="btn btn-sm btn-outline-dark">Batal</a>
            <button type="submit" class="btn btn-dark btn-sm">Simpan</button>
        </div>
    </form>
@endsection
