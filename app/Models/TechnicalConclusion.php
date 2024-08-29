<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TechnicalConclusion extends Model
{
    use HasFactory;

    protected $guarded = false;

    public function warrantyClaim(): BelongsTo
    {
        return $this->belongsTo(WarrantyClaim::class, 'warranty_claims_code_1c', 'code_1c');
    }
}
