<?php
namespace App\Helpers;

use App\Models\Pengaturan;
use App\Models\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Helper {
    public static function cek_route($routes,$or = false){
        if(is_array($routes)){
            if($or){
                foreach ($routes as $route){
                    if(request()->routeIs($route)){
                        return true;
                    }
                }
            } else {
                foreach ($routes as $route){
                    if(!request()->routeIs($route)){
                        return false;
                    }
                }
                return true;
            }
        } else {
            if(request()->routeIs($routes)){
                return true;
            }
        }

        //default
        return false;
    }

    public static function cek_akses($moduls,$aksi = null,$array = false){
        if($array){
            if(is_array($moduls)){
                if(count($moduls) > 0 && is_array($moduls[0])){

                    $result = [];
                    foreach ($moduls as $modul => $a){
                        $result[$modul] = Helper::cek_modul($modul,$a);
                    }
                    return $result;
                } else {
                    $result = [];
                    foreach ($moduls as $modul){
                        $result[$modul] = Helper::cek_modul($modul,$aksi);
                    }
                    return $result;

                }
            } else {
                return [
                    $moduls=>Helper::cek_modul($moduls,$aksi)
                ];
            }
        } else {
            return Helper::cek_modul($moduls,$aksi);
        }
        //default
        if($array){
            return [];
        }
        return false;
    }

    public static function cek_modul($moduls,$aksi = null){
        $user = Auth::user();
        if(is_array($moduls)){
            if(count($moduls) > 0 && is_array($moduls[0])){
                $cek = Level::where('id',$user->level_id)->whereHas('Level.Menu',function($q)use($moduls){
                    $q->where($moduls);
                });

                if($cek->count() > 0){
                    return true;
                }
            } else {
                $cek = Level::where('id',$user->level_id)->whereHas('Level.Menu',function($q)use($moduls,$aksi){
                    $q->whereIn('nama_menu',$moduls)->where('aksi_menu',$aksi ?? 'Lihat');
                });

                if($cek->count() > 0){
                    return true;
                }
            }
        } else {
            
            $cek = Level::where('id',$user->level_id)->whereHas('Menu',function($q)use($moduls,$aksi){
                $q->where('nama_menu',$moduls)->where('aksi_menu',$aksi ?? 'Lihat');
            });
            
            if($cek->count() > 0){
                return true;
            }
        }
        //default
        return false;
    }

    public static function checkIfLoginAs($level){
        if(Auth::user()->level->nama_level == $level){
            return true;
        }
        return false;
    }

    public static function getLimitPointSakit(){
        $pengaturan = Pengaturan::where('nama_pengaturan','Berapa Point Yang Menentukan Siswa Sakit (tidak perlu ke sekolah) ?')->first();
        if($pengaturan){
            return $pengaturan->value;
        }
    }

    public static function getHariPengisianSkrining(){
        $pengaturan = Pengaturan::where('nama_pengaturan','Pengisian Data Skrining Setiap Hari Apa ? (Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday,Everyday)')->first();
        if($pengaturan){
            return $pengaturan->value;
        }
    }

    public static function getJamUpdateSkrining(){
        $pengaturan = Pengaturan::where('nama_pengaturan','Setelah mengisi data skrining, tidak dapat mengisi data kembali hingga ... jam berikutnya ?')->first();
        if($pengaturan){
            return $pengaturan->value;
        }
    }
    
    public static function getJamWajibSkrining(){
        $pengaturan = Pengaturan::where('nama_pengaturan','Pengisian data skrining dimulai dari jam ?')->first();
        
        if($pengaturan){
            return $exp = explode('-',$pengaturan->value);
        }
    }

    public static function checkWaktuBolehInputSkrining(){
        $currentTime = date("H:i");
        $getJamWajib = Helper::getJamWajibSkrining();

        if ($currentTime >= $getJamWajib[0] && $currentTime <= $getJamWajib[1]) {
            return true;
        }
        return false;
    }

    public static function getDayOfDate($date){
        $newDate = date('l', strtotime($date));

        return $newDate;
        // Monday
        // Tuesday
        // Wednesday
        // Thursday
        // Friday
        // Saturday
        // Sunday
    }

    // Cek Apakah Seminggu Terakhir sudah ada input skrining atau belum
    public static function checkIsAlreadyInputSkrining($date){
        if($date){
            // Check Jika buka Everyday
            if(Helper::getHariPengisianSkrining() != 'Everyday'){
                $begin = date("Y-m-d H:i:s",strtotime("last ".Helper::getHariPengisianSkrining()));
                $end = date('Y-m-d H:i:s');
                    
                if (($date >= $begin) && ($date <= $end)){
                    return true; // Ada Inputan
                }else{
                    return false; // Gak Ada Inputan
                }
            }else{
                // Check, Apakah Sudah Input Hari Ini ?
                if(date("Y-m-d", strtotime($date)) == date("Y-m-d")){
                    return true; // Ada Inputan
                }else{
                    return false; // Gak Ada Inputan
                }
            }
        }else{
            return false;
        }
    }

    // Jika Sudah Input Skrining, Hitung 2 Jam Setelah Baru boleh Update
    public static function hitungJamBolehInputSkrining($date){
        return date("Y-m-d H:i:s", strtotime("+".Helper::getJamUpdateSkrining()." hour", strtotime($date)));
    }

    public static function clean($string) {
        $str = preg_replace('/[^0-9.]+/', '', $string);
        return $str;
    }

    public static function getCurrentDateFromMonth($month, $year)
    {
        $start_date = "01-".$month."-".$year;
        $start_time = strtotime($start_date);
        $end_time = strtotime("+1 month", $start_time);
        $arrayDate = []; // Hasilnya Tanggal 1 sampai akhir bulan

        for($i=$start_time; $i<$end_time; $i+=86400){
            $arrayDate[] = date('d', $i);
        }

        return $arrayDate;
    }
}
