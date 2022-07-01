<?php

namespace App\Services;

use App\Repositories\Interfaces\DeptOfficerRepositoryInterface;
use App\User;

class DeptOfficerService
{
    protected $repository;

    public function __construct(DeptOfficerRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function all()
    {
        $deptofficers = $this->repository->all();

        $data = collect();
        foreach ($deptofficers as $deptofficer) {
            $data->push([
                'id' => $deptofficer->id,

                'transmittal_no' => $deptofficer->transmittal_no,
                'date_time_submitted' => $deptofficer->date_time_submitted,
                'email_address' => $deptofficer->email_address,
                'purpose' => $deptofficer->purpose,
                'date_needed' => $deptofficer->date_needed,
                'priority' => $deptofficer->priority,
                'source' => $deptofficer->source,
                'active' => $deptofficer->active,
            ]);
        }

        return $data;
    }
}