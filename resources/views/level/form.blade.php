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
    <label for="nama_level" class="label-control">Nama Jabatan <span class="text-danger">*</span></label>
    @if (@$data->id == 1 || @$data->id == 2 || @$data->id == 3 || @$data->id == 4 || @$data->id == 5)
    <input type="text" maxlength="200" class="form-control" name="nama_level" id="nama_level" placeholder="Nama Jabatan" required value="{{ old('nama_level',@$data->nama_level) }}" readonly>
    @else
    <input type="text" maxlength="200" class="form-control" name="nama_level" id="nama_level" placeholder="Nama Jabatan" required value="{{ old('nama_level',@$data->nama_level) }}">
    @endif
    @error('nama_level')
    <strong class="text-danger">{{ $message }}</strong>
    @enderror
</div>
<div class="form-group table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>
                    <input type="checkbox" class="check_all" data-target=".pilihan" id="pilih">
                    <label for="pilih">Pilih Semua</label>
                </th>

                <th>
                    Menu
                </th>

                <th>
                    Aksi
                </th>
            </tr>
        </thead>
        <tbody>
            @php
            $nama = "";
            $pil = 0;
            @endphp
            @foreach($menus as $key => $menu)
            @if($nama != $menu->nama_menu)
            @php

            $pil ++;
            @endphp
            @if($key > 0)
            </tr>

            @endif
            <tr>
                <td>
                    <input type="checkbox" class="check_all pilihan" data-target=".pilihan-{{ $pil }}">
                </td>
                <td>
                    {{ $menu->nama_menu }}

                </td>
                <td>
                    <input type="checkbox" @if(isset($levelMenus) && in_array($menu->id,$levelMenus)) checked @endif
                    id="menu-{{ $menu->id }}" name="menu_id[]" class="pilihan pilihan-{{ $pil }}"
                    value="{{ $menu->id }}">
                    <label for="menu-{{ $menu->id }}">{{ $menu->aksi_menu }}</label>
                    @php
                    $nama = $menu->nama_menu;

                    @endphp
                    @else
                    <input type="checkbox" @if(isset($levelMenus) && in_array($menu->id,$levelMenus)) checked @endif
                    id="menu-{{ $menu->id }}" name="menu_id[]" class="pilihan pilihan-{{ $pil }}"
                    value="{{ $menu->id }}">
                    <label for="menu-{{ $menu->id }}">{{ $menu->aksi_menu }}</label>
                    @endif
                    @endforeach
                </td>
        </tbody>
    </table>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $(document).on('change', '.check_all', function (e) {
            $($(this).data('target')).prop('checked', $(this).is(':checked'));
        });
    });
</script>
@endpush