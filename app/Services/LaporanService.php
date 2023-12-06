<?php

namespace App\Services;

use App\Models\Laporan;

class LaporanService
{
    protected $laporan;
    public function __construct(Laporan $laporan)
    {
        $this->laporan = $laporan;
    }

    public function store($data)
    {
        return $this->laporan->create($data);
    }

    public function Query()
    {
        return $this->laporan->query();
    }

    public function count()
    {
        return $this->laporan->count();
    }
}
