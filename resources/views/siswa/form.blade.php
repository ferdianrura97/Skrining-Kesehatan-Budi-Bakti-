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
        <label for="nama" class="label-control">Nama Siswa <span class="text-danger">*</span></label>
        <input type="text" autocomplete="off" maxlength="200" class="form-control" name="nama" id="nama" placeholder="Nama Siswa" required value="{{ old('nama',@$data->nama) }}">
        @error('nama')
            <strong class="text-danger">{{ $message }}</strong>
        @enderror
    </div>

    <div class="form-group">
        <label for="kelas_id" class="label-control">Unit - Kelas <span class="text-danger">*</span></label>
        <select class="form-control select2" name="kelas_id" id="kelas_id" tabindex="-1" required>
            @foreach ($kelases as $kelas)
            <option value="{{ $kelas->id }}" @if($kelas->id == old('kelas_id',@$data->kelas_id)) selected @endif> {{ $kelas->unit->nama_unit }} - {{ $kelas->nama_kelas }}</option>
            @endforeach
        </select>
        @error('kelas_id')
            <strong class="text-danger">{{ $message }}</strong>
        @enderror
    </div>
    
    <div class="form-group">
        <label for="nomor_induk" class="label-control">Nomor Induk <span class="text-danger">*</span></label>
        <input type="text" autocomplete="off" maxlength="200" class="form-control" name="nomor_induk" id="nomor_induk" placeholder="Nomor Induk" required value="{{ old('nomor_induk',@$data->nomor_induk) }}">
        @error('nomor_induk')
            <strong class="text-danger">{{ $message }}</strong>
        @enderror
    </div>

    <div class="form-group">
        <label for="jenis_kelamin" class="label-control">Jenis Kelamin <span class="text-danger">*</span></label>
        <select class="form-control select2" name="jenis_kelamin" id="jenis_kelamin" tabindex="-1" required>
            <option value="pria" @if("pria" == old('jenis_kelamin',@$data->jenis_kelamin)) selected @endif>Pria</option>
            <option value="perempuan" @if("perempuan" == old('jenis_kelamin',@$data->jenis_kelamin)) selected @endif>Perempuan</option>
        </select>
        @error('jenis_kelamin')
            <strong class="text-danger">{{ $message }}</strong>
        @enderror
    </div>

    <div class="form-group">
        <label for="tgl_lahir" class="label-control">Tgl Lahir <span class="text-danger">*</span></label>
        <input type="date" autocomplete="off" maxlength="200" class="form-control" name="tgl_lahir" id="tgl_lahir" placeholder="tgl_lahir" required value="{{ old('tgl_lahir',@$data->tgl_lahir) }}">
        @error('tgl_lahir')
            <strong class="text-danger">{{ $message }}</strong>
        @enderror
    </div>
    
    <div class="form-group">
        <label for="no_hp" class="label-control">No Hp <span class="text-danger">*</span></label>
        <div class="input-group has-validation">
            <span class="input-group-text" id="inputGroupPrepend">+628</span>
            <input type="number" autocomplete="off" maxlength="200" class="form-control" name="no_hp" id="no_hp" required value="{{ old('no_hp',@$data->no_hp) }}">
         </div>
        @error('no_hp')
            <strong class="text-danger">{{ $message }}</strong>
        @enderror
    </div>

    <div class="form-group">
        <label for="password" class="label-control">Password
        @if(isset($data))
          <span class="text-danger">*
          Kosongkan Jika Tidak Ingin Mengganti Password
        @endif    
        </span></label>
        <input type="password" autocomplete="off" maxlength="200" class="form-control" name="password" id="password" placeholder="Password">
        @error('password')
            <strong class="text-danger">{{ $message }}</strong>
        @enderror
    </div>

    <div class="form-group">
        <label for="password_confirm" class="label-control">Konfirmasi Password
        @if(isset($data))
          <span class="text-danger">*
          Kosongkan Jika Tidak Ingin Mengganti Password
        @endif    
        </span></label>
        <input type="password" autocomplete="off" maxlength="200" class="form-control" name="password_confirm" id="password_confirm" placeholder="Konfirmasi Password">
        @error('password_confirm')
            <strong class="text-danger">{{ $message }}</strong>
        @enderror
    </div>

    <div class="form-group">
        <label for="level_id" class="label-control">Jabatan <span class="text-danger">*</span></label>
        <select class="form-control select2" name="level_id" id="level_id" tabindex="-1" required>
            @foreach ($levels as $level)
            <option value="{{ $level->id }}" @if($level->id == old('level_id',@$data->level_id)) selected @endif>{{ $level->nama_level }}</option>
            @endforeach
        </select>
        @error('level_id')
            <strong class="text-danger">{{ $message }}</strong>
        @enderror
    </div>
@endsection