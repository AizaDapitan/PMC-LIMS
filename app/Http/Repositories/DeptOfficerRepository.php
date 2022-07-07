<?php

namespace App\Repositories;

use App\Repositories\Interfaces\DeptOfficerRepositoryInterface;
use App\DeptOfficer;

class DeptUOfficerRepository implements DeptOfficerRepositoryInterface
{
    protected $deptofficer;

    public function __construct(DeptOfficer $deptofficer)
    {
        $this->deptofficer = $deptofficer;
    }

    public function all()
    {
        return $this->deptofficer->all();
    }

}