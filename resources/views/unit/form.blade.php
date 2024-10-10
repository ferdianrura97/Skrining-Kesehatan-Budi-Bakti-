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
        <label for="nama_unit" class="label-control">Nama Unit <span class="text-danger">*</span></label>
        <input type="text" autocomplete="off" maxlength="200" class="form-control" name="nama_unit" id="nama_unit" placeholder="Nama Unit" required value="{{ old('nama_unit',@$data->nama_unit) }}">
        @error('nama_unit')
            <strong class="text-danger">{{ $message }}</strong>
        @enderror
    </div>
@endsection