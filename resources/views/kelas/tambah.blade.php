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
        <label for="unit_id" class="label-control">Unit <span class="text-danger">*</span></label>
        <select class="form-control select2" name="unit_id" id="unit_id" tabindex="-1" required>
            @foreach ($units as $unit)
            <option value="{{ $unit->id }}" @if($unit->id == old('unit_id')) selected @endif>{{ $unit->nama_unit }}</option>
            @endforeach
        </select>
        @error('unit_id')
            <strong class="text-danger">{{ $message }}</strong>
        @enderror
    </div>

    <div class="form-group">
        <label for="nama_kelas" class="label-control">Nama Kelas <span class="text-danger">*</span></label>
        <input type="text" autocomplete="off" maxlength="200" class="form-control" name="nama_kelas" id="nama_kelas" placeholder="Nama Kelas" required value="{{ old('nama_kelas',@$data->nama_kelas) }}">
        @error('nama_kelas')
            <strong class="text-danger">{{ $message }}</strong>
        @enderror
    </div>
@endsection