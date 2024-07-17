<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlternativeValue extends Model
{
    use HasFactory;

    protected $fillable = [
        'alternative_id',
        'criteria_id',
        'value',
    ];

    // Definisikan hubungan dengan Alternatif dan Kriteria menggunakan `belongsTo`
    public function alternative()
    {
        return $this->belongsTo(Alternative::class);
    }

    public function criteria()
    {
        return $this->belongsTo(Criteria::class);
    }

}
