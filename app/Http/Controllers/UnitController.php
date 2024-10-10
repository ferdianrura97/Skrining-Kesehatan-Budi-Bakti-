<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Models\Unit;

class UnitController extends Controller
{
    protected $routeName = 'unit';
    protected $viewName = 'unit';
    protected $menu = 'Master Data';
    protected $title = 'Unit';

    protected $aksesMenu = 'Unit';

    public function index()
    {
        if(!Helper::cek_akses($this->aksesMenu)){
            return abort(404);
        }

        // ambil data dari table crud
        $datas = Unit::all();

        $settings = [
            'menu' => $this->menu,
            'title' => $this->title,
            'route' => $this->routeName,
            'ubah'=>Helper::cek_akses($this->aksesMenu,'Ubah'),
            'hapus'=>Helper::cek_akses($this->aksesMenu,'Hapus')
        ];

        //mengirim data ke index
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
        if (!Helper::cek_akses($this->aksesMenu, 'Tambah')) {
            return abort(404);
        }

        $this->validate($request, [
            'nama_unit' => 'required'
        ]);
        
        Unit::create($request->all());
        return redirect(route($this->routeName.'.index'))->with(['success' => 'Berhasil Menambah Data ' . $this->aksesMenu]);;
    }

    public function edit($id)
    {
        if(!Helper::cek_akses($this->aksesMenu,'Ubah')){
            return abort(404);
        }

        $settings = [
            'menu' => $this->menu,
            'title' => $this->title,
            'route' => $this->routeName,
            'action'=>route($this->routeName.'.update',$id),
        ];

        $data = Unit::findOrFail($id);
        return view($this->viewName.'.form',compact('settings', 'data'));
    }

    // update data pegawai
    public function update(Request $request, $id)
    {
        if (!Helper::cek_akses($this->aksesMenu, 'Ubah')) {
            return abort(404);
        }

        $this->validate($request, [
            'nama_unit' => 'required'
        ]);
        
        Unit::findOrFail($id)->update($request->all());

        return redirect(route($this->routeName.'.index'))->with(['success' => 'Berhasil Mengubah Data ' . $this->aksesMenu]);;
    }

    public function destroy($id)
    {
        if(!Helper::cek_akses($this->aksesMenu,'Hapus')){
            return abort(404);
        }

        $unit = Unit::findOrFail($id);
        $unit->delete();
            
        return redirect(route($this->routeName.'.index'))->with(['success' => 'Berhasil Menhapus Data ' . $this->aksesMenu]);;
    }
}
