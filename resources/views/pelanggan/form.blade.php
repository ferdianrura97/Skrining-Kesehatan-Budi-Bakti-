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
      <label for="nama_pelanggan" class="form-label">Nama Pelanggan <span class="text-danger">*</span> </label>
      <input class="form-control" type="text" name="nama_pelanggan" required value="{{ old('nama_pelanggan',@$data->nama_pelanggan) }}">
      @error('nama_pelanggan')
        <strong class="text-danger">{{ $message }}</strong>
      @enderror
    </div>

    <div class="form-group">
      <label for="no_telp" class="form-label">No Telp <span class="text-danger">*</span> </label>
      <input class="form-control phone" type="text" name="no_telp" required value="{{ old('no_telp',@$data->no_telp) }}">
      @error('no_telp')
        <strong class="text-danger">{{ $message }}</strong>
      @enderror
    </div>

    <div class="form-group">
      <label for="alamat" class="form-label">Alamat</label>
      <textarea name="alamat" class="form-control">{{ old('alamat',@$data->alamat) }}</textarea>
      @error('alamat')
        <strong class="text-danger">{{ $message }}</strong>
      @enderror
    </div>
@endsection