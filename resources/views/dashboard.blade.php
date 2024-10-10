@extends('layouts.index')

@section('breadcrumb')
@include('layouts.include._breadcrumb')    
@endsection

@push('styles')
<style>
    .fa-icon{
        font-size: 40px;
        color: cornflowerblue;
    }
</style>
@endpush

@section('content')

<div class="row">

    {{-- Cek, Jika Sudah Input Skrining Minggu Ini, Maka Tampilkan Gambar Status  --}}
    @if (Auth::user()->check_skrining)

        {{-- Jika Status Sehat --}}
        @if (Auth::user()->last_skrining->status == 'sehat')
        <div class="col-md-12">
            <div class="card" data-aos="fade-up" data-aos-delay="800">
                <div class="card-body bg-info rounded">
                    <div class="text-center">
                        <img class="w-80 rounded border mb-3" src="{{ asset('assets/images/pages/Uniform Day.jpg') }}" alt="">
                        <div class="w-80 text-center mx-5 rounded">
                            <h3>Anda Diizinkan Untuk Offline<br>Disekolah</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        {{-- Jika Status Sakit --}}
        @if (Auth::user()->last_skrining->status == 'sakit')
        <div class="col-md-12">
            <div class="card" data-aos="fade-up" data-aos-delay="800">
                <div class="card-body bg-danger rounded">
                    <div class="text-center">
                        <img class="w-80 rounded border mb-3" src="{{ asset('assets/images/pages/Reading Book.png') }}" alt="">
                        <div class="w-80 text-center mx-5 rounded">
                            <h3>Maaf, Besok Ananda Offline Dari Rumah</h3>
                            <h3>Semoga Lekas Sembuh</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        {{-- Jika Status Karantina Atau Positif --}}
        @if (Auth::user()->last_skrining->status == 'karantina' || Auth::user()->last_skrining->status == 'positif')
        <div class="col-md-12">
            <div class="card" data-aos="fade-up" data-aos-delay="800">
                <div class="card-body bg-warning rounded">
                    <div class="text-center">
                        <img class="w-80 rounded border mb-3" src="{{ asset('assets/images/pages/Online School.jpg') }}" alt="">
                        <div class="w-80 text-center mx-5 rounded">
                            <h3>Maaf, Untuk Besok Ananda Offline Dari Rumah <br> Hingga Selesai Masa Karantina</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    @endif

    <div class="col-md-12 col-lg-12">
        <div class="row">
            <div class="col-md-4">
                {{-- Cek, Jika Sudah Input Skrining Minggu Ini, Maka Update  --}}
                @if (Auth::user()->check_skrining)

                <li class="swiper-slide card card-slide text-white" data-aos="fade-up" data-aos-delay="700" style="background: #2b70b5">
                    <a href="@if(Auth::user()->check_update) {{ route('skrining.edit', [Auth::user()->last_skrining->id, 'status=self']) }} @else #! @endif " class="text-white">
                        <div class="card-body">
                            <div class="progress-widget">
                                <svg width="50" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                            <path fill-rule="evenodd" clip-rule="evenodd" d="M8.92574 16.39H14.3119C14.7178 16.39 15.0545 16.05 15.0545 15.64C15.0545 15.23 14.7178 14.9 14.3119 14.9H8.92574C8.5198 14.9 8.18317 15.23 8.18317 15.64C8.18317 16.05 8.5198 16.39 8.92574 16.39ZM12.2723 9.9H8.92574C8.5198 9.9 8.18317 10.24 8.18317 10.65C8.18317 11.06 8.5198 11.39 8.92574 11.39H12.2723C12.6782 11.39 13.0149 11.06 13.0149 10.65C13.0149 10.24 12.6782 9.9 12.2723 9.9ZM19.3381 9.02561C19.5708 9.02292 19.8242 9.02 20.0545 9.02C20.302 9.02 20.5 9.22 20.5 9.47V17.51C20.5 19.99 18.5099 22 16.0545 22H8.17327C5.59901 22 3.5 19.89 3.5 17.29V6.51C3.5 4.03 5.5 2 7.96535 2H13.2525C13.5099 2 13.7079 2.21 13.7079 2.46V5.68C13.7079 7.51 15.203 9.01 17.0149 9.02C17.4381 9.02 17.8112 9.02316 18.1377 9.02593C18.3917 9.02809 18.6175 9.03 18.8168 9.03C18.9578 9.03 19.1405 9.02789 19.3381 9.02561ZM19.6111 7.566C18.7972 7.569 17.8378 7.566 17.1477 7.559C16.0527 7.559 15.1507 6.648 15.1507 5.542V2.906C15.1507 2.475 15.6685 2.261 15.9646 2.572C16.5004 3.13476 17.2368 3.90834 17.9699 4.67837C18.7009 5.44632 19.4286 6.21074 19.9507 6.759C20.2398 7.062 20.0279 7.565 19.6111 7.566Z" fill="currentColor"></path> </svg>  

                                <div class="progress-detail">
                                    <p class="mb-2">Update Form Skrining Anda</p>
                                    <i style="font-size: 50px;" class="fa fa-plus"></i>
                                </div>
                            </div>
                            {{-- Cek, Apakah User Sudah Bisa Mengedit Skriningnya ?  --}}
                            @if(Auth::user()->check_update)
                            <i class="text-white" style="font-size: 11px">Anda sudah bisa meng-update data skrining, jika terdapat perubahan gejala</i>
                            @else
                            <i class="text-warning" style="font-size: 11px">Anda dapat meng-update kembali data skrining anda pada pukul {{ Helper::hitungJamBolehInputSkrining(Auth::user()->last_skrining->tgl_pengisian) }} </i>
                            @endif
                        </div>
                    </a>

                </li>

                {{-- Jika Belum Input Skrining--}}
                {{-- Tampilkan Tombol Buat Skrining --}}
                {{-- Check dulu Jika Waktu Sekarang Sesuai Dengan Waktu Wajib Isi di Pengaturan --}}
                @else                
                <li class="swiper-slide card card-slide text-white" data-aos="fade-up" data-aos-delay="700" style="background: #4ac18e">
                    <a href=" @if(\Helper::checkWaktuBolehInputSkrining()) {{ route('skrining.create', 'status=self') }} @else #! @endif" class="text-white">
                        <div class="card-body">
                            <div class="progress-widget">
                                <svg width="50" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                            <path fill-rule="evenodd" clip-rule="evenodd" d="M8.92574 16.39H14.3119C14.7178 16.39 15.0545 16.05 15.0545 15.64C15.0545 15.23 14.7178 14.9 14.3119 14.9H8.92574C8.5198 14.9 8.18317 15.23 8.18317 15.64C8.18317 16.05 8.5198 16.39 8.92574 16.39ZM12.2723 9.9H8.92574C8.5198 9.9 8.18317 10.24 8.18317 10.65C8.18317 11.06 8.5198 11.39 8.92574 11.39H12.2723C12.6782 11.39 13.0149 11.06 13.0149 10.65C13.0149 10.24 12.6782 9.9 12.2723 9.9ZM19.3381 9.02561C19.5708 9.02292 19.8242 9.02 20.0545 9.02C20.302 9.02 20.5 9.22 20.5 9.47V17.51C20.5 19.99 18.5099 22 16.0545 22H8.17327C5.59901 22 3.5 19.89 3.5 17.29V6.51C3.5 4.03 5.5 2 7.96535 2H13.2525C13.5099 2 13.7079 2.21 13.7079 2.46V5.68C13.7079 7.51 15.203 9.01 17.0149 9.02C17.4381 9.02 17.8112 9.02316 18.1377 9.02593C18.3917 9.02809 18.6175 9.03 18.8168 9.03C18.9578 9.03 19.1405 9.02789 19.3381 9.02561ZM19.6111 7.566C18.7972 7.569 17.8378 7.566 17.1477 7.559C16.0527 7.559 15.1507 6.648 15.1507 5.542V2.906C15.1507 2.475 15.6685 2.261 15.9646 2.572C16.5004 3.13476 17.2368 3.90834 17.9699 4.67837C18.7009 5.44632 19.4286 6.21074 19.9507 6.759C20.2398 7.062 20.0279 7.565 19.6111 7.566Z" fill="currentColor"></path> </svg>  

                                <div class="progress-detail">
                                    <p class="mb-2">Isi Form Skrining Anda</p>
                                    <i style="font-size: 50px;" class="fa fa-plus"></i>
                                </div>
                            </div>
                            @if (!Helper::checkWaktuBolehInputSkrining())
                            <i class="text-white" style="font-size: 11px">Mohon Maaf, Pengisian data skrining hanya dibuka dari jam {{ \Helper::getJamWajibSkrining()[0] }} - {{ \Helper::getJamWajibSkrining()[1] }}.. Silahkan Hubungi Admin Melalui Kontak Dibawah </i>
                            @endif
                        </div>
                    </a>
                </li>

                @endif
            </div>
            <div class="col-md-8">
                <div class="card" data-aos="fade-up" data-aos-delay="600">
                    <div class="flex-wrap card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="mb-2 card-title">Catatan</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-2">
                            <ul>
                                <li class="mb-3">
                                    <i class="text-danger">Setelah mengisi data, anda tidak dapat meng-update data kembali hingga <b> {{ \Helper::getJamUpdateSkrining() }} </b> jam berikutnya </i>
                                </li>
                                <li class="mb-3">
                                    <i class="text-danger"> Pengisian data skrining dimulai dari jam ? <b> {{ \Helper::getJamWajibSkrining()[0] }} - {{ \Helper::getJamWajibSkrining()[1] }} </b> </i>
                                </li>
                                <li class="mb-3">
                                    <i class="text-danger"> Pengisian Data Skrining Setiap Hari Apa ? (Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday,Everyday) : <b> {{ \Helper::getHariPengisianSkrining() }} </b> </i>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-md-12 col-xl-12">
        <div class="card" data-aos="fade-up" data-aos-delay="600">
            <div class="flex-wrap card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="mb-2 card-title">Kontak Satgas</h4>
                    <i class="text-danger">Jika ternyata terjadi kendala dan tidak dapat mengisi atau terlambat mengisi data, dapat menghubungi satgas untuk konfirmasi serta menyertakan bukti tidak dapat mengisi di jam tersebut </i>
                </div>
            </div>
            <div class="card-body">
                <div class="mb-2">
                    <ul>
                        @foreach ($satgas as $s)
                        <li>{{ $s->nama }} : {{ $s->no_hp }} <i><b><a class="text-primary" href="https://wa.me/{{ $s->no_hp }}" target="_blank">(Hubungi WA <i class="fa fa-whatsapp"></i> )</a></b></i> </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    
    {{-- Chart DLL, Untuk Admin & Litbang --}}
    @if (Auth::user()->level->nama_level == "Admin" || Auth::user()->level->nama_level == "Litbang")
    <div class="col-md-12 col-lg-12">
        <div class="card aos-init aos-animate" data-aos="fade-up" data-aos-delay="500">
            <div class="text-center card-body d-flex justify-content-around">
               <div>
                  <h2 class="mb-2 counter">{{ $ttlSiswa }}</h2>
                  <p class="mb-0 text-secondary">Total Siswa</p>
               </div>
               <hr class="hr-vertial">
               <div>
                  <h2 class="mb-2 counter">{{ $ttlStaff }}</h2>
                  <p class="mb-0 text-secondary">Total Staff</p>
               </div>
            </div>
         </div>
    </div>

    <div class="col-md-12">
        <div class="row">
            <div class="col-md-3">
                <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="800">
                    <div class="card-body">
                        <div class="progress-widget">
                            <div class="fa-icon" style="color: rgb(74, 193, 142);">
                                <i class="fa fa-medkit"></i>
                            </div>
                            <div class="progress-detail">
                                <p class="mb-2">Total Staff & Admin Sehat</p>
                                <h4 class="counter">{{ $ttlStaffSehat }}</h4>
                            </div>
                        </div>
                    </div>
                </li>
            </div>
            <div class="col-md-3">
                <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="800">
                    <div class="card-body">
                        <div class="progress-widget">
                            <div class="fa-icon">
                                <i class="fa fa-disease"></i>
                            </div>
                            <div class="progress-detail">
                                <p class="mb-2">Total Staff & Admin Sakit</p>
                                <h4 class="counter">{{ $ttlStaffSakit }}</h4>
                            </div>
                        </div>
                    </div>
                </li>
            </div>
            <div class="col-md-3">
                <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="800">
                    <div class="card-body">
                        <div class="progress-widget">
                            <div class="fa-icon" style="color: #f16a1b;">
                                <i class="fa fa-disease"></i>
                            </div>
                            <div class="progress-detail">
                                <p class="mb-2">Total Staff & Admin Karantina</p>
                                <h4 class="counter">{{ $ttlStaffKarantina }}</h4>
                            </div>
                        </div>
                    </div>
                </li>
            </div>
            <div class="col-md-3">
                <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="800">
                    <div class="card-body">
                        <div class="progress-widget">
                            <div class="fa-icon" style="color: #c03221;">
                                <i class="fa fa-disease"></i>
                            </div>
                            <div class="progress-detail">
                                <p class="mb-2">Total Staff & Admin Positif Pandemi</p>
                                <h4 class="counter">{{ $ttlStaffPositifPandemi }}</h4>
                            </div>
                        </div>
                    </div>
                </li>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="800">
                    <div class="card-body">
                        <div class="progress-widget">
                            <div class="fa-icon" style="color: rgb(74, 193, 142);">
                                <i class="fa fa-medkit"></i>
                            </div>
                            <div class="progress-detail">
                                <p class="mb-2">Total Siswa Sehat</p>
                                <h4 class="counter">{{ $ttlSiswaSehat }}</h4>
                            </div>
                        </div>
                    </div>
                </li>
            </div>
            <div class="col-md-3">
                <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="800">
                    <div class="card-body">
                        <div class="progress-widget">
                            <div class="fa-icon">
                                <i class="fa fa-disease"></i>
                            </div>
                            <div class="progress-detail">
                                <p class="mb-2">Total Siswa Sakit</p>
                                <h4 class="counter">{{ $ttlSiswaSakit }}</h4>
                            </div>
                        </div>
                    </div>
                </li>
            </div>
            <div class="col-md-3">
                <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="800">
                    <div class="card-body">
                        <div class="progress-widget">
                            <div class="fa-icon" style="color: #f16a1b;">
                                <i class="fa fa-disease"></i>
                            </div>
                            <div class="progress-detail">
                                <p class="mb-2">Total Siswa Karantina</p>
                                <h4 class="counter">{{ $ttlSiswaKarantina }}</h4>
                            </div>
                        </div>
                    </div>
                </li>
            </div>
            <div class="col-md-3">
                <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="800">
                    <div class="card-body">
                        <div class="progress-widget">
                            <div class="fa-icon" style="color: #c03221;">
                                <i class="fa fa-disease"></i>
                            </div>
                            <div class="progress-detail">
                                <p class="mb-2">Total Siswa Positif Pandemi</p>
                                <h4 class="counter">{{ $ttlSiswaPositifPandemi }}</h4>
                            </div>
                        </div>
                    </div>
                </li>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h4 class="">Persentase Siswa Mingguan</h4>
                            <i>Harian Jika Pandemi Memuncak (diatur di menu pengaturan)</i>
                        </div>
                    </div>

                    <div style="height:500px;">
                        <canvas id="siswaPieChart"></canvas>
                    </div>
                </div>
                <!-- end card-body -->
            </div>
            <!-- end card -->
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h4 class="">Persentase Staff Mingguan</h4>
                            <i>Harian Jika Pandemi Memuncak (diatur di menu pengaturan)</i>
                        </div>
                    </div>

                    <div style="height:500px;">
                        <canvas id="staffPieChart"></canvas>
                    </div>
                </div>
                <!-- end card-body -->
            </div>
            <!-- end card -->
        </div>

        {{-- SISWA TREND CHART --}}
        <div class="col-md-12">
            <div class="card" data-aos="fade-up" data-aos-delay="800">
                <div class="flex-wrap card-header d-flex justify-content-between align-items-center">
                    <div class="header-title">
                        <h4 class="card-title">Data Skrining Siswa</h4>
                        <p class="mb-0">Data Skrining Siswa</p>
                    </div>
                    <div class="d-flex align-items-center align-self-center">
                        <div class="d-flex align-items-center" style="color: #4ac18e;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" viewBox="0 0 24 24" fill="currentColor">
                                <g>
                                    <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
                                </g>
                            </svg>
                            <div style="margin-right: 10px;">
                                <span style="color:#4ac18e;">Sehat</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center" style="color: #6495ed;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" viewBox="0 0 24 24" fill="currentColor">
                                <g>
                                    <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
                                </g>
                            </svg>
                            <div style="margin-right: 10px;">
                                <span style="color:#6495ed;">Sakit</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center" style="color: #f16a1b;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" viewBox="0 0 24 24" fill="currentColor">
                                <g>
                                    <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
                                </g>
                            </svg>
                            <div style="margin-right: 10px;">
                                <span style="color:#f16a1b;">Karantina</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center" style="color: #c03221;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" viewBox="0 0 24 24" fill="currentColor">
                                <g>
                                    <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
                                </g>
                            </svg>
                            <div style="margin-right: 10px;">
                                <span style="color:#c03221;">Positif Pandemi</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <form method="GET">
                            <div class="col-md-12">
                                <select name="bulan" id="bulan">
                                    <option value="">Semua Bulan</option>
                                    @foreach($bulans as $key => $value)
                                    <option value="{{$key}}" @if($key==$request->get('bulan', date('m'))) selected
                                        @endif>{{$value}}</option>
                                    @endforeach
                                </select>
                                <select name="tahun" id="tahun">
                                    <option value="">Semua Tahun</option>
                                    <option value="{{date('Y') -2 }}" @if(date('Y') -2==$request->get('tahun',
                                        date('Y'))) selected @endif>{{date('Y') -2}}</option>
                                    <option value="{{date('Y') -1 }}" @if(date('Y') -1==$request->get('tahun',
                                        date('Y'))) selected @endif>{{date('Y') -1}}</option>
                                    <option value="{{date('Y') }}" @if(date('Y')==$request->get('tahun', date('Y')))
                                        selected @endif>{{date('Y')}}</option>
                                </select>

                                <button class="btn btn-primary btn-sm" type="submit">Tampil</button>
                                <a href="{{ url()->current() }}" class="btn btn-primary btn-sm">Refresh</a>
                            </div>
                        </form>
                    </div>
                    <div id="siswaTrendChart" class="d-main"></div>
                </div>
            </div>
        </div>


        {{-- STAFF TREND CHART --}}
        <div class="col-md-12">
            <div class="card" data-aos="fade-up" data-aos-delay="800">
                <div class="flex-wrap card-header d-flex justify-content-between align-items-center">
                    <div class="header-title">
                        <h4 class="card-title">Data Skrining Staff</h4>
                        <p class="mb-0">Data Skrining Staff</p>
                    </div>
                    <div class="d-flex align-items-center align-self-center">
                        <div class="d-flex align-items-center" style="color: #4ac18e;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" viewBox="0 0 24 24" fill="currentColor">
                                <g>
                                    <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
                                </g>
                            </svg>
                            <div style="margin-right: 10px;">
                                <span style="color:#4ac18e;">Sehat</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center" style="color: #6495ed;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" viewBox="0 0 24 24" fill="currentColor">
                                <g>
                                    <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
                                </g>
                            </svg>
                            <div style="margin-right: 10px;">
                                <span style="color:#6495ed;">Sakit</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center" style="color: #f16a1b;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" viewBox="0 0 24 24" fill="currentColor">
                                <g>
                                    <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
                                </g>
                            </svg>
                            <div style="margin-right: 10px;">
                                <span style="color:#f16a1b;">Karantina</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center" style="color: #c03221;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" viewBox="0 0 24 24" fill="currentColor">
                                <g>
                                    <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
                                </g>
                            </svg>
                            <div style="margin-right: 10px;">
                                <span style="color:#c03221;">Positif Pandemi</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <form method="GET">
                            <div class="col-md-12">
                                <select name="bulan" id="bulan">
                                    <option value="">Semua Bulan</option>
                                    @foreach($bulans as $key => $value)
                                    <option value="{{$key}}" @if($key==$request->get('bulan', date('m'))) selected
                                        @endif>{{$value}}</option>
                                    @endforeach
                                </select>
                                <select name="tahun" id="tahun">
                                    <option value="">Semua Tahun</option>
                                    <option value="{{date('Y') -2 }}" @if(date('Y') -2==$request->get('tahun',
                                        date('Y'))) selected @endif>{{date('Y') -2}}</option>
                                    <option value="{{date('Y') -1 }}" @if(date('Y') -1==$request->get('tahun',
                                        date('Y'))) selected @endif>{{date('Y') -1}}</option>
                                    <option value="{{date('Y') }}" @if(date('Y')==$request->get('tahun', date('Y')))
                                        selected @endif>{{date('Y')}}</option>
                                </select>

                                <button class="btn btn-primary btn-sm" type="submit">Tampil</button>
                                <a href="{{ url()->current() }}" class="btn btn-primary btn-sm">Refresh</a>
                            </div>
                        </form>
                    </div>
                    <div id="staffTrendChart" class="d-main"></div>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- Data SIswa Belum Input & Sakit, Untuk Halaman GUru & Satgas--}}
    @if (Auth::user()->level->nama_level == "Satgas" || Auth::user()->level->nama_level == "Guru")
    <div class="col-md-12 col-lg-12">
        <div class="card">
           <div class="card-header d-flex justify-content-between">
              <div class="header-title">
                 <h4 class="card-title">Data Siswa Yang Belum Input Skrining</h4>
               </div>
           </div>
           <div class="card-body">
              <div class="table-responsive">
                 <table class="table" data-toggle="data-table">
                    <thead>
                        <tr>
                           <th>No</th>
                           <th>Nama Siswa</th>
                           <th>Unit </th>
                           <th>Kelas </th>
                           <th>Nomor Induk</th>
                           <th>Tgl Lahir</th>
                           <th>Jenis Kelamin</th>
                           <th>No Hp</th>
                        </tr>
                     </thead>
                     <tbody>
                       @foreach ($dataSiswaBelumInput as $data)
                       <tr>
                         <td>{{ $loop->iteration }}</td>
                         <td>{{ $data->nama }}</td>
                         <td>{{ (@$data->kelas->unit->nama_unit) ?? "-" }}</td>
                         <td>{{ (@$data->kelas->nama_kelas) ?? "-" }}</td>
                         <td>{{ $data->nomor_induk }}</td>
                         <td>{{ $data->tgl_lahir }}</td>
                         <td>{{ $data->jenis_kelamin }}</td>
                         <td>{{ $data->no_hp }}</td>
                       </tr>
                       @endforeach
                     </tbody>
                 </table>
              </div>
           </div>
        </div>
     </div>

     <div class="col-md-12 col-lg-12">
        <div class="card">
           <div class="card-header d-flex justify-content-between">
              <div class="header-title">
                 <h4 class="card-title">Data Siswa Yang Tidak Dapat Mengikuti Pembelajaran Tatap Muka</h4>
               </div>
           </div>
           <div class="card-body">
              <div class="table-responsive">
                 <table class="table datatable" data-toggle="data-table">
                    <thead>
                        <tr>
                           <th>No</th>
                           <th>Nama Siswa</th>
                           <th>Unit </th>
                           <th>Kelas </th>
                           <th>Nomor Induk</th>
                           <th>Tgl Lahir</th>
                           <th>Jenis Kelamin</th>
                           <th>No Hp</th>
                        </tr>
                     </thead>
                     <tbody>
                       @foreach ($dataSiswaSakit as $data)
                       <tr>
                         <td>{{ $loop->iteration }}</td>
                         <td>{{ $data->nama }}</td>
                         <td>{{ (@$data->kelas->unit->nama_unit) ?? "-" }}</td>
                         <td>{{ (@$data->kelas->nama_kelas) ?? "-" }}</td>
                         <td>{{ $data->nomor_induk }}</td>
                         <td>{{ $data->tgl_lahir }}</td>
                         <td>{{ $data->jenis_kelamin }}</td>
                         <td>{{ $data->no_hp }}</td>
                       </tr>
                       @endforeach
                     </tbody>
                 </table>
              </div>
           </div>
        </div>
     </div>
    @endif


    {{-- Data SIswa Sehat, Untuk Halaman GUru --}}
    @if (Auth::user()->level->nama_level == "Guru")
     <div class="col-md-12 col-lg-12">
        <div class="card">
           <div class="card-header d-flex justify-content-between">
              <div class="header-title">
                 <h4 class="card-title">Data Siswa Yang Sehat</h4>
               </div>
           </div>
           <div class="card-body">
              <div class="table-responsive">
                 <table class="table" data-toggle="data-table">
                    <thead>
                        <tr>
                           <th>No</th>
                           <th>Nama Siswa</th>
                           <th>Unit </th>
                           <th>Kelas </th>
                           <th>Nomor Induk</th>
                           <th>Tgl Lahir</th>
                           <th>Jenis Kelamin</th>
                           <th>No Hp</th>
                        </tr>
                     </thead>
                     <tbody>
                       @foreach ($dataSiswaSehat as $data)
                       <tr>
                         <td>{{ $loop->iteration }}</td>
                         <td>{{ $data->nama }}</td>
                         <td>{{ (@$data->kelas->unit->nama_unit) ?? "-" }}</td>
                         <td>{{ (@$data->kelas->nama_kelas) ?? "-" }}</td>
                         <td>{{ $data->nomor_induk }}</td>
                         <td>{{ $data->tgl_lahir }}</td>
                         <td>{{ $data->jenis_kelamin }}</td>
                         <td>{{ $data->no_hp }}</td>
                       </tr>
                       @endforeach
                     </tbody>
                 </table>
              </div>
           </div>
        </div>
     </div>
     @endif


