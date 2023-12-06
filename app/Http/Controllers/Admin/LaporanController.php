<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\LaporanService;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
            $data['table'] = $this->laporan->Query()->whereDate('created_at', Carbon::today())->with(['layanan', 'opd'])->paginate();
            return view('admin.laporan._data_laporan', $data);
        }
    }
}
