<?php

namespace App\Services;

use App\Models\User;

class OpratorService
{
    protected $oprator;
    public function __construct(User $user)
    {
        $this->oprator = $user;
    }

    public function find($id)
    {
        $oprator = $this->oprator->find($id);
        return $oprator;
    }

    public function Query()
    {
        return $this->oprator->query();
    }

    public function store($data)
    {
        return $this->oprator->create($data);
    }

    public function update($id, $data)
    {
        $oprator = $this->oprator->find($id);
        $oprator->update($data);
        return $oprator;
    }

    public function destroy($id)
    {
        $oprator = $this->oprator->find($id);
        $oprator->delete($id);
        return $oprator;
    }
}
