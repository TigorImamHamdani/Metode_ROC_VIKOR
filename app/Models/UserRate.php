<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRate extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'alternative_id',
        'criteria_id',
        'value',
    ];

    // Define relationships with both Alternatif and Kriteria using `belongsTo`
    public function alternative()
    {
        return $this->belongsTo(Alternative::class);
    }

    public function criteria()
    {
        return $this->belongsTo(Criteria::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
