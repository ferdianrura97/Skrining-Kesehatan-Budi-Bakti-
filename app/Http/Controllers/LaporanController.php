<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Staff;
use App\Models\Level;
use App\Models\Skrining;

use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    protected $routeName = 'laporan';
    protected $viewName = 'laporan';
    protected $menu = 'Laporan';
    protected $aksesMenu = 'Laporan';
    
    public function siswa(Request $request)
    {
        if (!Helper::cek_akses($this->aksesMenu, 'Lihat')) {
            return abort(404);
        }

        $settings = [
            'menu' => $this->menu,
            'title' => "Rekap Data Siswa",
            'route' => $this->routeName.'.siswa',
        ];

        $kelases = Kelas::all();

        $getKelas = $request->get('kelas_id', null);

        if($getKelas){
            $datas = Siswa::where('kelas_id', $getKelas)->get();
        }else{
            $datas = Siswa::all();
        }

        
        return view($this->viewName.'.siswa', compact('settings', 'datas', 'kelases', 'request'));
    }

    public function staff(Request $request)
    {
        if (!Helper::cek_akses($this->aksesMenu, 'Lihat')) {
            return abort(404);
        }

        $settings = [
            'menu' => $this->menu,
            'title' => "Rekap Data Staff",
            'route' => $this->routeName.'.staff',
        ];

        $levels = Level::all();

        $getLevel = $request->get('level_id', null);

        if($getLevel){
            $datas = Staff::where('level_id', $getLevel)->get();
        }else{
            $datas = Staff::all();
        }

        
        return view($this->viewName.'.staff', compact('settings', 'datas', 'levels', 'request'));
    }

    public function skriningSiswa(Request $request)
    {
        if (!Helper::cek_akses($this->aksesMenu, 'Lihat')) {
            return abort(404);
        }

        $settings = [
            'menu' => $this->menu,
            'title' => "Rekap Data Skrining",
            'route' => $this->routeName.'.skrining',
        ];

        $getPeriode = $request->get('periode', null);
        $getStatus = $request->get('status', null);

        if($getPeriode || $getStatus){
            if($getPeriode){
                $exp = explode(' to ', $getPeriode);
                if(!isset($exp[1])){
                    return redirect()->back()->with(['error' => 'Periode harus diisi dengan benar, Contoh: 01-01-2022 to 31-01-2022']);
                }

                $begin = $exp[0];
                $end = $exp[1];

                $datas = Skrining::whereNotNull('siswa_id')->whereBetween('tgl_pengisian', [$begin,$end])->orderBy('tgl_pengisian', 'DESC');
            }

            if($getStatus){
                $datas = $datas->where('status', $getStatus);
            }

            $datas = $datas->get();
        }else{
            $datas = Skrining::whereNotNull('siswa_id')->orderBy('tgl_pengisian', 'DESC')->get();
        }

        
        return view($this->viewName.'.skrining-siswa', compact('settings', 'datas', 'request'));
    }
    
    public function skriningStaff(Request $request)
    {
        if (!Helper::cek_akses($this->aksesMenu, 'Lihat')) {
            return abort(404);
        }

        $settings = [
            'menu' => $this->menu,
            'title' => "Rekap Data Skrining",
            'route' => $this->routeName.'.skrining',
        ];

        $getPeriode = $request->get('periode', null);
        $getStatus = $request->get('status', null);

        if($getPeriode || $getStatus){
            if($getPeriode){
                $exp = explode(' to ', $getPeriode);
                if(!isset($exp[1])){
                    return redirect()->back()->with(['error' => 'Periode harus diisi dengan benar, Contoh: 01-01-2022 to 31-01-2022']);
                }

                $begin = $exp[0];
                $end = $exp[1];

                $datas = Skrining::whereNotNull('staff_id')->whereBetween('tgl_pengisian', [$begin,$end])->orderBy('tgl_pengisian', 'DESC');
            }

            if($getStatus){
                $datas = $datas->where('status', $getStatus);
            }

            $datas = $datas->get();
        }else{
            $datas = Skrining::whereNotNull('staff_id')->orderBy('tgl_pengisian', 'DESC')->get();
        }

        
        return view($this->viewName.'.skrining-staff', compact('settings', 'datas', 'request'));
    }
}
