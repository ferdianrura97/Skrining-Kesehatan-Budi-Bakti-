<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\Level;
use App\Models\Unit;
use App\Models\Kelas;
use Illuminate\Support\Facades\DB;
use App\Helpers\Helper;

use Illuminate\Support\Facades\Validator;

class StaffController extends Controller
{

    protected $routeName = 'staff';
    protected $viewName = 'staff';
    protected $menu = 'Master Data';
    protected $title = 'Staff';

    protected $aksesMenu = 'staff';
    
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

        $datas = Staff::all();
        
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

        $levels = Level::all();
        $units = Unit::all();
        $kelases = Kelas::all();
        
        return view($this->viewName.'.form', compact('settings', 'levels', 'units', 'kelases'));
    }
    
    public function store(Request $request)
    {
        if (!Helper::cek_akses($this->aksesMenu, 'Tambah')) {
            return abort(404);
        }

        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'no_hp' => 'required',
            'username' => 'required|unique:staff',
            'password' => 'required',
            'password_confirm' => 'required|same:password',
            'level_id' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first())->withInput();
        }
        
        DB::beginTransaction();
        try {

            $staff = Staff::create([
                'nama' => $request->nama,
                'no_hp' => Helper::clean($request->no_hp),
                'username' => $request->username,
                'level_id' => $request->level_id,
                'unit_id' => $request->unit_id ?? null,
                'kelas_id' => $request->kelas_id ?? null,
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
    
    public function edit(Staff $staff)
    {
        if(!Helper::cek_akses($this->aksesMenu,'Ubah')){
            return abort(404);
        }

        $settings = [
            'menu' => $this->menu,
            'title' => $this->title,
            'route' => $this->routeName,
            'action'=>route($this->routeName.'.update',$staff->id),
        ];

        $levels = Level::all();
        $units = Unit::all();
        $kelases = Kelas::all();

        return view($this->viewName.'.form',compact('settings', 'levels', 'units', 'kelases'),['data'=>$staff]);
    }

    public function update(Request $request, Staff $staff)
    {
        if (!Helper::cek_akses($this->aksesMenu, 'Ubah')) {
            return abort(404);
        }

        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'username' => 'required|unique:staff,username,' . $staff->id,
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

            if ($validator->fails()) {
                return redirect()->back()->with('error', $validator->errors()->first())->withInput();
            }

            $password = bcrypt($request->password);

            $staff->update([
                'password' => $password,
            ]);
        }
        try {

            $old = $staff->toArray();

            $staff->update([
                'nama' => $request->nama,
                'no_hp' => Helper::clean($request->no_hp),
                'username' => $request->username,
                'level_id' => $request->level_id,
                'unit_id' => $request->unit_id ?? null,
                'kelas_id' => $request->kelas_id ?? null,
            ]);

            DB::commit();

            return redirect(route($this->routeName . '.index'))->with(['success' => 'Berhasil Mengubah Data ' . $this->aksesMenu]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'Gagal Mengubah Data ' . $this->aksesMenu . ' : ' . $e->getMessage()])->withInput($request->all());
        }
    }
    
    public function destroy(Staff $staff)
    {
        if(!Helper::cek_akses($this->aksesMenu,'Hapus')){
            return abort(404);
        }

        DB::beginTransaction();
        try {
            $staff->delete();
        
            DB::commit();
            return redirect(route($this->routeName.'.index'))->with(['success'=>'Berhasil Menghapus Data staff : '.$staff->nama]);
        } catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->with(['error'=>'Gagal Menghapus Data staff '.$staff->nama.' : '.$e->getMessage()]);
        }
    }
}
