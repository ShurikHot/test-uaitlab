<?php

namespace App\Http\Controllers;

use App\Jobs\ImportSqlToDBJob;

class ImportSqlController extends Controller
{
    public function import()
    {
        $path = storage_path("app/public/sql/2_tables_additional.sql");
        if (file_exists($path)) {
            ImportSqlToDBJob::dispatchSync();
            return redirect()->back()->with('success', 'SQL дамп успішно завантажений');
        } else {
            return redirect()->back()->with('error', 'Файл не знайдено');
        }
    }
}
