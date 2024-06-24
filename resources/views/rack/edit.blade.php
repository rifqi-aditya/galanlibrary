@extends('layouts.main')

@section('main')
    <h3 class="mb-4">Edit Rak Buku</h3>
    <form action="{{ route('rack.update', ['rack' => $rack]) }}" method="post">
        @csrf
        @method('put')
        <div class="row">
            <div class="col-lg-7 mb-3">
                <div class="mb-3">
                    <label for="code" class="form-label">Kode Rak</label>
                    <input type="text" class="form-control" name="code" id="code"
                        value="{{ old('code', $rack->code) }}">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Keterangan</label>
                    <textarea name="description" id="description" rows="3"
                        class="form-control">{{ old('description', $rack->description) }}</textarea>
                </div>
            </div>
            <div class="col-lg-5 mb-3">
                <label class="form-label mb-0">Tambahkan Kategori (Centang di pojok kanan item)</label>
                <div class="list-group mt-3">
                    @php
                        $rackCategoryId = $rack->categories
                            ->map(function ($category) {
                                return $category->id;
                            })
                            ->all();
                    @endphp
                    @foreach ($categories as $category)
                        <div class="list-group-item pe-4">
                            <input
                                {{ in_array($category->id, old('category_ids', $rackCategoryId)) ? 'checked' : '' }}
                                class="form-check-input position-absolute top-0 end-0 p-0 mt-1 me-1" type="checkbox"
                                name="category_ids[]" value="{{ $category->id }}">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1">{{ $category->name }}</h6>
                                <small class="text-muted">{{ $category->books->sum('stock') }} total buku.</small>
                            </div>
                            <small class="text-muted">{{ $category->description }}</small>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div>
            <a href="{{ route('rack.index') }}" class="btn btn-sm btn-outline-dark">Batal</a>
            <button type="submit" class="btn btn-dark btn-sm">Simpan</button>
        </div>
    </form>
@endsection
