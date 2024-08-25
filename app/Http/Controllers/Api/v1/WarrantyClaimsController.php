<?php

namespace App\Http\Controllers\Api\v1;

use App\Actions\DateFormatAction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class WarrantyClaimsController extends Controller
{
    public function getWarrantyClaims(DateFormatAction $dateFormatAction)
    {
        $getParams = request()->all();
        $query = DB::table('warranty_claims');

        if (!empty($getParams)) {
            foreach ($getParams as $name => $value) {
                switch ($name) {
                    case 'date':
                        $value = $dateFormatAction($value, 'd.m.Y');
                        $query->where('date', $value);
                        break;
                    case 'datefrom':
                        $value = $dateFormatAction($value, 'd.m.Y');
                        $query->where('date', '>', $value);
                        break;
                    case 'dateto':
                        $value = $dateFormatAction($value, 'd.m.Y');
                        $value = $value ?: date('Y-m-d');
                        $query->where('date', '<', $value);
                        break;
                    case 'status':
                        $query->where('status', $value);
                        break;
                    case 'code_1c':
                        if (is_array($value)) {
                            $query->whereIn('code_1c', $value);
                        } else {
                            $query->where('code_1c', $value);
                        }
                        break;
                }
            }
            $result = $query->get();
        }

//        dd();
        $codes = $result->pluck('code_1c')->toArray();

        $relations = $this->getWarrantyRelations($codes);

        if (count($result)) {
            return response()->json([
                'success' => true,
                'data' => $result,
            ]);
        }
    }

    public function getWarrantyRelations(array $codes)
    {
        $tables = [
            'technical_conclusions',
            'warranty_claim_service_works',
            'warranty_claim_spareparts'
        ];

        $relations = [];
        foreach ($tables as $table) {
            $query = DB::table('warranty_claims');


        }
    }
}
