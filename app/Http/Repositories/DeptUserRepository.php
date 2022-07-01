<?php

namespace App\Repositories;

use App\Repositories\Interfaces\DeptUserRepositoryInterface;
use App\DeptUser;

class DeptUserRepository implements DeptUserRepositoryInterface
{
    protected $deptuser;

    public function __construct(DeptUser $deptuser)
    {
        $this->deptuser = $deptuser;
    }

    public function all()
    {
        return $this->deptuser->all();
    }

}