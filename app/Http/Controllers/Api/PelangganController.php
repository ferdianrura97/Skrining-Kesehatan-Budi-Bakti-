<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\pelanggan;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PelangganController extends Controller
{
    public function pelangganById($id){
        $pelanggan = Pelanggan::find($id);

        return response()->json([
            'data' => $pelanggan
        ]);
    }
}
