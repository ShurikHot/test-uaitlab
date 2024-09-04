<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\Controller;
use App\Models\SpareParts;
use App\Models\WarrantyClaimSparepart;
use Illuminate\Http\Request;

class SearchSparePartsController extends Controller
{
    public function __invoke(Request $request)
    {
        $query = $request->input('query');
        $parts = SpareParts::search($query)->get();

        return response()->json($parts);
    }
}
