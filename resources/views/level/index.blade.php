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
                       <th>No </th>
                       <th>Level </th>
                       <th>Aksi</th>
                    </tr>
                 </thead>
                 <tbody>
                   @foreach ($datas as $data)
                   <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $data->nama_level }}</td>
                      <form action="{{ route($settings['route'].'.destroy',$data->id) }}" method="POST" class="delete-data" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                        @csrf
                        <input type="hidden" name="_method" value="DELETE">
                        <td>
                           @if (@$settings['ubah'] || !isset($settings['ubah']))
                           <a type="button" class="btn btn-outline-warning btn-sm" href="{{ route($settings['route'].'.edit',$data->id) }}" > Edit</a>
                           @endif
                           
                           @if ($data->id != 1 && $data->id != 2 && $data->id != 3 && $data->id != 4 && $data->id != 5)
                              @if (@$settings['hapus'] || !isset($settings['hapus']))
                              <button type="submit" class="m-2 btn btn-outline-danger btn-sm"> Hapus</button>
                              @endif
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
@endsection