</div>
@endsection

@push('scripts')
{{-- Chart Js --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js" integrity="sha512-sW/w8s4RWTdFFSduOTGtk4isV1+190E/GghVffMA9XczdJ2MDzSzLEubKAs5h0wzgSJOQTRYyaz73L3d6RtJSg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://unpkg.com/chart.js-plugin-labels-dv/dist/chartjs-plugin-labels.min.js"></script>


{{-- Siswa Trend Chart --}}
<script>
if (document.querySelectorAll('#siswaTrendChart').length) {
  const options = {
      series: [
            {
                name: 'Sehat',
                data: @json($skriningSiswaSehat)
            },{
                name: 'Sakit',
                data: @json($skriningSiswaSakit)
            },{
                name: 'Karantina',
                data: @json($skriningSiswaKarantina)
            },{
                name: 'Positif',
                data: @json($skriningSiswaPositifPandemi)
            },
        ],
      chart: {
          fontFamily: '"Inter", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji"',
          height: 245,
          type: 'area',
          toolbar: {
              show: false
          },
          sparkline: {
              enabled: false,
          },
      },
      colors: ["#4ac18e","#6495ed","#f16a1b","#c03221"],
      dataLabels: {
          enabled: false
      },
      stroke: {
          curve: 'smooth',
          width: 3,
      },
      yaxis: {
        show: true,
        labels: {
          show: true,
          minWidth: 19,
          maxWidth: 19,
          style: {
            colors: "#8A92A6",
          },
          offsetX: -5,
        },
      },
      legend: {
          show: false,
      },
      xaxis: {
          labels: {
              minHeight:22,
              maxHeight:22,
              show: true,
              style: {
                colors: "#8A92A6",
              },
          },
          lines: {
              show: false  //or just here to disable only x axis grids
          },
          categories: @json($trend_label)
      },
      grid: {
          show: false,
      },
      fill: {
          type: 'gradient',
          gradient: {
              shade: 'dark',
              type: "vertical",
              shadeIntensity: 0,
              gradientToColors: undefined, // optional, if not defined - uses the shades of same color in series
              inverseColors: true,
              opacityFrom: .4,
              opacityTo: .1,
              stops: [0, 50, 80],
              colors: ["#4ac18e","#6495ed","#f16a1b","#c03221"],
          }
      },
      tooltip: {
        enabled: true,
      },
  };

  const chart = new ApexCharts(document.querySelector("#siswaTrendChart"), options);
  chart.render();
  document.addEventListener('ColorChange', (e) => {
    console.log(e)
    const newOpt = {
      colors: [e.detail.detail1, e.detail.detail2],
      fill: {
        type: 'gradient',
        gradient: {
            shade: 'dark',
            type: "vertical",
            shadeIntensity: 0,
            gradientToColors: [e.detail.detail1, e.detail.detail2], // optional, if not defined - uses the shades of same color in series
            inverseColors: true,
            opacityFrom: .4,
            opacityTo: .1,
            stops: [0, 50, 60],
            colors: [e.detail.detail1, e.detail.detail2],
        }
    },
   }
    chart.updateOptions(newOpt)
  })
}
</script>

{{-- STAFF Trend Chart --}}
<script>
    if (document.querySelectorAll('#staffTrendChart').length) {
      const options = {
          series: [
                {
                    name: 'Sehat',
                    data: @json($skriningStaffSehat)
                },{
                    name: 'Sakit',
                    data: @json($skriningStaffSakit)
                },{
                    name: 'Karantina',
                    data: @json($skriningStaffKarantina)
                },{
                    name: 'Positif',
                    data: @json($skriningStaffPositifPandemi)
                },
            ],
          chart: {
              fontFamily: '"Inter", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji"',
              height: 245,
              type: 'area',
              toolbar: {
                  show: false
              },
              sparkline: {
                  enabled: false,
              },
          },
          colors: ["#4ac18e","#6495ed","#f16a1b","#c03221"],
          dataLabels: {
              enabled: false
          },
          stroke: {
              curve: 'smooth',
              width: 3,
          },
          yaxis: {
            show: true,
            labels: {
              show: true,
              minWidth: 19,
              maxWidth: 19,
              style: {
                colors: "#8A92A6",
              },
              offsetX: -5,
            },
          },
          legend: {
              show: false,
          },
          xaxis: {
              labels: {
                  minHeight:22,
                  maxHeight:22,
                  show: true,
                  style: {
                    colors: "#8A92A6",
                  },
              },
              lines: {
                  show: false  //or just here to disable only x axis grids
              },
              categories: @json($trend_label)
          },
          grid: {
              show: false,
          },
          fill: {
              type: 'gradient',
              gradient: {
                  shade: 'dark',
                  type: "vertical",
                  shadeIntensity: 0,
                  gradientToColors: undefined, // optional, if not defined - uses the shades of same color in series
                  inverseColors: true,
                  opacityFrom: .4,
                  opacityTo: .1,
                  stops: [0, 50, 80],
                  colors: ["#4ac18e","#6495ed","#f16a1b","#c03221"],
              }
          },
          tooltip: {
            enabled: true,
          },
      };
    
      const chart = new ApexCharts(document.querySelector("#staffTrendChart"), options);
      chart.render();
      document.addEventListener('ColorChange', (e) => {
        console.log(e)
        const newOpt = {
          colors: [e.detail.detail1, e.detail.detail2],
          fill: {
            type: 'gradient',
            gradient: {
                shade: 'dark',
                type: "vertical",
                shadeIntensity: 0,
                gradientToColors: [e.detail.detail1, e.detail.detail2], // optional, if not defined - uses the shades of same color in series
                inverseColors: true,
                opacityFrom: .4,
                opacityTo: .1,
                stops: [0, 50, 60],
                colors: [e.detail.detail1, e.detail.detail2],
            }
        },
       }
        chart.updateOptions(newOpt)
      })
    }
    </script>

{{-- SISWA PIE CHART --}}
<script>
    const opt = {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                labels: {
                    color: "#000",
                }
            },
            labels: {
                render: 'percentage',
                precision: 2,
                fontSize: 15,
                fontColor: '#000',
                textShadow: true,
                position: 'outside',
            },
        },
    };
</script>
<script>
    const ctxSiswaPieChart = document.getElementById('siswaPieChart').getContext('2d');
    const siswaPieChart = new Chart(ctxSiswaPieChart, {
        type: 'pie',
        data: {
            labels: ['Sehat', 'Sakit', 'Karantina', 'Positif'],
            datasets: [{
                data: @json($arrSiswa),
                backgroundColor: [
                "#4ac18e",
                "#6495ed",
                "#f16a1b",
                "#c03221",
                ],
                borderWidth: 1
            }]
        },
        options: opt,
    });
</script>

{{-- STAFF PIE CHART --}}
<script>
    const ctxStaffPieChart = document.getElementById('staffPieChart').getContext('2d');
    const staffPieChart = new Chart(ctxStaffPieChart, {
        type: 'pie',
        data: {
            labels: ['Sehat', 'Sakit', 'Karantina', 'Positif'],
            datasets: [{
                data: @json($arrStaff),
                backgroundColor: [
                "#4ac18e",
                "#6495ed",
                "#f16a1b",
                "#c03221",
                ],
                borderWidth: 1
            }]
        },
        options: opt,
    });
</script>


@endpush