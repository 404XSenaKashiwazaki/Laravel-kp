<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Payment extends Model
{
    use HasFactory;
    protected $primaryKey = 'uuid';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = "payment";
    protected $fillable = [
        'order_id',
        'total',
        "note",
        "bank_id",
        "gambar"
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
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function bank () {
        return $this->belongsTo(Bank::class, 'bank_id');
    }
}
