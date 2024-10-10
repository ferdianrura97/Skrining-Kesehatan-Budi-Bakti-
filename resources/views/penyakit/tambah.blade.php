@extends('layouts.app-form')

@section('form-title')
    @if(isset($data))
        Ubah Data {{ $settings['title'] }}
    @else
        Tambah Data {{ $settings['title'] }}
    @endif
@endsection


@section('form')
    @if(isset($data))
        <input type="hidden" name="_method" value="PUT">
    @endif

    <div class="form-group">
        <label for="nama" class="label-control">Nama penyakit <span class="text-danger">*</span></label>
        <input type="text" autocomplete="off" maxlength="200" class="form-control" name="nama_penyakit" id="nama_penyakit" placeholder="Nama penyakit" required value="{{ old('nama_penyakit',@$data->nama_penyakit) }}">
        @error('nama_penyakit')
            <strong class="text-danger">{{ $message }}</strong>
        @enderror
    </div>

    <div class="form-group">
        <label for="nama" class="label-control">Point <span class="text-danger">*</span></label>
        <input type="number" autocomplete="off" maxlength="200" class="form-control" name="point" id="point" placeholder="Point" required value="{{ old('point',@$data->point) }}">
        @error('point')
            <strong class="text-danger">{{ $message }}</strong>
        @enderror
    </div>
@endsection