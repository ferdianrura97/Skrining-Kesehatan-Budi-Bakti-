<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Skrining;
use App\Models\DetailSkrining;
use App\Models\Penyakit;
use App\Models\Staff;
use App\Models\Siswa;
use Illuminate\Support\Facades\DB;
use App\Helpers\Helper;

use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Auth;

class SkriningController extends Controller
{

    protected $routeName = 'skrining';
    protected $viewName = 'skrining';
    protected $menu = 'Master Data';
    protected $title = 'Skrining';

    protected $aksesMenu = 'Skrining';
    
    public function index()
    {
        if(!Helper::cek_akses($this->aksesMenu)){
            return abort(404);
        }

        $settings = [
            'menu' => $this->menu,
            'title' => $this->title,
            'route' => $this->routeName,
            'ubah'=>Helper::cek_akses($this->aksesMenu,'Ubah'),
            'hapus'=>Helper::cek_akses($this->aksesMenu,'Hapus')
        ];

        $siswas = Skrining::whereNotNull('siswa_id')->orderBy('tgl_pengisian', 'DESC')->get();
        $staffs = Skrining::whereNotNull('staff_id')->orderBy('tgl_pengisian', 'DESC')->get();
        
        return view($this->viewName.'.index', compact('settings', 'siswas', 'staffs'));
    }
    
