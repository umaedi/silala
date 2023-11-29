<?php

namespace App\Services;

use App\Models\Layanan;

class LayananService
{
    protected $layanan;
    public function __construct(Layanan $layanan)
    {
        $this->layanan = $layanan;
    }

    public function store($data)
    {
        return $this->layanan->create($data);
    }
}
