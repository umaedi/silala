<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\LaporanService;
use App\Services\LayananService;

class LayananController extends Controller
{
    protected $layanan;
    protected $laporan;
    public function __construct(LayananService $layananService, LaporanService $laporan)
    {
        $this->layanan = $layananService;
        $this->laporan = $laporan;
    }

    public function index($id)
    {
        if (\request()->ajax()) {
            $layanan = $this->layanan->Query();
            if (\request()->search) {
                $layanan = $layanan->where('nama_layanan', 'like', '%' . \request()->search . '%');
            }

            $data['table'] = $layanan->where('opd_id', $id)->with('opd')->paginate(5);
            return view('admin.layanan._data_layanan', $data);
        }
        $data['title'] = 'Layanan Silala';
        return view('admin.layanan.index', $data);
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

    public function show($id)
    {
        if (\request()->ajax()) {
            $data['table'] = $this->laporan->Query()->where('layanan_id', $id)->with(['layanan', 'opd'])->paginate();
            return view('admin.laporan._data_laporan', $data);
        }
        return view('admin.layanan.show');
    }
}
