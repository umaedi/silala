<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\OpdService;
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
    public function __construct(OpdService $opdService)
    {
        $this->opd = $opdService;
    }

    public function __invoke(Request $request)
    {
        if (\request()->ajax()) {
            $data['data'] = $this->opd->getAll();
            return view('admin.dashboard._data_opd', $data);
        }
        return view('admin.dashboard.index');
    }
}
