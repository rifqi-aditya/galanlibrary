@extends('layouts.main')

@section('main')
    <h3 class="mb-4">Tambah Buku</h3>
    <form action="{{ route('book.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Judul</label>
            <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Keterangan</label>
            <textarea name="description" id="description" rows="3"
                class="form-control">{{ old('description') }}</textarea>
        </div>
        <div class="mb-3">
            <label for="author" class="form-label">Pengarang</label>
            <input type="text" class="form-control" name="author" id="author" value="{{ old('author') }}">
        </div>
        <div class="mb-3">
            <label for="publisher_id" class="form-label">Penerbit</label>
            <select name="publisher_id" id="publisher_id" class="form-control">
                @foreach ($publishers as $publisher)
                    <option {{ old('publisher_id') == $publisher->id ? 'selected' : '' }} value="{{ $publisher->id }}">
                        {{ $publisher->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="mb-3">
                    <label for="publication_year" class="form-label">Tahun Terbit</label>
                    <input type="number" max="9999" placeholder="{{ date('Y') }}" class="form-control"
                        name="publication_year" id="publication_year" value="{{ old('publication_year') }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="mb-3">
                    <label for="stock" class="form-label">Jumlah Buku</label>
                    <input type="number" min="1" class="form-control" name="stock" id="stock"
                        value="{{ old('stock') }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="mb-3">
                    <label for="category_id" class="form-label">Kategori</label>
                    <select name="category_id" id="category_id" class="form-control">
                        @foreach ($categories as $category)
                            <option {{ old('category_id') == $category->id ? 'selected' : '' }}
                                value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="mb-3">
                    <label for="cover" class="form-label">File sampul</label>
                    <input type="file" name="cover" id="cover" class="form-control">
                </div>
            </div>
        </div>
        <div>
            <a href="{{ route('book.index') }}" class="btn btn-sm btn-outline-dark">Batal</a>
            <button type="submit" class="btn btn-dark btn-sm">Simpan</button>
        </div>
    </form>
@endsection
