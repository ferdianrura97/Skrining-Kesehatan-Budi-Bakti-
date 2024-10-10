<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\supplier;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{
    public function supplierById($id){
        $supplier = Supplier::find($id);

        return response()->json([
            'data' => $supplier
        ]);
    }
}
