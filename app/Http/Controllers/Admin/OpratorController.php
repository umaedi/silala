<?php

namespace App\Http\Controllers\Admin;

use App\Services\OpratorService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class OpratorController extends Controller
{
    protected $oprator;
    public function __construct(OpratorService $opratorService)
    {
        $this->oprator = $opratorService;
    }

    public function index()
    {
        if (\request()->ajax()) {
            $oprator = $this->oprator->Query();
            if (\request()->search) {
                $oprator->where('name', 'like', '%' . request()->search . '%');
            }
            $data['table'] = $oprator->where('level', 'user')->with('opd')->paginate(5);
            return view('admin.oprator._data_oprator', $data);
        }
        return view('admin.oprator.index');
    }

    public function store()
    {
        if (\request()->ajax()) {
            $validate = Validator::make(\request()->all(), [
                'name'  => 'required|string|max:100',
                'email' => 'required|string|unique:users|max:100',
                'password'  => 'required|string|max:100',
                'opd_id'    => 'required|string|max:100'
            ]);

            if ($validate->fails()) {
                return $this->error($validate->errors());
            }

            $data = \request()->except('_token');
            $data['password'] = Hash::make($data['password']);
            try {
                $this->oprator->store($data);
            } catch (\Throwable $th) {
                dd($th);
                return $this->error($th->getMessage());
            }
            return $this->success('Data berhasil ditambahkan');
        }
    }

    public function update($id)
    {
        if (\request()->ajax()) {
            $oprator = $this->oprator->find($id);

            $validate = Validator::make(\request()->all(), [
                'name'  => 'required|string|max:100',
                'email' => 'required|string|max:100|unique:users,email,' . $oprator->id,
            ]);

            if ($validate->fails()) {
                return $this->error($validate->errors());
            }

            $data = \request()->except('_token');
            if ($data['opd_id'] == '') {
                $data['opd_id'] = $oprator->opd_id;
            }

            try {
                $this->oprator->update($id, $data);
            } catch (\Throwable $th) {
                return $this->error($th->getMessage());
            }
            return $this->success('Data berhasil diubah');
        }
    }

    public function show($id)
    {
        $data['title'] = "Profile";
        $data['user'] = $this->oprator->find($id);
        return view('admin.oprator.show', $data);
    }

    public function delete($id)
    {
        if (\request()->ajax()) {
            if (\request()->accountActivation == 'on') {
                try {

                    $this->oprator->destroy($id);
                } catch (\Throwable $th) {
                    return $this->error($th->getMessage());
                }
                return $this->success('Akun berhasil di non-aktifkan');
            } else {
                return $this->success('Tidak ada data berubah');
            }
        }
    }
}
