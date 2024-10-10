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
        <label for="nama" class="label-control">Nama Staff <span class="text-danger">*</span></label>
        <input type="text" autocomplete="off" maxlength="200" class="form-control" name="nama" id="nama" placeholder="Nama Staff" required value="{{ old('nama',@$data->nama) }}">
        @error('nama')
            <strong class="text-danger">{{ $message }}</strong>
        @enderror
    </div>
    
    <div class="form-group">
        <label for="username" class="label-control">Username <span class="text-danger">*</span></label>
        <input type="text" autocomplete="off" maxlength="200" class="form-control" name="username" id="username" placeholder="Username" required value="{{ old('username',@$data->username) }}">
        @error('username')
            <strong class="text-danger">{{ $message }}</strong>
        @enderror
    </div>
    
    <div class="form-group">
        <label for="no_hp" class="label-control">No Hp <span class="text-danger">* Tambahkan kode +62</span></label>
        <div class="input-group has-validation">
            <input type="text" autocomplete="off" maxlength="200" class="form-control phone" name="no_hp" id="no_hp" required value="{{ old('no_hp',@$data->no_hp) }}">
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

    <div class="wrapper">
        @if (isset($data))
            {{-- Cek Jika Jabatan Satgas, Tampilkan Field Unit --}}
            @if ($data->level_id == '4')
            <div class="form-group">
                <label for="unit_id" class="label-control">Unit <span class="text-danger">*</span></label>
                <select class="form-control select2" name="unit_id" id="unit_id" tabindex="-1" required>
                    @foreach ($units as $unit)
                    <option value="{{ $unit->id }}" @if($unit->id == old('unit_id',@$data->unit_id)) selected @endif>{{ $unit->nama_unit }}</option>
                    @endforeach
                </select>
                @error('unit_id')
                    <strong class="text-danger">{{ $message }}</strong>
                @enderror
            </div>
            @endif

            {{-- Cek Jika Jabatan Guru, Tampilkan Field Kelas --}}
            @if ($data->level_id == '3')
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
            @endif
        @endif
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $("#level_id").change(function (e) { 
            const value = $(this).val();

            // Jika Jabatan Satgas, Maka Tampilkan Field Unit
            if(value == '4'){
                $('.wrapper').html(`
                    <div class="form-group">
                        <label for="unit_id" class="label-control">Unit <span class="text-danger">*</span></label>
                        <select class="form-control select2" name="unit_id" id="unit_id" tabindex="-1" required>
                            @foreach ($units as $unit)
                            <option value="{{ $unit->id }}" @if($unit->id == old('unit_id',@$data->unit_id)) selected @endif>{{ $unit->nama_unit }}</option>
                            @endforeach
                        </select>
                        @error('unit_id')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                `);

                $('.select2').select2();
            // Jika Jabatan Guru, Maka Tampilkan Field Kelas
            }else if(value == '3'){
                $('.wrapper').html(`
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
                `);

                $('.select2').select2();
            }else{
                $('.wrapper').html('');
            }
        });
    });
</script>
@endpush