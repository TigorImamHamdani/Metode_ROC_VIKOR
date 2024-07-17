<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeightValue extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'criteria_id', 'weight'
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'weight_values';

    /**
     * Get the criteria associated with the weight value.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function criteria()
    {
        return $this->belongsTo(Criteria::class);
    }
}
