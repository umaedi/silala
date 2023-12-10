<?php

namespace App\Services;

use App\Models\Opd;

class OpdService
{
    protected $opd;
    public function __construct(Opd $opd)
    {
        $this->opd = $opd;
    }

    public function find($id)
    {
        $opd = $this->opd->find($id);
        return $opd;
    }

    public function getAll()
    {
        return $this->opd->all();
    }

    public function count()
    {
        return $this->opd->count();
    }
}
