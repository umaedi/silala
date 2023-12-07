<?php

namespace App\Http\Controllers\Oprator;

use App\Http\Controllers\Controller;
use App\Services\LaporanService;
use App\Services\LayananService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected $layanan;
    protected $laporan;
    public function __construct(LayananService $layananService, LaporanService $laporanService)
    {
        $this->layanan = $layananService;
        $this->laporan = $laporanService;
    }

    public function __invoke(Request $request)
    {
        if (\request()->ajax()) {
            $data['data'] = $this->layanan->Query()->where('opd_id', Auth::user()->opd_id)->latest()->paginate(5);
            return view('oprator.laporan._data_layanan', $data);
        }

        $data['title'] = "Oprator Dashboard";
        $data['jenis_layanan'] = $this->layanan->Query()->where('opd_id', Auth::user()->opd_id)->count();
        $data['laporan_harian'] = $this->laporan->Query()->where('opd_id', Auth::user()->opd_id)->whereDate('created_at', Carbon::today())->count();
        return view('oprator.dashboard.index', $data);
    }
}
