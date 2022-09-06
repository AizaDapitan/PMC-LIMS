<?php

namespace App\Http\Controllers;

use App\Models\DeptuserTrans;
use App\Models\TransmittalItem;
use App\Models\Worksheet;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class AnalystController extends Controller
{
    public function index()
    {
        return view('analyst.index');
    }
    public function view($id)
    {
        $worksheet = Worksheet::where('id', $id)->first();
        return view('analyst.view', compact('worksheet'));
    }
    
    public function edit($id)
    {
        $worksheet = Worksheet::where('id', $id)->first();
        return view('analyst.edit', compact('worksheet'));
    }
    public function update(Request $request)
    {
        $request->validate([
            'id'    => 'required',
            'dateweighed'    => 'required',
            'shiftweighed'    => 'required',
            'micnocheckweights'    => 'required',
            'measuredby'    => 'required',
            'analyzedby'    => 'required',
        ]);
        try {
            $worksheet = Worksheet::find($request->id);
            $data = [
                'dateweighed' => $request->dateweighed,
                'shiftweighed' => $request->shiftweighed,
                'micnocheckweights' => $request->micnocheckweights,
                'measuredby' => $request->measuredby,
                'analyzedby' => $request->analyzedby,
            ];

            $worksheet->update($data);
            return response()->json('success');
        } catch (Exception $e) {
            return response()->json(['errors' =>  $e->getMessage()], 500);
        }
    }
    public function transmittal()
    {
        return view('analyst.transmittal');
    }
    public function getTransmittal()
    {
        $transmittal = DeptuserTrans::where([['isdeleted', 0], ['status', 'Approved'], ['transcode', 1], ['transType', 'Solutions']])
            ->orderBy('transmittalno', 'asc')->get();

        return $transmittal;
    }
    
    public function viewTransmittal($id)
    {
        $transmittal = DeptuserTrans::where('id', $id)->first();
        return view('analyst.view_transmittal', compact('transmittal'));
    }
    public function receive($id)
    {
        $transmittal = DeptuserTrans::where('id', $id)->first();
        return view('analyst.receive', compact('transmittal'));
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
    public function editTransmittal($id)
    {
        $transmittal = DeptuserTrans::where('id', $id)->first();
        return view('analyst.edit_transmittal', compact('transmittal'));
    }
    public function getItems(Request $request)
    {
        $items = TransmittalItem::where([['isdeleted', 0], ['transmittalno', $request->transmittalno], ['isAssayed', 0]])->get();
        return  $items;
    }
}
