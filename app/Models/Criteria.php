<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    use HasFactory;

    protected $fillable = [
        'criteria_code',
        'criteria_name',
        'weight',
        'description',
    ];

    public function alternatif_value()
    {
        return $this->hasMany(AlternativeValue::class, 'criteria_id');
    }

    public function weightValues()
    {
        return $this->hasMany(WeightValue::class);
    }
}
