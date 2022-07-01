<?php

namespace App\Services;

use App\Repositories\Interfaces\DeptUserRepositoryInterface;
use App\User;

class DeptUserService
{
    protected $repository;

    public function __construct(DeptUserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function all()
    {
        $deptusers = $this->repository->all();

        $data = collect();
        foreach ($deptusers as $deptuser) {
            $data->push([
                'id' => $deptuser->id,

                'transmittal_no' => $deptuser->transmittal_no,
                'date_time_submitted' => $deptuser->date_time_submitted,
                'email_address' => $deptuser->email_address,
                'purpose' => $deptuser->purpose,
                'date_needed' => $deptuser->date_needed,
                'priority' => $deptuser->priority,
                'source' => $deptuser->source,
                'active' => $deptuser->active,
            ]);
        }

        return $data;
    }
}