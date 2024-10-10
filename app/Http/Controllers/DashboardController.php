<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Staff;
use App\Models\Skrining;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    protected $routeName = 'dashboard';
    protected $viewName = 'dashboard';
    protected $menu = 'Home';
    protected $title = 'Dashboard, ';
    
    public function index(Request $request)
    {
        $settings = [
            'menu' => $this->menu,
            'title' => $this->title . 'Selamat datang ' . Auth::user()->nama,
            'route' => $this->routeName,
        ];

        $satgas = Staff::whereNotIn('level_id', ['2','3'])->get();
        $ttlSiswa = Siswa::count();
        $ttlStaff = Staff::count();

        // Hitung Staff Sakit & Sehat
        $staffs = Staff::all();
        $ttlStaffSehat = 0;
        $ttlStaffSakit = 0;
        $ttlStaffKarantina = 0;
        $ttlStaffPositifPandemi = 0;

        foreach ($staffs as $staff) {
            // Cek, Minggu Ini Sudah Input atau belum..
            if($staff->check_skrining){
                // Cek, Apakah Status Skrining Terakhir Sehat atau sakit
                if($staff->last_skrining->status == 'sehat'){
                    $ttlStaffSehat++;
                // Jika Sakit/Karantina/Pandemi
                } else {
                    if($staff->last_skrining->status == 'sakit'){
                        $ttlStaffSakit++;
                    }elseif($staff->last_skrining->status == 'karantina'){
                        $ttlStaffKarantina++;
                    }elseif($staff->last_skrining->status == 'positif'){
                        $ttlStaffPositifPandemi++;
                    }
                }
            // Jika Belum Input, dihitung Sakit
            }else{
                // $ttlStaffSakit++;
            }
        }

        // Hitung Siswa Sakit & Sehat
        $siswas = Siswa::all();
        $ttlSiswaSehat = 0;
        $ttlSiswaSakit = 0;
        $ttlSiswaKarantina = 0;
        $ttlSiswaPositifPandemi = 0;

        // Ambil Data Siswa Yang Belum Input, dan tidak bisa tatap muka
        // Untuk Login SATGAS, hanya mengambil data sesuai unitnya saja
        // Untuk Login Guru, hanya mengambil data sesuai kelasnya saja
        $dataSiswaBelumInput = [];
        $dataSiswaSehat = [];
        $dataSiswaSakit = [];

        foreach ($siswas as $siswa) {
            // Cek, Minggu Ini Sudah Input atau belum..
            if($siswa->check_skrining){
                // Cek, Apakah Status Skrining Terakhir Sehat atau sakit
                if($siswa->last_skrining->status == 'sehat'){

                    // Untuk Login Guru, hanya mengambil data sesuai kelasnya saja
                    if(Auth::user()->level->nama_level == 'Guru'){
                        if($siswa->kelas_id == Auth::user()->kelas_id){
                            $dataSiswaSehat[] = $siswa;
                        }
                    }

                    $ttlSiswaSehat++;

                // Jika Sakit/Karantina/Covid 
                } else {

                    // Untuk Login Guru, hanya mengambil data sesuai kelasnya saja
                    // Untuk Login SATGAS, hanya mengambil data sesusai unitnya saja
                    if(Auth::user()->level->nama_level == 'Satgas'){
                        if($siswa->kelas->unit_id == Auth::user()->unit_id){
                            $dataSiswaSakit[] = $siswa;
                        }
                    }else if(Auth::user()->level->nama_level == 'Guru'){
                        if($siswa->kelas_id == Auth::user()->kelas_id){
                            $dataSiswaSakit[] = $siswa;
                        }
                    }

                    if($siswa->last_skrining->status == 'sakit'){
                        $ttlSiswaSakit++;
                    }elseif($siswa->last_skrining->status == 'karantina'){
                        $ttlSiswaKarantina++;
                    }elseif($siswa->last_skrining->status == 'positif'){
                        $ttlSiswaPositifPandemi++;
                    }
                }
                // Jika Belum Input, dihitung Sakit
            }else{
                
                // Untuk Login Guru, hanya mengambil data sesuai kelasnya saja
                // Untuk Login SATGAS, hanya mengambil data sesusai unitnya saja
                if(Auth::user()->level->nama_level == 'Satgas'){
                    if($siswa->kelas->unit_id == Auth::user()->unit_id){
                        $dataSiswaBelumInput[] = $siswa;
                    }
                }else if(Auth::user()->level->nama_level == 'Guru'){
                    if($siswa->kelas_id == Auth::user()->kelas_id){
                        $dataSiswaBelumInput[] = $siswa;
                    }
                }
                // $ttlSiswaSakit++;
            }
        }

        $bulan = $request->get('bulan', date('m'));
        $tahun = $request->get('tahun', date('Y'));

        $bulans = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];

        // Untuk Chart Pie Persentase
        $arrSiswa = [$ttlSiswaSehat, $ttlSiswaSakit, $ttlSiswaKarantina, $ttlSiswaPositifPandemi];
        $arrStaff = [$ttlStaffSehat, $ttlStaffSakit, $ttlStaffKarantina, $ttlStaffPositifPandemi];

        $trend_label = Helper::getCurrentDateFromMonth($bulan, $tahun); // Berupa Array Tanggal Bulan Ini, digunakan sebagai label chart
        
        foreach ($trend_label as $tanggal) {
            // Skrining Siswa
            $skriningSiswaSehat[] = Skrining::whereNotNull('siswa_id')->where('status', 'sehat')->whereMonth('tgl_pengisian', $bulan)->whereYear('tgl_pengisian', $tahun)->whereDay('tgl_pengisian', $tanggal)->count();
            $skriningSiswaSakit[] = Skrining::whereNotNull('siswa_id')->where('status', 'sakit')->whereMonth('tgl_pengisian', $bulan)->whereYear('tgl_pengisian', $tahun)->whereDay('tgl_pengisian', $tanggal)->count();
            $skriningSiswaKarantina[] = Skrining::whereNotNull('siswa_id')->where('status', 'karantina')->whereMonth('tgl_pengisian', $bulan)->whereYear('tgl_pengisian', $tahun)->whereDay('tgl_pengisian', $tanggal)->count();
            $skriningSiswaPositifPandemi[] = Skrining::whereNotNull('siswa_id')->where('status', 'positif')->whereMonth('tgl_pengisian', $bulan)->whereYear('tgl_pengisian', $tahun)->whereDay('tgl_pengisian', $tanggal)->count();

            // Skrining Staff
            $skriningStaffSehat[] = Skrining::whereNotNull('staff_id')->where('status', 'sehat')->whereMonth('tgl_pengisian', $bulan)->whereYear('tgl_pengisian', $tahun)->whereDay('tgl_pengisian', $tanggal)->count();
            $skriningStaffSakit[] = Skrining::whereNotNull('staff_id')->where('status', 'sakit')->whereMonth('tgl_pengisian', $bulan)->whereYear('tgl_pengisian', $tahun)->whereDay('tgl_pengisian', $tanggal)->count();
            $skriningStaffKarantina[] = Skrining::whereNotNull('staff_id')->where('status', 'karantina')->whereMonth('tgl_pengisian', $bulan)->whereYear('tgl_pengisian', $tahun)->whereDay('tgl_pengisian', $tanggal)->count();
            $skriningStaffPositifPandemi[] = Skrining::whereNotNull('staff_id')->where('status', 'positif')->whereMonth('tgl_pengisian', $bulan)->whereYear('tgl_pengisian', $tahun)->whereDay('tgl_pengisian', $tanggal)->count();
        }
        
        return view($this->viewName, compact('settings', 'request', 'satgas', 'ttlSiswa', 'ttlStaff', 'ttlSiswaSehat', 'ttlSiswaSakit', 'ttlSiswaKarantina', 'ttlSiswaPositifPandemi', 'ttlStaffSehat', 'ttlStaffSakit', 'ttlStaffKarantina', 'ttlStaffPositifPandemi', 'dataSiswaSakit', 'dataSiswaBelumInput', 'dataSiswaSehat', 'arrSiswa', 'arrStaff', 'bulans', 'trend_label', 'skriningSiswaSehat', 'skriningSiswaSakit', 'skriningSiswaKarantina', 'skriningSiswaPositifPandemi', 'skriningStaffSehat', 'skriningStaffSakit', 'skriningStaffKarantina', 'skriningStaffPositifPandemi'));
    }
}
