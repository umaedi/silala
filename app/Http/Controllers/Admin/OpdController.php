<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\OpdService;

class OpdController extends Controller
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

    public function __invoke($id)
    {
        $opd = $this->opd->find($id);
        return $this->success($opd);
    }
}
