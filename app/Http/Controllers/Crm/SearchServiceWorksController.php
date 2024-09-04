<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\Controller;
use App\Models\ServiceWorks;
use App\Models\SpareParts;
use App\Models\WarrantyClaimSparepart;
use Illuminate\Http\Request;

class SearchServiceWorksController extends Controller
{
    public function __invoke(Request $request)
    {
        $query = $request->input('query');
        $parts = ServiceWorks::search($query)->get();

        return response()->json($parts);
    }
}
