<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OpdController extends Controller
{
    public function store()
    {
        if (\request()->ajax()) {
            $data = \request()->except('_token');
            return $this->success($data);
        }
    }
}