    public function create()
    {
        if(!empty($_GET['status'])){
            $statusSkrining = $_GET['status'];
        }else{
            return redirect()->route($this->routeName.'.index')->with(['error' => 'Status Skrining tidak ditemukan']);
        }

        $anggotaSekolah = null;
        $siswa_id = null;
        $staff_id = null;
        
        // Skrining diinputkan oleh Petugas
        if($statusSkrining == 'siswa'){
            $anggotaSekolah = Siswa::all();
        }else if($statusSkrining == 'staff'){
            $anggotaSekolah = Staff::all();

        // Jika Input Skrining Untuk Diri Sendiri
        }else if($statusSkrining == 'self'){

            // Jika Waktu Input Wajib Telat, redirect gagal
            if(!Helper::checkWaktuBolehInputSkrining()){
                return redirect(route('dashboard'))->with(['error' => 'Anda Belum Bisa Mengisi Data Skrining, Silahkan Hubungi Kontak Admin']);
            }

            if(Auth::user()->level->nama_level == 'Siswa'){
                $siswa_id = Auth::user()->id;
            }else{
                $staff_id = Auth::user()->id;
            }
        }

        $settings = [
            'menu' => $this->menu,
            'title' => $this->title,
            'route' => $this->routeName,
            'action'=> route($this->routeName.'.store'),
        ];

        $penyakits = Penyakit::all();
        
        return view($this->viewName.'.form', compact('settings', 'penyakits', 'siswa_id', 'staff_id', 'statusSkrining', 'anggotaSekolah'));
    }
    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status_skrining' => 'required',
            'tgl_pengisian' => 'required',
            'swab_file' => 'file|mimes:doc,docx,xls,xlsx,pdf,png,jpg,jpeg',
        ],[
            'swab_file.mimes' => 'File Upload Harus Berformat .doc, .docx, .xls, .xlsx, .pdf, .png, .jpg, .jpeg',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first())->withInput();
        }
            
        DB::beginTransaction();

        try {
            $swab_file_name = null;
            if($request->file('swab_file')){
                $swab_file = $request->file('swab_file');
                $swab_file_name = 'swab_upload/' . rand() . '.' . $swab_file->getClientOriginalExtension();

                $request->swab_file->storeAs(
                    'public', $swab_file_name
                );

                // $swab_file->move(public_path('swab_files'), $swab_file_name);
            }
            
            $skrining = Skrining::create([
                'siswa_id' => $request->siswa_id ?? null,
                'staff_id' => $request->staff_id ?? null,
                'tgl_pengisian' => $request->tgl_pengisian,
                'status_kesehatan_keluarga' => $request->status_kesehatan_keluarga ? 'pandemi' : 'sehat',
                'swab_file' => $swab_file_name,
            ]);
            $getAllPenyakit = Penyakit::all();
            $getLimitPointSakit = Helper::getLimitPointSakit();

            $hitungPointSakit = 0;
            foreach ($getAllPenyakit as $penyakit) {
                if($request->get('penyakit_'.$penyakit->id)){
                    DetailSkrining::create([
                        'skrining_id' => $skrining->id,
                        'penyakit_id' => $penyakit->id,
                    ]);
                    $hitungPointSakit += $penyakit->point;
                }
            }

            $status = 'sehat';
            $masuk_sekolah = '1';

            if($hitungPointSakit >= $getLimitPointSakit){
                $status = 'sakit';
                $masuk_sekolah = '0';
            }

            if($request->status_kesehatan_keluarga){
                $status = 'karantina';
                $masuk_sekolah = '0';
            }

            if($request->swab_file){
                $status = 'positif';
                $masuk_sekolah = '0';
            }
            
            $skrining->update([
                'status' => $status,
                'masuk_sekolah' => $masuk_sekolah,
            ]);
            
            DB::commit();
            
            // Skrining diinputkan oleh Petugas
            if($request->status_skrining == 'siswa' || $request->status_skrining == 'staff'){
                return redirect(route($this->routeName . '.index'))->with(['success' => 'Berhasil Menambah Data ' . $this->aksesMenu]);
            // Jika Input Skrining Untuk Diri Sendiri
            }else if($request->status_skrining == 'self'){
                return redirect(route('dashboard'))->with(['success' => "Berhasil Proses Data ".$this->aksesMenu." Anda"]);
            }
            
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'Gagal Menambah Data ' . $this->aksesMenu . ' : ' . $e->getMessage()])->withInput($request->all());
        }
    }

    public function show($id)
    {
        //
    }
    
    public function edit(skrining $skrining)
    {
        $settings = [
            'menu' => $this->menu,
            'title' => $this->title,
            'route' => $this->routeName,
            'action'=>route($this->routeName.'.update',$skrining->id),
        ];

        if(!empty($_GET['status'])){
            $statusSkrining = $_GET['status'];
        }else{
            return redirect()->route($this->routeName.'.index')->with(['error' => 'Status Skrining tidak ditemukan']);
        }

        $anggotaSekolah = null;
        $siswa_id = null;
        $staff_id = null;
        
        // Skrining diinputkan oleh Petugas
        if($statusSkrining == 'siswa'){
            $anggotaSekolah = Siswa::all();
        }else if($statusSkrining == 'staff'){
            $anggotaSekolah = Staff::all();

        // Jika Input Skrining Untuk Diri Sendiri
        }else if($statusSkrining == 'self'){

            // Jika Mau Edit Yg bukan Skrining dia, redirect gagal
            if(Auth::user()->last_skrining->id != $skrining->id){
                return redirect(route('dashboard'))->with(['error' => 'Anda Tidak Memiliki Akses ke Skrining Ini']);
            }

            // Jika Waktu Edit Belum Memenuhi, redirect gagal
            if(!Auth::user()->check_update){
                return redirect(route('dashboard'))->with(['error' => 'Anda Belum Bisa Update Data Skrining']);
            }

            if(Auth::user()->level->nama_level == 'Siswa'){
                $siswa_id = Auth::user()->id;
            }else{
                $staff_id = Auth::user()->id;
            }
        }

        $penyakits = Penyakit::all();

        $siswa_id = $skrining->siswa_id;
        $staff_id = $skrining->staff_id;

        return view($this->viewName.'.form',compact('settings', 'penyakits', 'siswa_id', 'staff_id', 'statusSkrining', 'anggotaSekolah'),['data'=>$skrining]);
    }

    public function update(Request $request, skrining $skrining)
    {
        $validator = Validator::make($request->all(), [
            'status_skrining' => 'required',
            'tgl_pengisian' => 'required',
            'swab_file' => 'file|mimes:doc,docx,xls,xlsx,pdf,png,jpg,jpeg',
        ],[
            'swab_file.mimes' => 'File Upload Harus Berformat .doc, .docx, .xls, .xlsx, .pdf, .png, .jpg, .jpeg',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first())->withInput();
        }
        
        DB::beginTransaction();
        try {
            
            $swab_file_name = $skrining->swab_file ?? null;
            if($request->file('swab_file')){
                $swab_file = $request->file('swab_file');
                $swab_file_name = 'swab_upload/' . rand() . '.' . $swab_file->getClientOriginalExtension();
                
                $request->swab_file->storeAs(
                    'public', $swab_file_name
                );
            }
            
            $skrining->update([
                'siswa_id' => $request->siswa_id ?? null,
                'staff_id' => $request->staff_id ?? null,
                'tgl_pengisian' => $request->tgl_pengisian,
                'status_kesehatan_keluarga' => $request->status_kesehatan_keluarga ? 'pandemi' : 'sehat',
                'swab_file' => $swab_file_name,
            ]);
            $getAllPenyakit = Penyakit::all();
            $getLimitPointSakit = Helper::getLimitPointSakit();

            $hitungPointSakit = 0;
            $skrining->detail()->delete();
            foreach ($getAllPenyakit as $penyakit) {
                if($request->get('penyakit_'.$penyakit->id)){
                    DetailSkrining::create([
                        'skrining_id' => $skrining->id,
                        'penyakit_id' => $penyakit->id,
                    ]);
                    $hitungPointSakit += $penyakit->point;
                }
            }

            $status = 'sehat';
            $masuk_sekolah = '1';

            if($hitungPointSakit >= $getLimitPointSakit){
                $status = 'sakit';
                $masuk_sekolah = '0';
            }

            if($request->status_kesehatan_keluarga){
                $status = 'karantina';
                $masuk_sekolah = '0';
            }

            if($request->swab_file){
                $status = 'positif';
                $masuk_sekolah = '0';
            }
            
            $skrining->update([
                'status' => $status,
                'masuk_sekolah' => $masuk_sekolah,
            ]);

            DB::commit();

            // Skrining diinputkan oleh Petugas
            if($request->status_skrining == 'siswa' || $request->status_skrining == 'staff'){
                return redirect(route($this->routeName . '.index'))->with(['success' => 'Berhasil Menambah Data ' . $this->aksesMenu]);
            // Jika Input Skrining Untuk Diri Sendiri
            }else if($request->status_skrining == 'self'){
                return redirect(route('dashboard'))->with(['success' => "Berhasil Proses Data ".$this->aksesMenu." Anda"]);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'Gagal Mengubah Data ' . $this->aksesMenu . ' : ' . $e->getMessage()])->withInput($request->all());
        }
    }
    
    public function destroy(skrining $skrining)
    {
        if(!Helper::cek_akses($this->aksesMenu,'Hapus')){
            return abort(404);
        }

        DB::beginTransaction();
        try {

            $skrining->delete();
        
            DB::commit();
            return redirect(route($this->routeName.'.index'))->with(['success'=>'Berhasil Menghapus Data skrining : '.$skrining->nama_skrining]);
        } catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->with(['error'=>'Gagal Menghapus Data skrining '.$skrining->nama_skrining.' : '.$e->getMessage()]);
        }
    }
}
