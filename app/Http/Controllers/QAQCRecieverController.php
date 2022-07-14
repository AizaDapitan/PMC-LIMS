<?php

namespace App\Http\Controllers;

use App\Models\DeptuserTrans;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class QAQCRecieverController extends Controller
{
    public function Index()
    {
       return view('qaqcreceiver.index');
    }
    public function getTransmittal()
    {
        $transmittal = DeptuserTrans::where([['isdeleted', 0],['status','Approved']])->orderBy('transmittalno', 'asc')->get();

        return $transmittal;
    }
    public function view($id)
    {
        $transmittal = DeptuserTrans::where('id', $id)->first();
        return view('qaqcreceiver.view', compact('transmittal'));
    }
    public function receive($id)
    {
        $transmittal = DeptuserTrans::where('id', $id)->first();
        return view('qaqcreceiver.receive', compact('transmittal'));
    }
    public function receiveTransmittal(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);
        try {
          
            $deptuserTrans = DeptuserTrans::find($request->id);

            $data = [
                'received_date' => Carbon::now(),
                'receiver' => auth()->user()->username,
                'isReceived' =>  true,
            ];
            $deptuserTrans->update($data);

            return response()->json('success');
        } catch (Exception $e) {
            return response()->json(['error' =>  $e->getMessage()], 500);
        }
    }
    public function edit($id)
    {
        $transmittal = DeptuserTrans::where('id', $id)->first();
        return view('qaqcreceiver.edit', compact('transmittal'));
    }
}
