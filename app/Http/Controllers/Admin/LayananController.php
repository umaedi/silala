<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\LayananService;

class LayananController extends Controller
{
    protected $layanan;
    public function __construct(LayananService $layananService)
    {
        $this->layanan = $layananService;
    }

    public function store()
    {
        if (\request()->ajax()) {
            $data = \request()->except('_token');
            try {
                $this->layanan->store($data);
            } catch (\Throwable $th) {
                return $this->error($th->getMessage());
            }
            return $this->success('Data berhasil ditambahkan');
        }
    }
}
