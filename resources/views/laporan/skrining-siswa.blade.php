@extends('layouts.index')

@section('breadcrumb')
@include('layouts.include._breadcrumb')    
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush

@section('content')

<div class="row">
   <div class="col-md-12">
      <div class="card">
         <div class="card-body">
            <form style="width: 100%;" method="GET">
               <div class="form-group">
                   <div class="row">

                       <div class="col-md-6">
                           <label for="periode" class="form-control-label mb-2">Tanggal Periode : </label>
                           <input class="form-control" type="text" autocomplete="off" name="periode" id="periode" value="{{ @$request->get('periode') }}">
                       </div>

                       <div class="col-md-4">
                           <label for="status" class="form-control-label mb-2">Pilih Status : </label>
                           <select name="status" class="form-control select2" id="perangkat_daerah_id"
                               data-toggle="select">
                               <option value="">Pilih Status</option>
                               <option value="sehat" @if($request->get('status') == 'sehat' ) SELECTED @endif >Sehat</option>
                               <option value="sakit" @if($request->get('status') == 'sakit' ) SELECTED @endif >Sakit</option>
                               <option value="karantina" @if($request->get('status') == 'karantina' ) SELECTED @endif >Karantina</option>
                               <option value="positif" @if($request->get('status') == 'positif' ) SELECTED @endif >Positif</option>
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
											<th>Nama Siswa</th>
											<th>NISN</th>
											<th>Unit - Kelas</th>
											<th>Tgl Pengisian</th>
											<th>Status Kesehatan</th>
										</tr>
                 </thead>
                 <tbody>
									@foreach ($datas as $data)
									<tr>
											<td>{{ $loop->iteration }}</td>
											<td>{{ $data->siswa->nama }}</td>
											<td>{{ $data->siswa->nomor_induk }}</td>
											<td>{{ $data->siswa->kelas->unit->nama_unit }} - {{ $data->siswa->kelas->nama_kelas }}</td>
											<td>{{ $data->tgl_pengisian }}</td>
											<td align="center">{!! $data->desain_status !!}</td>
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

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
$(document).ready(function() {
    // FLATPICKR
      flatpickr('#periode', {
         mode: "range",
      });
      $("#periode").prop('readonly', false)
      $("#periode").prop('required', true)
} );
</script>
@endpush