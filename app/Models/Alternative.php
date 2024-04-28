<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternative extends Model
{
    use HasFactory;

    protected $fillable = [
        'alternative_code',
        'alternative_name',
        'description',
        'image',
    ];

    public function alternative_values()
    {
        return $this->hasMany(AlternativeValue::class, 'alternative_id');
    }
}
