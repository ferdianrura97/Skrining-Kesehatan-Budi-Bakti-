<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Models\Penyakit;

class PenyakitController extends Controller
{
    protected $routeName = 'penyakit';
    protected $viewName = 'penyakit';
    protected $menu = 'Master Data';
    protected $title = 'Penyakit';

    protected $aksesMenu = 'Penyakit';

    public function index()
    {
        if(!Helper::cek_akses($this->aksesMenu)){
            return abort(404);
        }

        // ambil data dari table crud
        $datas = DB::table('penyakits')->get();

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

    public function tambah()
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

        return view($this->viewName.'.tambah', compact('settings'));
    }

    public function store(Request $request)
    {
        if (!Helper::cek_akses($this->aksesMenu, 'Tambah')) {
            return abort(404);
        }

        DB::table('penyakits')->insert([
            'id' => $request->id,
            'nama_penyakit' => $request->nama_penyakit,
            'point' => $request->point
        ]);
        // alihkan halaman ke halaman pegawai
        return redirect(route('penyakit.index'))->with(['success' => 'Berhasil Menambah Data ' . $this->aksesMenu]);;
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

        // mengambil data pegawai berdasarkan id yang dipilih
        $data = DB::table('penyakits')->where('id',$id)->first();
        // passing data pegawai yang didapat ke view edit.blade.php
        return view($this->viewName.'.edit',compact('settings', 'data'));
    }

    // update data pegawai
    public function update(Request $request)
    {
        if (!Helper::cek_akses($this->aksesMenu, 'Ubah')) {
            return abort(404);
        }
        // update data pegawai
        $penyakit = Penyakit::find($request->id);
        $penyakit->update([
            'nama_penyakit' => $request->nama_penyakit,
            'point' => $request->point
        ]);
        // alihkan halaman ke halaman pegawai
        return redirect(route('penyakit.index'))->with(['success' => 'Berhasil Mengubah Data ' . $this->aksesMenu]);;
    }

    // method untuk hapus data pegawai
    public function hapus($id)
    {
        if(!Helper::cek_akses($this->aksesMenu,'Hapus')){
            return abort(404);
        }

        // menghapus data pegawai berdasarkan id yang dipilih
        DB::table('penyakits')->where('id',$id)->delete();
            
        // alihkan halaman ke halaman pegawai
        return redirect(route('penyakit.index'))->with(['success' => 'Berhasil Menghapus Data ' . $this->aksesMenu]);;
    }
}
