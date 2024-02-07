<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Indicator extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $keyType = 'string';

    protected $guarded = [
        'created_at',
        'updated_at',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function unity()
    {
        return $this->belongsTo(Unity::class);
    }

    public function periodicity()
    {
        return $this->belongsTo(Periodicity::class);
    }

    public function method()
    {
        return $this->belongsTo(Method::class);
    }

}
