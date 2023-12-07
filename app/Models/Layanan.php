<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Layanan extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'opd_id',
        'nama_layanan',
    ];

    public function opd()
    {
        return $this->belongsTo(Opd::class);
    }

    public function laporan()
    {
        return $this->hasMany(Laporan::class);
    }

    static function booted()
    {
        static::creating(function ($model) {
            $model->id = Uuid::uuid4()->toString();
        });
    }
}
