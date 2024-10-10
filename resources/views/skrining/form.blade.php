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

<div class="form-group mb-4">
  <div class="row">
    <input type="hidden" name="status_skrining" value="{{ $statusSkrining }}">
    {{-- Jika Input Skrining Untuk Diri Sendiri --}}
    @if ($statusSkrining == 'self')
    
    {{-- Jika Staff --}}
    @if (isset($staff_id))
    <div class="col-md-6">
        <label for="nama" class="label-control">Nama Staff <span class="text-danger">*</span></label>
        <input type="text" autocomplete="off" maxlength="200" class="form-control" name="nama" id="nama" readonly required value="{{ (@$data->staff_id) ? @$data->staff->nama : Auth::user()->nama }}">
        <input type="hidden" value="{{ $staff_id }}" name="staff_id">
        @error('nama')
        <strong class="text-danger">{{ $message }}</strong>
        @enderror
    </div>
    @endif

    {{-- Jika Siswa --}}
    @if (isset($siswa_id))
    <div class="col-md-6">
        <label for="nama" class="label-control">Nama Siswa | Unit | Kelas <span class="text-danger">*</span></label>
        <input type="text" autocomplete="off" maxlength="200" class="form-control" name="nama" id="nama" readonly required value="{{ (@$data->siswa_id) ? @$data->siswa->nama ." | ". @$data->siswa->kelas->unit->nama_unit ." | ". @$data->siswa->kelas->nama_kelas : Auth::user()->nama ." | ". Auth::user()->kelas->unit->nama_unit ." | ". Auth::user()->kelas->nama_kelas}}">
        <input type="hidden" value="{{ $siswa_id }}" name="siswa_id">
        @error('nama')
        <strong class="text-danger">{{ $message }}</strong>
        @enderror
    </div>
    @endif

    {{-- Jika Input Skrining SISWA Diinputkan oleh Petugas --}}
    @elseif($statusSkrining == 'siswa')
    <div class="col-md-6">
      <label for="siswa_id" class="label-control">Pilih Siswa <span class="text-danger">*</span></label>
      <select class="form-control select2" name="siswa_id" id="siswa_id" tabindex="-1" required>
          <option value="">- Pilih Siswa -</option>
          @foreach ($anggotaSekolah as $anggota)
          <option value="{{ $anggota->id }}" @if($anggota->id == old('siswa_id',@$data->siswa_id)) selected @endif>{{ $anggota->nama }} | {{ $anggota->kelas->unit->nama_unit }} | {{ $anggota->kelas->nama_kelas }}</option>
          @endforeach
      </select>
      @error('siswa_id')
          <strong class="text-danger">{{ $message }}</strong>
      @enderror
    </div>

    {{-- Jika Input Skrining STAFF Diinputkan oleh Petugas --}}
    @elseif($statusSkrining == 'staff')
    <div class="col-md-6">
      <label for="staff_id" class="label-control">Pilih Staff <span class="text-danger">*</span></label>
      <select class="form-control select2" name="staff_id" id="staff_id" tabindex="-1" required>
          <option value="">- Pilih Staff -</option>
          @foreach ($anggotaSekolah as $anggota)
          <option value="{{ $anggota->id }}" @if($anggota->id == old('staff_id',@$data->staff_id)) selected @endif>{{ $anggota->nama }}</option>
          @endforeach
      </select>
      @error('staff_id')
          <strong class="text-danger">{{ $message }}</strong>
      @enderror
    </div>

    @endif

    <div class="col-md-3">
        <label for="tgl_pengisian" class="label-control">Tgl Pengisian <span class="text-danger">*</span></label>
        <input type="datetime" autocomplete="off" maxlength="200" class="form-control" name="tgl_pengisian" id="tgl_pengisian" required readonly value="{{ date('Y-m-d H:i') }}">
        @error('tgl_pengisian')
        <strong class="text-danger">{{ $message }}</strong>
        @enderror
    </div>
  </div>
</div>

<div class="form-group mb-3">
  <span class="text-danger">*Formulir ini bertujuan untuk mengumpulkan data riwayat kesehatan sehubung dengan pelaksanaan protokol pencegah dan penyebaran wabah Covid-19 atau pandemi lain bagi anggota Sekolah Budi Bakti</span>
  <table class="table">
    <thead>
      <tr>
        <th>Nama Gejala / Penyakit</th>
        <th>Ya</th>
      </tr>
    </thead>
    <tbody class="fw-bold">
      <tr>
        <td>Apakah Keluarga Rumah Anda Ada Yang Terjangkit Covid-19 atau Pandemi Lain Dalam Seminggu Terakhir ?</td>
        <td><input class="form-check-input" @if(@$data->status_kesehatan_keluarga == 'pandemi') checked @endif type="checkbox" name="status_kesehatan_keluarga"></td>
      </tr>
      @foreach ($penyakits as $penyakit)
      <tr>
        <td>{{ $penyakit->nama_penyakit }}</td>
        <td><input class="form-check-input" type="checkbox" @if(@$data) @if(@$data->getCekPenyakitAttribute($penyakit->id)) checked @endif @endif name="penyakit_{{ $penyakit->id }}"></td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

<div class="form-group mb-3">
  <div class="row">
    <div class="col-md-8">
        <label for="swab_file" class="label-control">Upload Bukti Swab <span class="text-danger">(upload hanya jika anda terkena covid-19)</span></label>
        <input type="file" class="form-control" name="swab_file" id="swab_file" value="">
        @error('swab_file')
        <strong class="text-danger">{{ $message }}</strong>
        @enderror
    </div>
  </div>
</div>
@endsection