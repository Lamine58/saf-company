<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class InsuranceType extends Model
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


    public function insurance()
    {
        return $this->belongsTo(Insurance::class);
    }

    public static function images (){
        return [
            'image-4.jpg',
            'image-1.jpg',
            'image-2.jpg',
            'image-3.jpg',
        ];
    }

}
