@extends('layouts.index')

@section('breadcrumb')
@include('layouts.include._breadcrumb')    
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
@endpush

@section('content')

<div class="row">
   <div class="col-md-12">
      <div class="card">
         <div class="card-body">
            <form style="width: 100%;" method="GET">
               <div class="form-group">
                   <div class="row">

                       <div class="col-md-4">
                           <label for="level_id" class="form-control-label mb-2">Pilih Jabatan / Level : </label>
                           <select name="level_id" class="form-control select2" id="perangkat_daerah_id"
                               data-toggle="select">
                               <option value="">Pilih Jabatan / Level</option>
                               @foreach ($levels as $level)
                               <option value="{{ $level->id }}" @if($request->get('level_id') == $level->id ) SELECTED
                                   @endif>{{ $level->nama_level }}</option>
                               @endforeach
                           </select>
                       </div>

                   </div>
               </div>
               <div class="row mt-3">
                   <div class="col-md-12">
                       <button class="btn btn-primary btn-sm" type="submit">Tampil</button>
                       <a href="{{ url()->current() }}" class="btn btn-primary btn-sm">Refresh</a>
                   </div>
               </div>
           </form>
         </div>
      </div>
   </div>
</div>

<div class="row">
  <div class="col-sm-12">
     <div class="card">
        <div class="card-header d-flex justify-content-between">
           <div class="header-title">
              <h4 class="card-title">{{ $settings['title'] }}</h4>
            </div>
        </div>
        <div class="card-body">
           <div class="table-responsive">
              <table id="datatable-print" class="table">
               <thead>
                  <tr>
                     <th>No</th>
                     <th>Nama Staff</th>
                     <th>Jabatan</th>
                     <th>Username</th>
                     <th>No Hp</th>
                     <th>Unit  <i class="font-danger font-size-11">(Khusus Satgas Unit)</i></th>
                     <th>Kelas <i class="font-danger font-size-11">(khusus guru)</i></th>
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

@push('scripts')
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
@endpush