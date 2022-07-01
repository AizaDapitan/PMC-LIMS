<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\Models\DeptUser;
use App\Services\UserRightService;
use Exception;
use Illuminate\Support\Facades\Session;

class DeptUserController extends Controller
{
    // public function __construct(
    //     UserRightService $userrightService
    // ) {
    //     $this->userrightService = $userrightService;
    // }
    public function index()
    {
        // $rolesPermissions = $this->userrightService->hasPermissions("DeptUsers");
        // if (!$rolesPermissions['view']) {
        //     abort(401);
        // }
        $deptusers = DeptUser::orderBy('transmittal_no', 'asc')->get();
        $deptusers = json_encode($deptusers);
        return view('deptuser.index', compact('deptusers'));
    }

    public function getDeptUsers()
    {
        $deptusers = DeptUser::where('active', 1)->get();

        return $deptusers;
    }    

    public function deptusersList(DeptUser $deptuser)
    {
        $deptusers = $deptuser->where('active', 1)->get();
        return $deptusers;
    }
}
