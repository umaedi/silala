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

    public function Query()
    {
        return $this->oprator->query();
    }

    public function store($data)
    {
        return $this->oprator->create($data);
    }
}
