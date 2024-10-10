<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\DB;
use App\Helpers\Helper;

class PelangganController extends Controller
{

    protected $routeName = 'pelanggan';
    protected $viewName = 'pelanggan';
    protected $menu = 'Master Data';
    protected $title = 'Pelanggan';

    protected $aksesMenu = 'Pelanggan';
    
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

        $datas = Pelanggan::all();
        
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
        
        return view($this->viewName.'.form', compact('settings'));
    }
    
    public function store(Request $request)
    {
        if(!Helper::cek_akses($this->aksesMenu,'Tambah')){
            return abort(404);
        }

        $request->validate([
            'nama_pelanggan'=>'required',
            'no_telp'=>'required',
        ]);

        DB::beginTransaction();

        try {
            $pelanggan = Pelanggan::create([
               'nama_pelanggan'=>$request->nama_pelanggan,
               'no_telp'=>$request->no_telp,
               'alamat'=>$request->alamat,
            ]);

            DB::commit();

            Helper::addUserLog('Menambah data ' .$this->aksesMenu . ' : ' . $pelanggan->nama_pelanggan,$pelanggan->toArray());
            
            return redirect(route($this->routeName.'.index'))->with(['success'=>'Berhasil Menambah Data ' .$this->aksesMenu. ' : '.$pelanggan->nama_pelanggan]);
        } catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->with(['error'=>'Gagal Menambah Data ' .$this->aksesMenu. ' : '.$e->getMessage()])->withInput($request->all());
        }
    }

    public function show($id)
    {
        //
    }
    
    public function edit(Pelanggan $pelanggan)
    {
        if(!Helper::cek_akses($this->aksesMenu,'Ubah')){
            return abort(404);
        }

        $settings = [
            'menu' => $this->menu,
            'title' => $this->title,
            'route' => $this->routeName,
            'action'=>route($this->routeName.'.update',$pelanggan->id),
        ];

        return view($this->viewName.'.form',compact('settings'),['data'=>$pelanggan]);
    }

    public function update(Request $request, Pelanggan $pelanggan)
    {
        if(!Helper::cek_akses($this->aksesMenu,'Ubah')){
            return abort(404);
        }
        
        $request->validate([
            'nama_pelanggan'=>'required',
            'no_telp'=>'required',
        ]);
        
        DB::beginTransaction();
        try {
            $old = $pelanggan->toArray();
            $pelanggan->update([
               'nama_pelanggan'=>$request->nama_pelanggan,
               'no_telp'=>$request->no_telp,
               'alamat'=>$request->alamat
            ]);
            DB::commit();

            Helper::addUserLog('Menambah data ' .$this->aksesMenu . ' : ' . $pelanggan->nama_pelanggan,[
                'old' => $old,
                'update' => $pelanggan->toArray()
            ]);

            return redirect(route($this->routeName.'.index'))->with(['success'=>'Berhasil Mengubah Data ' .$this->aksesMenu. ' : '.$pelanggan->nama_pelanggan]);
        } catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->with(['error'=>'Gagal Mengubah Data ' .$this->aksesMenu. ' : '.$e->getMessage()])->withInput($request->all());
        }
    }
    
    public function destroy(Pelanggan $pelanggan)
    {
        if(!Helper::cek_akses($this->aksesMenu,'Hapus')){
            return abort(404);
        }

        DB::beginTransaction();
        try {
            Helper::addUserLog('Menghapus data ' .$this->aksesMenu . ' : ' . $pelanggan->nama_pelanggan,$pelanggan->toArray());

            $pelanggan->delete();
        
            DB::commit();
            return redirect(route($this->routeName.'.index'))->with(['success'=>'Berhasil Menghapus Data Pelanggan : '.$pelanggan->nama_pelanggan]);
        } catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->with(['error'=>'Gagal Menghapus Data pelanggan '.$pelanggan->nama_pelanggan.' : '.$e->getMessage()]);
        }
    }
}
