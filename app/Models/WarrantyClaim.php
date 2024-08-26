<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarrantyClaim extends Model
{
    use HasFactory;

    protected $guarded = false;

    public function serviceWorks()
    {
        return $this->hasOne(WarrantyClaimServiceWork::class, 'warranty_claims_number_1c', 'number_1c');
    }

    public function spareParts()
    {
        return $this->hasOne(WarrantyClaimSparepart::class, 'warranty_claims_number_1c', 'number_1c');
    }

    public function technicalConclusions()
    {
        return $this->hasOne(TechnicalConclusion::class, 'warranty_claims_code_1c', 'code_1c');
    }
}
