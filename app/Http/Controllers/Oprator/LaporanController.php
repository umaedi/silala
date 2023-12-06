<?php

namespace App\Http\Controllers\Oprator;

use App\Http\Controllers\Controller;
use App\Services\LaporanService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LaporanController extends Controller
{
    protected $laporan;
    public function __construct(LaporanService $laporanService)
    {
        $this->laporan = $laporanService;
    }

    public function index()
    {
        if (\request()->ajax()) {
            $laporan = $this->laporan->Query();
            $data['table'] = $laporan->where('opd_id', Auth::user()->opd_id)->with('layanan')->latest()->paginate(5);
            return view('oprator.laporan._data_laporan', $data);
        }
    }

    public function store()
    {
        $validate = Validator::make(\request()->all(), [
            'layanan_id' => 'required|string|max:100',
            'keterangan'    => 'string|max:255'
        ]);

        if ($validate->fails()) {
            return $this->error($validate->errors());
        }

        if (\request()->ajax()) {
            $data = \request()->except('_token');
            $data['opd_id'] = Auth::user()->opd_id;

            try {
                $this->laporan->store($data);
            } catch (\Throwable $th) {
                return $this->error($th->getMessage());
            }
            return $this->success('Data berhasil ditambahkan');
        }
    }
}
