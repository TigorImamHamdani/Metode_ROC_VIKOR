<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ranking extends Model
{
    use HasFactory;

    protected $fillable = [
        'alternative_id',
        'result_rank',
        'utility_measure',
        'regret_measure',
    ];

    public function alternatif()
    {
        return $this->belongsTo(Alternative::class, 'alternative_id');
    }
}
