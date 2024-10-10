<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Models\Pengaturan;

class PengaturanController extends Controller
{
    protected $routeName = 'pengaturan';
    protected $viewName = 'pengaturan';
    protected $menu = 'Master Data';
    protected $title = 'Pengaturan';

    protected $aksesMenu = 'pengaturan';

    public function index()
    {
        if(!Helper::cek_akses($this->aksesMenu)){
            return abort(404);
        }

        // ambil data dari table crud
        $datas = Pengaturan::all();

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

        $data = Pengaturan::findOrFail($id);
        return view($this->viewName.'.edit',compact('settings', 'data'));
    }

    // update data
    public function update(Request $request, $id)
    {
        if (!Helper::cek_akses($this->aksesMenu, 'Ubah')) {
            return abort(404);
        }

        $this->validate($request, [
            'nama_pengaturan' => 'required',
            'value' => 'required'
        ]);
        
        Pengaturan::findOrFail($id)->update($request->all());

        return redirect(route('pengaturan.index'))->with(['success' => 'Berhasil Mengubah Data ' . $this->aksesMenu]);;
    }

    public function destroy($id)
    {
        if(!Helper::cek_akses($this->aksesMenu,'Hapus')){
            return abort(404);
        }

        $kelas = Pengaturan::findOrFail($id);
        $kelas->delete();
            
        return redirect(route('kelas.index'))->with(['success' => 'Berhasil Menhapus Data ' . $this->aksesMenu]);;
    }
}
