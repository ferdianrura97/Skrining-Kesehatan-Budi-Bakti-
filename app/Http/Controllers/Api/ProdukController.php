<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ProdukController extends Controller
{
    public function produkById($id){
        $produk = Produk::find($id);

        return response()->json([
            'data' => $produk
        ]);
    }
}
