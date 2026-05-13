@extends('layouts.app')
@section('title', 'Edit Fasilitas Kamar')
@section('content')
<h2 class="mb-3">Edit Fasilitas Kamar</h2>
<form action="{{ route('fasilitas-kamar.update', $fasilitasKamar->id) }}" method="POST">
    @csrf @method('PUT')
    <div class="mb-3">
        <label class="form-label">Kamar</label>
        <select name="kamar_id" class="form-select" required>
            @foreach($kamar as $k)
                <option value="{{ $k->id }}"
                    {{ (old('kamar_id',$fasilitasKamar->kamar_id)==$k->id)?'selected':'' }}>
                    {{ $k->nama_kamar }} - {{ $k->tipe_kamar }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Nama Fasilitas</label>
        <input type="text" name="nama_fasilitas" class="form-control"
               value="{{ old('nama_fasilitas', $fasilitasKamar->nama_fasilitas) }}" required>
    </div>
    <button type="submit" class="btn btn-warning">Update</button>
    <a href="{{ route('fasilitas-kamar.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
