<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\LaporanService;
use App\Services\LayananService;
use App\Services\OpdService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DahsboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected $opd;
    protected $layanan;
    protected $laporan;
    public function __construct(OpdService $opdService, LayananService $layananService, LaporanService $laporanService)
    {
        $this->opd = $opdService;
        $this->layanan = $layananService;
        $this->laporan = $laporanService;
    }

    public function __invoke(Request $request)
    {
        if (\request()->ajax()) {
            $data['data'] = $this->opd->getAll();
            $data['opd'] = $this->opd->count();
            return view('admin.dashboard._data_opd', $data);
        }

        $data['opd'] = $this->opd->count();
        $data['layanan'] = $this->layanan->count();
        $data['pelayanan_hari_ini'] = $this->laporan->Query()->whereDate('created_at', Carbon::today())->count();
        $data['total_pelayanan'] = $this->laporan->count();
        return view('admin.dashboard.index', $data);
    }
}
