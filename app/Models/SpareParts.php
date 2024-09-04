<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class SpareParts extends Model
{
    use HasFactory;
    use Searchable;

    protected $guarded = false;

    public function searchableAs()
    {
        return 'parts_index';
    }

    public function toSearchableArray()
    {
        return [
            'code_1c' => $this->code_1c,
            'articul' => $this->articul,
            'product' => $this->product,
            'price' => $this->price,
            'discount' => $this->discount,
        ];
    }
}
