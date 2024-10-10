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
                       <th>Nama Pelanggan</th>
                       <th>No Telp</th>
                       <th>Alamat</th>
                       <th>Aksi</th>
                    </tr>
                 </thead>
                 <tbody>
                   @foreach ($datas as $data)
                   <tr>
                     <td>{{ $loop->iteration }}</td>
                     <td>{{ $data->nama_pelanggan }}</td>
                     <td>{{ $data->no_telp }}</td>
                     <td>{{ $data->alamat }}</td>
                     @include('layouts.include.basic-action')
                   </tr>
                   @endforeach
                 </tfoot>
              </table>
           </div>
        </div>
     </div>
  </div>
</div>
@endsection