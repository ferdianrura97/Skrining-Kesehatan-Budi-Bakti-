<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Skrining extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded =[];
    
    public function staff(){
        return $this->belongsTo(Staff::class)->withTrashed();
    }

    public function siswa(){
        return $this->belongsTo(Siswa::class)->withTrashed();
    }
    
    public function detail(){
        return $this->hasMany(DetailSkrining::class);
    }

    public function getDesainStatusAttribute(){
        $button = null;
        if($this->status == 'sehat'){
            $button = '<button type="button" class="btn btn-sm btn-success float-right">'.$this->status.'</button>';
        }else if($this->status == 'covid'){
            $button = '<button type="button" class="btn btn-sm btn-danger float-right">'.$this->status.'</button>';
        }else if($this->status == 'sakit'){
            $button = '<button type="button" class="btn btn-sm btn-warning float-right">'.$this->status.'</button>';
        }else if($this->status == 'karantina'){
            $button = '<button type="button" class="btn btn-sm btn-warning float-right">'.$this->status.'</button>';
        }

        return $button;
    }

    public function getDesainStatusKesehatanKeluargaAttribute(){
        $button = null;
        if($this->status_kesehatan_keluarga == 'sehat'){
            $button = '<button type="button" class="btn btn-sm btn-success float-right">'.$this->status_kesehatan_keluarga.'</button>';
        }else if($this->status_kesehatan_keluarga == 'pandemi'){
            $button = '<button type="button" class="btn btn-sm btn-warning float-right">'.$this->status_kesehatan_keluarga.'</button>';
        }

        return $button;
    }

    // mutator laravel
    public function getCekPenyakitAttribute($penyakit_id){
        $status = false;
        if($penyakit_id){
            foreach ($this->detail as $detail) {
                if($penyakit_id == $detail->penyakit_id){
                    $status = true;
                }
            }
        }

        return $status;
    }

    public function getPesanMasukSekolahAttribute(){
        return ($this->masuk_sekolah == 0) ? 
        '<button type="button" class="btn btn-sm btn-warning float-right">Tidak Boleh Masuk Sekolah</button>'
        :
        '<button type="button" class="btn btn-sm btn-success float-right">Boleh Masuk Sekolah</button>'
        ;
    }
    
}
