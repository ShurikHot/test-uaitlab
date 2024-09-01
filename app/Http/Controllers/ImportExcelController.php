<?php

namespace App\Http\Controllers;

use App\Jobs\ImportExcelToDBJob;
use Maatwebsite\Excel\Facades\Excel;

class ImportExcelController extends Controller
{
    private const FILES = [
        'warranty_claims' => 'warranty_claims.xlsx',
        'technical_conclusions' => 'technical_conclusions.xlsx',
        'warranty_claim_service_works' => 'warranty_claim_service_works.xlsx',
        'warranty_claim_spareparts' => 'warranty_claim_spareparts.xlsx'
    ];
    public function import()
    {
        foreach (self::FILES as $tableName => $fileName) {
            $path = storage_path("app/public/excel-files/$fileName");
            if (file_exists($path)) {
                $data = Excel::toArray([], $path);

                ImportExcelToDBJob::dispatchSync($tableName, $data[0]);   //заповнення таблиці
            } else {
                return redirect()->back()->with('error', 'Файл таблиці ' . $tableName . ' не знайдено');
            }
        }
        return redirect()->back()->with('success', 'Данні з таблиць успішно імпортовані');
    }
}
