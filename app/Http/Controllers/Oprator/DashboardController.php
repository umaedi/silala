<?php

namespace App\Http\Controllers\Oprator;

use App\Http\Controllers\Controller;
use App\Services\LayananService;
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
    public function __construct(LayananService $layananService)
    {
        $this->layanan = $layananService;
    }

    public function __invoke(Request $request)
    {
        if (\request()->ajax()) {
            $data['data'] = $this->layanan->Query()->where('opd_id', Auth::user()->opd_id)->paginate(5);
            return view('oprator.laporan._data_layanan', $data);
        }

        $data['title'] = "Oprator Dashboard";
        return view('oprator.dashboard.index', $data);
    }
}
