<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\OpratorService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    protected $oprator;
    public function __construct(OpratorService $opratorService)
    {
        $this->oprator = $opratorService;
    }

    public function index()
    {
        $data['title'] = "Profile";
        return view('admin.profile.index', $data);
    }

    public function update()
    {
        if (\request()->ajax()) {
            $user = Auth::user();
            $data = \request()->except('_token');

            $validator = Validator::make(\request()->all(), [
                'name'  => 'required|string|max:100',
                'email' => 'required|string|max:100|unique:users,email,' . $user->id,
            ]);

            if ($validator->fails()) {
                return $this->error($validator->errors());
            }

            try {
                $this->oprator->update($user->id, $data);
            } catch (\Throwable $th) {
                return $this->error($th->getMessage());
            }
            return $this->success('Profil berhhasil diupdate');
        }
    }

    public function password()
    {
        $user = Auth::user();
        $data = \request()->except('_token');

        $validator = Validator::make(\request()->all(), [
            'password_lama'  => 'required|string|max:100',
            'password_baru'  => 'required|string|max:100',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors());
        }

        if (!Hash::check($data['password_lama'], $user->password)) {
            return $this->error('Password lama tidak sesuai.');
        }

        $new_passwword['password'] = bcrypt($data['password_baru']);
        try {
            $this->oprator->update($user->id, $new_passwword);
        } catch (\Throwable $th) {
            return $this->error($th->getMessage());
        }
        return $this->success('Password berhasil diupdate');
    }
}
