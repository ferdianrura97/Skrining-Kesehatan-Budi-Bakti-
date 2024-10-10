<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\Menu;
use Illuminate\Http\Request;
use App\Helpers\Helper;

class LevelController extends Controller
{

    protected $routeName = 'level';
    protected $viewName = 'level';
    protected $menu = 'Managemen User';
    protected $title = 'Level';

    protected $aksesMenu = 'Level';

    public function index()
    {
        if(!Helper::cek_akses($this->aksesMenu)){
            return abort(404);
        }

        $settings = [
            'menu' => $this->menu,
            'title' => $this->title,
            'route' => $this->routeName,
            'ubah' => Helper::cek_akses($this->aksesMenu, 'Ubah'),
            'hapus' => Helper::cek_akses($this->aksesMenu, 'Hapus'),
        ];

        $datas = Level::all();
        
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
        $menus = Menu::all();
        
        return view($this->viewName.'.form', compact('settings', 'menus'));
    }
    
    public function store(Request $request)
    {
        if(!Helper::cek_akses($this->aksesMenu,'Tambah')){
            return abort(404);
        }

        $request->validate([
            'nama_level'=>'required|string'
        ]);

        try {
            $level = Level::create([
               'nama_level'=>$request->nama_level
            ]);

            $level->Menu()->attach($request->menu_id);
            return redirect(route($this->routeName.'.index'))->with(['success'=>'Berhasil Menambah Data '.$this->aksesMenu.' : '.$level->nama_level]);
        } catch (\Exception $e){
            return redirect()->back()->with(['error'=>'Gagal Menambah Data '.$this->aksesMenu.' : '.$e->getMessage()])->withInput($request->all());
        }

    }
    
    public function show(Level $level)
    {
        //
    }
    
    public function edit(Level $level)
    {
        if(!Helper::cek_akses($this->aksesMenu,'Ubah')){
            return abort(404);
        }

        $settings = [
            'menu' => $this->menu,
            'title' => $this->title,
            'route' => $this->routeName,
            'action'=>route($this->routeName.'.update',$level->id),
        ];

        $menus = Menu::orderBy('nama_menu','ASC')->get();
        $levelMenus = $level->Menu()->pluck('menu_id')->toArray();

        return view($this->viewName.'.form',compact('settings','menus','levelMenus'),['data'=>$level]);
    }
    
    public function update(Request $request, Level $level)
    {
        if(!Helper::cek_akses($this->aksesMenu,'Ubah')){
            return abort(404);
        }
        
        $request->validate([
            'nama_level'=>'required|string'
        ]);

        try {
            $level->update([
               'nama_level'=>$request->nama_level
            ]);

            $level->Menu()->sync($request->menu_id);
            return redirect(route($this->routeName.'.index'))->with(['success'=>'Berhasil Mengubah Data '.$this->aksesMenu.' : '.$level->nama_level]);
        } catch (\Exception $e){
            return redirect()->back()->with(['error'=>'Gagal Mengubah Data '.$this->aksesMenu.' : '.$e->getMessage()])->withInput($request->all());
        }
    }
    
    public function destroy(Level $level)
    {
        if(!Helper::cek_akses($this->aksesMenu,'Hapus')){
            return abort(404);
        }

        // if ($level->User()->count() > 0){
        //     return redirect()->back()->with(['error'=>'Gagal Menghapus Data level '.$level->nama_level.' : ada user yang masing menggunakan data ini']);
        // }

        try {
            $level->delete();

            return redirect(route($this->routeName.'.index'))->with(['success'=>'Berhasil Menghapus Data level : '.$level->nama_level]);
        } catch (\Exception $e){
            return redirect()->back()->with(['error'=>'Gagal Menghapus Data level '.$level->nama_level.' : '.$e->getMessage()]);
        }
    }
}
