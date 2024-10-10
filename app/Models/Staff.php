<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Helpers\Helper;

class Staff extends Authenticatable
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function Level(){
        return $this->belongsTo(Level::class)->withTrashed();;
    }

    public function Kelas(){
        return $this->belongsTo(Kelas::class)->withTrashed();;
    }

    public function Unit(){
        return $this->belongsTo(Unit::class)->withTrashed();;
    }
    
    public function Skrining(){
        return $this->hasMany(Skrining::class);
    }

    // Ambil data skrining terakhir
    public function getLastSkriningAttribute(){
        return $this->skrining->sortByDesc('created_at')->first();
    }

    // Cek, Apakah sebelumnya sudah pernah input
    public function getCheckSkriningAttribute(){
        if($this->last_skrining){
            return Helper::checkIsAlreadyInputSkrining($this->last_skrining->tgl_pengisian);
        } else {
            return false;
        }
    }

    // Cek, Apakah Sudah Diperbolehkan Edit Data
    public function getCheckUpdateAttribute(){
        if($this->last_skrining){
            $date = $this->last_skrining->tgl_pengisian;
            $waktuBoleh = Helper::hitungJamBolehInputSkrining($date);
            if($waktuBoleh < date("Y-m-d H:i:s")){
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
