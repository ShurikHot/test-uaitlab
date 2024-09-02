<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\Controller;
use App\Models\WarrantyClaimSparepart;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __invoke(Request $request)
    {
        $query = $request->input('query');
        $parts = WarrantyClaimSparepart::search($query)->get();

        return response()->json($parts);
    }
}
