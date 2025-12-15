<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Portofolio extends Model
{
     use HasFactory;
    protected $primaryKey = 'uuid';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = "portofolio";
    protected $fillable = [
        'title',
        'deskripsi',
        "gambar",
        "isi",
        "pdf"
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = Str::uuid()->toString();
        });
    }

    public function getRouteKeyName()
    {
        return 'uuid';
    }
}
