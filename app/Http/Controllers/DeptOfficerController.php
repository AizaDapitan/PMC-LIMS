<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\Models\DeptOfficer;
use App\Services\UserRightService;
use Exception;
use Illuminate\Support\Facades\Session;

class DeptOfficerController extends Controller
{
    // public function __construct(
    //     UserRightService $userrightService
    // ) {
    //     $this->userrightService = $userrightService;
    // }
    public function index()
    {
        // $rolesPermissions = $this->userrightService->hasPermissions("DeptOfficers");
        // if (!$rolesPermissions['view']) {
        //     abort(401);
        // }
        $deptofficers = DeptOfficer::orderBy('transmittal_no', 'asc')->get();
        $deptofficers = json_encode($deptofficers);
        return view('deptofficer.index', compact('deptofficers'));
    }

    public function getDeptOfficers()
    {
        $deptofficers = DeptOfficer::where('active', 1)->get();

        return $deptofficers;
    }    

    public function deptofficersList(DeptOfficer $deptofficer)
    {
        $deptofficers = $deptofficer->where('active', 1)->get();
        return $deptofficers;
    }
}
