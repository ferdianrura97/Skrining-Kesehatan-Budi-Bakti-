<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Models\Kelas;
use App\Models\Unit;

class KelasController extends Controller
{
    protected $routeName = 'kelas';
    protected $viewName = 'kelas';
    protected $menu = 'Master Data';
    protected $title = 'Kelas';

    protected $aksesMenu = 'Kelas';

    public function index()
    {
        if(!Helper::cek_akses($this->aksesMenu)){
            return abort(404);
        }

        // ambil data dari table crud
        $datas = Kelas::all();

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

        $units = Unit::all();

        return view($this->viewName.'.tambah', compact('settings', 'units'));
    }

    public function store(Request $request)
    {
        if (!Helper::cek_akses($this->aksesMenu, 'Tambah')) {
            return abort(404);
        }

        $this->validate($request, [
            'nama_kelas' => 'required'
        ]);
        
        
        kelas::create($request->all());
        return redirect(route('kelas.index'))->with(['success' => 'Berhasil Menambah Data ' . $this->aksesMenu]);;
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

        $data = kelas::findOrFail($id);
        $units = Unit::all();

        return view($this->viewName.'.edit',compact('settings', 'data', 'units'));
    }

    // update data pegawai
    public function update(Request $request, $id)
    {
        if (!Helper::cek_akses($this->aksesMenu, 'Ubah')) {
            return abort(404);
        }

        $this->validate($request, [
            'nama_kelas' => 'required'
        ]);
        
        kelas::findOrFail($id)->update($request->all());

        return redirect(route('kelas.index'))->with(['success' => 'Berhasil Mengubah Data ' . $this->aksesMenu]);;
    }

    public function destroy($id)
    {
        if(!Helper::cek_akses($this->aksesMenu,'Hapus')){
            return abort(404);
        }

        $kelas = kelas::findOrFail($id);
        $kelas->delete();
            
        return redirect(route('kelas.index'))->with(['success' => 'Berhasil Menhapus Data ' . $this->aksesMenu]);;
    }
}
