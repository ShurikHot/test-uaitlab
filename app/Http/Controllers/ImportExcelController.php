<?php

namespace App\Http\Controllers;

use App\Imports\ExcelTableImport;
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
    public function import()
    {
        $files = [
            'warranty_claims' => 'warranty_claims.xlsx',
            'technical_conclusions' => 'technical_conclusions.xlsx',
            'warranty_claim_service_works' => 'warranty_claim_service_works.xlsx',
            'warranty_claim_spareparts' => 'warranty_claim_spareparts.xlsx'
        ];

        foreach ($files as $tableName => $fileName) {
            $path = storage_path("app/public/excel-files/$fileName");

            $data = Excel::toArray(new ExcelTableImport(), $path);
            $headers = $data[0][0];

            $this->createTableFromHeaders($tableName, $headers);  // для автостворення таблиці, без міграції
            $this->loadDataIntoTable($tableName, $data[0]);   // для заповнення таблиці
        }
    }

    protected function createTableFromHeaders(string $tableName, array $headers)
    {
        if (Schema::hasTable($tableName)) {
            DB::statement('PRAGMA foreign_keys = OFF'); //для sqlite
            Schema::dropIfExists($tableName);
            DB::statement('PRAGMA foreign_keys = ON'); //для sqlite
        }

        Schema::create($tableName, function (Blueprint $table) use ($headers, $tableName) {
            $table->id();

            foreach ($headers as $columnName) {
                if ($tableName === 'warranty_claims' && Str::contains($columnName, ['code_1c', 'number_1c'])) {
                    $table->string($columnName)->unique();
                } elseif (Str::contains($columnName, 'date')) {
                    $table->dateTime($columnName)->nullable();
                } elseif (Str::contains($columnName, ['price', 'sum', 'qty'])) {
                    $table->decimal($columnName, 10, 2)->nullable();
                } elseif (Str::contains($columnName, 'status')) {
                    $table->boolean($columnName)->nullable();
                } elseif (Str::contains($columnName, 'warranty_claims_code_1c')) {
                    $table->string($columnName)->nullable();
                    $table->foreign($columnName)->references('code_1c')->on('warranty_claims');
                } elseif (Str::contains($columnName, 'warranty_claims_number_1c')) {
                    $table->string($columnName)->nullable();
                    $table->foreign($columnName)->references('number_1c')->on('warranty_claims');
                } else {
                    $table->string($columnName)->nullable();
                }
            }

            $table->timestamps();
        });
        /*        try {
        } catch (Exception $e) {
            Log::error('Error importing table: ' . $e->getMessage());
        }*/
    }

    protected function loadDataIntoTable($tableName, $data)
    {
        $headers = array_shift($data);

        if (Schema::hasTable($tableName)) {
            /*кожний рядок окремо*/
            /*foreach ($data as $row) {
                $rowData = [];
                foreach ($row as $key => $value) {
                    $rowData[$headers[$key]] = $value;
                }
                DB::table($tableName)->insert($rowData);
            }*/

            /*пакетами по $batch штук*/
            $batch = 500;
            $counter = 0;
            foreach ($data as $row) {
                foreach ($row as $key => $value) {
                    $rowData[$headers[$key]] = $value;
                }
                $rows[] = $rowData;

                if (++$counter % $batch === 0) {
                    DB::table($tableName)->insert($rows);
                    $rows = [];
                }
            }

            if (!empty($rows)) {
                DB::table($tableName)->insert($rows);
            }
        }
    }
}
