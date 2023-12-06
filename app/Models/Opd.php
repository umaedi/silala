<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opd extends Model
{
    use HasFactory;

    public function layanan()
    {
        return $this->hasMany(Layanan::class);
    }

    public function laporan()
    {
        return $this->hasMany(Laporan::class);
    }

    public function user()
    {
        return $this->hasMany(User::class);
    }
}
