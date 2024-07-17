<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;


class Alternative extends Model
{
    use HasFactory;

    protected $fillable = [
        'alternative_code',
        'alternative_name',
        'description',
        'location',
        'image',
    ];

    public function alternative_values()
    {
        return $this->hasMany(AlternativeValue::class, 'alternative_id');
    }

    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($alternative) {
            Storage::disk('public')->delete($alternative->image);
        });
    }
}
