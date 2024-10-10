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
        <label for="nama" class="label-control">Nama Pengaturan <span class="text-danger">*</span></label>
        <input type="text" autocomplete="off" maxlength="200" class="form-control" name="nama_pengaturan" id="nama_pengaturan" placeholder="Nama pengaturan" required value="{{ old('nama_pengaturan',@$data->nama_pengaturan) }}">
        @error('nama_pengaturan')
            <strong class="text-danger">{{ $message }}</strong>
        @enderror
    </div>

    <div class="form-group">
        <label for="nama" class="label-control">Value <span class="text-danger">*</span></label>
        <input type="text" autocomplete="off" maxlength="200" class="form-control" name="value" id="value" placeholder="Nama pengaturan" required value="{{ old('value',@$data->value) }}">
        @error('value')
            <strong class="text-danger">{{ $message }}</strong>
        @enderror
    </div>
@endsection