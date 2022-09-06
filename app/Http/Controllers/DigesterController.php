<?php

namespace App\Http\Controllers;

use App\Models\DeptuserTrans;
use App\Models\TransmittalItem;
use App\Models\Worksheet;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class DigesterController extends Controller
{
    public function index()
    {
        return view('digester.index');
    }
    public function viewWorksheet($id)
    {
        $worksheet = Worksheet::where('id', $id)->first();
        $forapproval = 1;
        // dd(TransmittalItem::where('labbatch', $worksheet->labbatch)->where(function ($q) {
        //     return $q->orWhereNull('samplewtgrams')
        //         ->orWhereNull('fluxg')
        //         ->orWhereNull('flourg')
        //         ->orWhereNull('niterg')
        //         ->orWhereNull('leadg')
        //         ->orWhereNull('silicang')
        //         ->orWhereNull('crusibleused');
        // })->toSql());
        $items = TransmittalItem::where('labbatch', $worksheet->labbatch)->where(function ($q) {
            return $q->orWhereNull('samplewtgrams')
                ->orWhereNull('fluxg')
                ->orWhereNull('flourg')
                ->orWhereNull('niterg')
                ->orWhereNull('leadg')
                ->orWhereNull('silicang')
                ->orWhereNull('crusibleused');
        })->get();
        if (count($items) > 0) {
            $forapproval = 0;
        }

        return view('digester.view', compact('forapproval', 'worksheet'));
    }
    public function approve(Request $request)
    {
        $request->validate(['id' => 'required']);
        try {
            $worksheet = Worksheet::find($request->id);

            $data = [
                'isApproved' => 1,
                'approved_at' => Carbon::now(),
                'approvedby' => auth()->user()->username,
            ];
            $worksheet->update($data);
            return response()->json('success');
        } catch (Exception $e) {
            return response()->json(['errors' => $e->getMessage(), 500]);
        }
    }
    public function getWorksheet()
    {
        $worksheet = Worksheet::where('isdeleted', 0)->orderBy('created_at', 'desc')->get();
        return $worksheet;
    }
    public function transmittal()
    {
        return view('digester.transmittal');
    }
    public function getTransmittal()
    {
        // dd(DeptuserTrans::where([['isdeleted', 0],['status','Approved'],['transcode',1],['transType','Solid']])
        // ->orderBy('transmittalno', 'asc')->toSql());
        $transmittal = DeptuserTrans::where([['isdeleted', 0], ['status', 'Approved'], ['transcode', 1], ['transType', 'Solids']])
            ->orderBy('transmittalno', 'asc')->get();

        return $transmittal;
    }
    public function edit($id)
    {
        $transmittal = DeptuserTrans::where('id', $id)->first();
        return view('digester.edit', compact('transmittal'));
    }
    public function getItems(Request $request)
    {
        $items = TransmittalItem::where([['isdeleted', 0], ['transmittalno', $request->transmittalno], ['isAssayed', 0]])->get();
        return  $items;
    }

    public function view($id)
    {
        $transmittal = DeptuserTrans::where('id', $id)->first();
        return view('digester.view_transmittal', compact('transmittal'));
    }
    public function receive($id)
    {
        $transmittal = DeptuserTrans::where('id', $id)->first();
        return view('digester.receive', compact('transmittal'));
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
}
