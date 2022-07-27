<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeptUserTransRequest;
use App\Http\Requests\TransmittalRequest;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\Models\DeptuserTrans;
use App\Models\Transmittal;
use App\Models\TransmittalItem;
use App\Services\UserRightService;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
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
        return view('deptofficer.index');
    }

    public function getDeptOfficers()
    {
        $deptofficers = DeptuserTrans::where([['isdeleted', 0],['isSaved',1]])->orderBy('transmittalno', 'asc')->get();

        return $deptofficers;
    }

    public function deptofficersList(DeptuserTrans $deptofficer)
    {
        $deptofficers = $deptofficer->where('active', 1)->get();
        return $deptofficers;
    }

    public function edit($id)
    {
        $transmittal = DeptuserTrans::where('id', $id)->first();
        // dd($transmittal);
        return view('deptofficer.edit', compact('transmittal'));
    }

    public function view($id)
    {
        $transmittal = DeptuserTrans::where('id', $id)->first();
        // dd($transmittal);
        return view('deptofficer.view', compact('transmittal'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);
        try {
          
            $deptuserTrans = DeptuserTrans::find($request->id);

            $data = [
                'approvedDate' => Carbon::now(),
                'approver' => auth()->user()->username,
                'status' =>  $request->status,
            ];
            $deptuserTrans->update($data);

            return response()->json('success');
        } catch (Exception $e) {
            return response()->json(['error' =>  $e->getMessage()], 500);
        }
    }
    public function delete(Request $request)
    {
        $request->validate(['id' => 'required']);
        try {
            $item = DeptuserTrans::find($request->id);

            $data = [
                'isdeleted' => 1,
                'deleted_at' => Carbon::now()
            ];
            $item->update($data);
            return response()->json('success');
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage(), 500]);
        }
    }
}
