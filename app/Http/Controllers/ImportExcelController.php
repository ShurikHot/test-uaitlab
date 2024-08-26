<?php

namespace App\Http\Controllers;

use App\Jobs\ImportExcelToDBJob;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;
use Exception;

class ImportExcelController extends Controller
{
    private const FILES = [
        'warranty_claims' => 'warranty_claims.xlsx',
        'technical_conclusions' => 'technical_conclusions.xlsx',
        'warranty_claim_service_works' => 'warranty_claim_service_works.xlsx',
        'warranty_claim_spareparts' => 'warranty_claim_spareparts.xlsx'
    ];
    public function import(): void
    {
        foreach (self::FILES as $tableName => $fileName) {
            $path = storage_path("app/public/excel-files/$fileName");

            $data = Excel::toArray([], $path);

            ImportExcelToDBJob::dispatchSync($tableName, $data[0]);   //заповнення таблиці
        }
    }
}
