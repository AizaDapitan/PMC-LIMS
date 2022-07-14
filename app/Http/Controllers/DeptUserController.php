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
        return view('deptuser.index');
    }

    public function getDeptUsers()
    {
        $deptusers = DeptuserTrans::where('isdeleted', 0)->orderBy('transmittalno', 'asc')->get();

        return $deptusers;
    }

    public function deptusersList(DeptuserTrans $deptuser)
    {
        $deptusers = $deptuser->where('active', 1)->get();
        return $deptusers;
    }
    public function create()
    {
        // $items = TransmittalItem::where([['username', auth()->user()->username], ['isdeleted', 0]])->get();

        return view('deptuser.create');
    }
    public function store(DeptUserTransRequest $request)
    {
        try {
            $filenamewithextension = $request->file('cocFile')->getClientOriginalName();
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $extension = $request->file('cocFile')->getClientOriginalExtension();

            //filename to store
            $filenametostore = $filename . '_' . $request->transmittalno .  '.' . $extension;

            $request->file('cocFile')->storeAs(('public/coc files/'), $filenametostore);
            DeptuserTrans::create([
                'transmittalno' => $request->transmittalno,
                'purpose' => $request->purpose,
                'datesubmitted' =>  $request->datesubmitted,
                'timesubmitted' =>   $request->timesubmitted,
                'date_needed'    =>  $request->date_needed,
                'priority' => $request->priority,
                'status' =>  $request->status,
                'email_address' => $request->email_address,
                'source' =>  $request->source,
                'cocFile' => $filenametostore,
                'status' =>  $request->status,
                'created_by' => auth()->user()->username
            ]);
            return response()->json('success');
        } catch (Exception $e) {
            return response()->json(['error' =>  $e->getMessage()], 500);
        }
    }
    public function edit($id)
    {
        $transmittal = DeptuserTrans::where('id', $id)->first();
        // dd($transmittal);
        return view('deptuser.edit', compact('transmittal'));
    }
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'transmittalno' => 'required',
            'purpose' => 'required',
            'datesubmitted' => 'required',
            'timesubmitted' => 'required',
            'date_needed' => 'required',
            'priority' => 'required',
            'status' => 'required',
            'email_address' => 'required|email',
            'source' => 'required',
        ]);
        try {
            $filenametostore = $request->cocFile;
            if ($request->hasFile('cocFile')) {
                $filenamewithextension = $request->file('cocFile')->getClientOriginalName();
                $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
                $extension = $request->file('cocFile')->getClientOriginalExtension();

                //filename to store
                $filenametostore = $filename . '_' . $request->transmittalno .  '.' . $extension;

                $request->file('cocFile')->storeAs(('public/coc files/'), $filenametostore);
            }
            $deptuserTrans = DeptuserTrans::find($request->id);

            $data = [
                'transmittalno' => $request->transmittalno,
                'purpose' => $request->purpose,
                'datesubmitted' =>  $request->datesubmitted,
                'timesubmitted' =>   $request->timesubmitted,
                'date_needed'    =>  $request->date_needed,
                'priority' => $request->priority,
                'status' =>  $request->status,
                'email_address' => $request->email_address,
                'source' =>  $request->source,
                'cocFile' => $filenametostore,
                'status' =>  $request->status,
                'created_by' => auth()->user()->username
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
    public function view($id)
    {
        $transmittal = DeptuserTrans::where('id', $id)->first();
        return view('deptuser.view', compact('transmittal'));
    }
}
