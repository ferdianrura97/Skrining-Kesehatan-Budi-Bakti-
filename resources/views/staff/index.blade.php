@extends('layouts.index')

@section('breadcrumb')
@include('layouts.include._breadcrumb')    
@endsection

@section('content')

<div class="row">
  <div class="col-sm-12">
     <div class="card">
        <div class="card-header d-flex justify-content-between">
           <div class="header-title">
              <h4 class="card-title">{{ $settings['title'] }}</h4>
            </div>
            @if (Helper::cek_akses($settings['title'], 'Tambah'))
               <a href="{{ route($settings['route'].'.create') }}" class="btn btn-sm btn-primary float-right">+ Tambah {{ $settings['title'] }}</a>
            @endif
        </div>
        <div class="card-body">
           <div class="table-responsive">
              <table id="datatable" class="table" data-toggle="data-table">
                 <thead>
                    <tr>
                       <th>No</th>
                       <th>Nama Staff</th>
                       <th>Jabatan</th>
                       <th>Username</th>
                       <th>No Hp</th>
                       <th>Unit  <i class="font-danger font-size-11">(Khusus Satgas Unit)</i></th>
                       <th>Kelas <i class="font-danger font-size-11">(khusus guru)</i></th>
                       <th>Aksi</th>
                    </tr>
                 </thead>
                 <tbody>
                   @foreach ($datas as $data)
                   <tr>
                     <td>{{ $loop->iteration }}</td>
                     <td>{{ $data->nama }}</td>
                     <td>{{ $data->level->nama_level }}</td>
                     <td>{{ $data->username }}</td>
                     <td>{{ $data->no_hp }}</td>
                     <td>{{ (@$data->unit->nama_unit) ?? "-" }}</td>
                     <td>{{ (@$data->kelas->nama_kelas) ? $data->kelas->unit->nama_unit ." - ". $data->kelas->nama_kelas  : "-" }}</td>
                     @include('layouts.include.basic-action')
                   </tr>
                   @endforeach
                 </tbody>
              </table>
           </div>
        </div>
     </div>
  </div>
</div>
@endsection