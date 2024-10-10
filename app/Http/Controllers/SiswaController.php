<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Level;
use App\Models\Kelas;
use Illuminate\Support\Facades\DB;
use App\Helpers\Helper;

use Illuminate\Support\Facades\Validator;

class SiswaController extends Controller
{

    protected $routeName = 'siswa';
    protected $viewName = 'siswa';
    protected $menu = 'Master Data';
    protected $title = 'Siswa';

    protected $aksesMenu = 'siswa';
    
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

        $datas = Siswa::all();
        
        return view($this->viewName.'.index', compact('settings', 'datas'));
    }
    
    public function create()
    {
        if(!Helper::cek_akses($this->aksesMenu, 'Tambah')){
            return abort(404);
        }

        $settings = [
            'menu' => $this->menu,
            'title' => $this->title,
            'route' => $this->routeName,
            'action'=> route($this->routeName.'.store'),
        ];

        $levels = Level::where('nama_level', 'Siswa')->get();
        $kelases = Kelas::all();
        
        return view($this->viewName.'.form', compact('settings', 'levels', 'kelases'));
    }
    
    public function store(Request $request)
    {
        if (!Helper::cek_akses($this->aksesMenu, 'Tambah')) {
            return abort(404);
        }

        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'kelas_id' => 'required',
            'no_hp' => 'required',
            'tgl_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'no_hp' => 'required',
            'nomor_induk' => 'required|unique:siswas',
            'password' => 'required',
            'password_confirm' => 'required|same:password',
            'level_id' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first())->withInput();
        }

        DB::beginTransaction();
        try {

            $siswa = Siswa::create([
                'nama' => $request->nama,
                'no_hp' => '628'.$request->no_hp,
                'kelas_id' => $request->kelas_id,
                'tgl_lahir' => $request->tgl_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'nomor_induk' => $request->nomor_induk,
                'level_id' => $request->level_id,
                'password' => bcrypt($request->password),
            ]);

            DB::commit();
            
            return redirect(route($this->routeName . '.index'))->with(['success' => 'Berhasil Menambah Data ' . $this->aksesMenu]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'Gagal Menambah Data ' . $this->aksesMenu . ' : ' . $e->getMessage()])->withInput($request->all());
        }
    }

    public function show($id)
    {
        //
    }
    
    public function edit(siswa $siswa)
    {
        if(!Helper::cek_akses($this->aksesMenu,'Ubah')){
            return abort(404);
        }

        $settings = [
            'menu' => $this->menu,
            'title' => $this->title,
            'route' => $this->routeName,
            'action'=>route($this->routeName.'.update',$siswa->id),
        ];

        $levels = Level::where('nama_level', 'Siswa')->get();
        $kelases = Kelas::all();

        return view($this->viewName.'.form',compact('settings', 'levels', 'kelases'),['data'=>$siswa]);
    }

    public function update(Request $request, siswa $siswa)
    {
        if (!Helper::cek_akses($this->aksesMenu, 'Ubah')) {
            return abort(404);
        }

        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'nomor_induk' => 'required|unique:siswas,nomor_induk,' . $siswa->id,
            'level_id' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first())->withInput();
        }

        DB::beginTransaction();
        $password = null;
        if ($request->password || $request->password_confirm) {
            $validator = Validator::make($request->all(), [
                'password' => 'required',
                'password_confirm' => 'required|same:password',
            ]);

            $password = bcrypt($request->password);
            $siswa->update([
                'password' => $password,
            ]);

            if ($validator->fails()) {
                return redirect()->back()->with('error', $validator->errors()->first())->withInput();
            }
        }
        try {

            $old = $siswa->toArray();

            $siswa->update([
                'nama' => $request->nama,
                'no_hp' => '628'.$request->no_hp,
                'kelas_id' => $request->kelas_id,
                'tgl_lahir' => $request->tgl_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'nomor_induk' => $request->nomor_induk,
                'level_id' => $request->level_id,
            ]);

            DB::commit();

            return redirect(route($this->routeName . '.index'))->with(['success' => 'Berhasil Mengubah Data ' . $this->aksesMenu]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'Gagal Mengubah Data ' . $this->aksesMenu . ' : ' . $e->getMessage()])->withInput($request->all());
        }
    }
    
    public function destroy(siswa $siswa)
    {
        if(!Helper::cek_akses($this->aksesMenu,'Hapus')){
            return abort(404);
        }

        DB::beginTransaction();
        try {

            $siswa->delete();
        
            DB::commit();
            return redirect(route($this->routeName.'.index'))->with(['success'=>'Berhasil Menghapus Data siswa : '.$siswa->nama]);
        } catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->with(['error'=>'Gagal Menghapus Data siswa '.$siswa->nama.' : '.$e->getMessage()]);
        }
    }
}
