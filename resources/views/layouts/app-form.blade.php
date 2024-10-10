{{--template dasar form--}}
@extends('layouts.index')

@push('styles')

@endpush

@section('breadcrumb')
@include('layouts.include._breadcrumb')    
@endsection

@section('content')
    <div class="row">
      <div class="col-md-12 col-lg-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between">
            <div class="header-title">
              <h4 class="card-title">@yield('form-title')</h4>
            </div>
            
            <a href="{{ route($settings['route'].'.index') }}" class="btn btn-sm btn-warning"><i class="fa fa-arrow-left"></i> Kembali</a>
            
          </div>
          <div class="card-body">
            <form action="{{ $settings['action'] }}" method="POST" enctype="multipart/form-data" id="form">
              @csrf
              @yield('form')
              <div class="form-group">
                  <button class="btn btn-primary" type="submit">Simpan</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
@endsection

{{-- @push('scripts')
    @stack('scripts')
@endpush --}}
