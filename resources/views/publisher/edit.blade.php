@extends('layouts.main')

@section('main')
    <h3 class="mb-4">Ubah Penerbit</h3>
    <form action="{{ route('publisher.update', ['publisher' => $publisher]) }}" method="post">
        @csrf
        @method('put')
        <div class="mb-3">
            <label for="name" class="form-label">Nama Penerbit</label>
            <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $publisher->name) }}">
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Alamat</label>
            <textarea name="address" id="address" rows="3"
                class="form-control">{{ old('address', $publisher->address) }}</textarea>
        </div>
        <div class="mb-3">
            <label for="website" class="form-label">Website</label>
            <input type="url" class="form-control" name="website" id="website"
                value="{{ old('website', $publisher->website) }}">
        </div>
        <div>
            <a href="{{ route('publisher.index') }}" class="btn btn-sm btn-outline-dark">Batal</a>
            <button type="submit" class="btn btn-dark btn-sm">Simpan</button>
        </div>
    </form>
@endsection
