<?php

namespace App\Http\Controllers;

use App\Contracts\SparePartsIndexInterface;
use App\Jobs\ImportSqlToDBJob;
use App\Models\ServiceWorks;
use App\Models\SpareParts;
use App\Models\WarrantyClaimServiceWork;
use App\Models\WarrantyClaimSparepart;

class ImportCatalogsController extends Controller
{
    protected $sparePartsIndex;
    public function __construct(SparePartsIndexInterface $sparePartsIndex)
    {
        $this->sparePartsIndex = $sparePartsIndex;
    }

    public function import()
    {
        $this->importWorks();
        $this->importSpareParts();

        $path = storage_path("app/public/sql/2_tables_additional.sql");
        if (file_exists($path)) {
            ImportSqlToDBJob::dispatchSync();
            return redirect()->back()->with('success', 'Довідники успішно завантажені');
        } else {
            return redirect()->back()->with('error', 'Файли не знайдено');
        }
    }

    public function importWorks(): void
    {
        $works = WarrantyClaimServiceWork::query()
            ->get(['code_1c', 'product'])
            ->unique('code_1c')
            ->sortBy('product')
            ->toArray();
        ServiceWorks::query()->insertOrIgnore($works);
    }

    public function importSpareParts(): void
    {
        $parts = WarrantyClaimSparepart::query()
            ->get(['code_1c', 'articul', 'product', 'price', 'discount'])
            ->unique('code_1c')
            ->toArray();
        SpareParts::query()->insertOrIgnore($parts);

        $this->sparePartsIndex->createIndex();
    }
}
