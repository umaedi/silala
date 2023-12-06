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

    public function show($id)
    {
        $layanan = $this->layanan->find($id);
        return $layanan;
    }

    public function store($data)
    {
        return $this->layanan->create($data);
    }

    public function Query()
    {
        return $this->layanan->query();
    }

    public function count()
    {
        return $this->layanan->count();
    }
}
