@extends('layouts.index')

@section('breadcrumb')
@include('layouts.include._breadcrumb')
@endsection

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-12">
                        <div class="tab-content">
                            <div class="bd-example">
                                <nav>
                                    <div class="mb-3 nav nav-tabs" id="nav-tab" role="tablist">
                                        <button class="nav-link d-flex align-items-center active"
                                            id="skrining-siswa-tab" data-bs-toggle="tab"
                                            data-bs-target="#skrining-siswa" type="button" role="tab"
                                            aria-controls="skrining-siswa" aria-selected="true">Data Skrining Siswa</button>
                                        <button class="nav-link" id="skrining-staff-tab" data-bs-toggle="tab"
                                            data-bs-target="#skrining-staff" type="button" role="tab"
                                            aria-controls="skrining-staff" aria-selected="false">Data Skrining Staff</button>
                                    </div>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="header-title">
                                    <h4 class="card-title">{{ $settings['title'] }}</h4>
                                </div>
                            </div>
                            <div class="col-md-7" style="text-align: right;">
                                @if (Helper::cek_akses($settings['title'], 'Tambah'))
                                <a href="{{ route($settings['route'].'.create', 'status=siswa') }}"
                                    class="btn btn-sm btn-warning float-right">+ Tambah {{ $settings['title'] }}
                                    Siswa</a>

                                <a href="{{ route($settings['route'].'.create', 'status=staff') }}"
                                    class="btn btn-sm btn-primary float-right">+ Tambah {{ $settings['title'] }}
                                    Staff</a>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>

                <div class="tab-content" id="nav-tabContent">

                  <div class="tab-pane fade active show" id="skrining-siswa" role="tabpanel" aria-labelledby="skrining-siswa-tab">
                     <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table" data-toggle="data-table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Siswa</th>
                                        <th>NISN</th>
                                        <th>Unit - Kelas</th>
                                        <th>Tgl Pengisian</th>
                                        <th>Status Kesehatan</th>
                                        <th>Stakes Keluarga</th>
                                        <th>Status Masuk Sekolah</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($siswas as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->siswa->nama }}</td>
                                        <td>{{ $data->siswa->nomor_induk }}</td>
                                        <td>{{ $data->siswa->kelas->unit->nama_unit }} - {{ $data->siswa->kelas->nama_kelas }}</td>
                                        <td>{{ $data->tgl_pengisian }}</td>
                                        <td align="center">{!! $data->desain_status !!}</td>
                                        <td align="center">{!! $data->desain_status_kesehatan_keluarga !!}</td>
                                        <td align="center">{!! $data->pesan_masuk_sekolah !!}</td>

                                        <form action="{{ route($settings['route'].'.destroy',[$data->id, 'status' => 'siswa']) }}" method="POST" class="delete-data" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                            @csrf
                                            <input type="hidden" name="_method" value="DELETE">
                                            <td>
                                              @if (@$settings['ubah'] || !isset($settings['ubah']))
                                              <a type="button" class="btn btn-outline-warning btn-sm" href="{{ route($settings['route'].'.edit',[$data->id, 'status' => 'siswa']) }}" > Edit</a>
                                              @endif
                                              @if (@$settings['hapus'] || !isset($settings['hapus']))
                                                <button type="submit" class="m-2 btn btn-outline-danger btn-sm"> Hapus</button>
                                              @endif
                                            </td>
                                          </form>
                                          
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                  </div>

                  <div class="tab-pane fade" id="skrining-staff" role="tabpanel" aria-labelledby="skrining-staff-tab">
                     <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table" data-toggle="data-table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Staff</th>
                                        <th>Jabatan</th>
                                        <th>Tgl Pengisian</th>
                                        <th>Status Kesehatan</th>
                                        <th>Stakes Keluarga</th>
                                        <th>Status Masuk Sekolah</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($staffs as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->staff->nama }}</td>
                                        <td>{{ $data->staff->level->nama_level }}</td>
                                        <td>{{ $data->tgl_pengisian }}</td>
                                        <td align="center">{!! $data->desain_status !!}</td>
                                        <td align="center">{!! $data->desain_status_kesehatan_keluarga !!}</td>
                                        <td align="center">{!! $data->pesan_masuk_sekolah !!}</td>

                                        <form action="{{ route($settings['route'].'.destroy',[$data->id, 'status' => 'staff']) }}" method="POST" class="delete-data" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                            @csrf
                                            <input type="hidden" name="_method" value="DELETE">
                                            <td>
                                              @if (@$settings['ubah'] || !isset($settings['ubah']))
                                              <a type="button" class="btn btn-outline-warning btn-sm" href="{{ route($settings['route'].'.edit',[$data->id, 'status' => 'staff']) }}" > Edit</a>
                                              @endif
                                              @if (@$settings['hapus'] || !isset($settings['hapus']))
                                                <button type="submit" class="m-2 btn btn-outline-danger btn-sm"> Hapus</button>
                                              @endif
                                            </td>
                                          </form>
                                    </tr>
                                    @endforeach
                                    </tfoot>
                            </table>
                        </div>
                    </div>
                  </div>

                </div>

            </div>
        </div>
    </div>
    @endsection