<?php

namespace App\Http\Controllers;

use App\Models\DeptuserTrans;
use App\Models\Transmittal;
use App\Models\TransmittalItem;
use App\Models\Worksheet;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class AssayerController extends Controller
{
    public function Index()
    {
        return view('assayer.index');
    }
    public function getTransmittal()
    {
        $transmittal = DeptuserTrans::where([['isdeleted', 0], ['isReceived', 1], ['isAssayed', 0]])->orderBy('created_at', 'asc')->get();
        return $transmittal;
    }
    public function view($id)
    {
        $transmittal = DeptuserTrans::where('id', $id)->first();
        return view('assayer.view', compact('transmittal'));
    }
    public function create($id)
    {
        $transids = $id;
        return view('assayer.create', compact('transids'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'labbatch' => 'required',
            'dateshift' => 'required',
            'timeshift' => 'required',
            'fusionfurno' => 'required',
            'fusiontimefrom' => 'required',
            'fusiontimeto' => 'required',
            'fusion' => 'required',
            'cupellationfurno' => 'required',
            'cupellationtimefrom' => 'required',
            'cupellationtimeto' => 'required',
            'cupellation' => 'required',
            'temperature' => 'required',
            'moldused' => 'required',
            'fireassayer' => 'required',
        ]);
        try {
            $data = [
                'labbatch' => $request->labbatch,
                'dateshift' => $request->dateshift,
                'timeshift' => $request->timeshift,
                'fusionfurno' => $request->fusionfurno,
                'fusiontimefrom' => $request->fusiontimefrom,
                'fusiontimeto' => $request->fusiontimeto,
                'fusion' => $request->fusion,
                'cupellationfurno' => $request->cupellationfurno,
                'cupellationtimefrom' => $request->cupellationtimefrom,
                'cupellationtimeto' => $request->cupellationtimeto,
                'cupellation' => $request->cupellation,
                'temperature' => $request->temperature,
                'moldused' => $request->moldused,
                'fireassayer' => $request->fireassayer,
                'createdby' => auth()->user()->username
            ];

            Worksheet::create($data);
            $transids = explode(',', $request->ids);
            $itemsId = TransmittalItem::whereIn('transmittalno', $transids)->where('reassayed', 0)->get('id')->toArray();
            // dd($itemsId);
            TransmittalItem::whereIn('id', $itemsId)->update(['labbatch' => $request->labbatch]);
            DeptuserTrans::whereIn('transmittalno', $transids)->update(['isAssayed' => 1, 'assayedby' =>  auth()->user()->username]);
            // dd($itemsId);
            return response()->json('success');
        } catch (Exception $e) {
            return response()->json(['errors' =>  $e->getMessage()], 500);
        }
    }
    public function getItems(Request $request)
    {
        $labbatch = $request->labbatch;
        if ($labbatch == "") {
            $labbatch = "0";
        }

        $transids = explode(',', $request->ids);
        $items = TransmittalItem::whereIn('transmittalno', $transids)->Orwhere('labbatch', $labbatch)->get();
        return  $items;
    }
    public function worksheet()
    {
        return view('assayer.worksheet');
    }
    public function getWorksheet()
    {
        $worksheet = Worksheet::where('isdeleted', 0)->orderBy('created_at', 'desc')->get();
        return $worksheet;
    }
    public function Edit($id)
    {
        $worksheet = Worksheet::where('id', $id)->first();
        return view('assayer.edit', compact('worksheet'));
    }
    public function getWorksheetItems(Request $request)
    {
        // $transids = explode(',', $request->ids);
        $items = TransmittalItem::where('labbatch', $request->labbatch)->get();
        return  $items;
    }
    public function update(Request $request)
    {
        $request->validate([
            'id'    => 'required',
            'labbatch' => 'required',
            'dateshift' => 'required',
            'timeshift' => 'required',
            'fusionfurno' => 'required',
            'fusiontimefrom' => 'required',
            'fusiontimeto' => 'required',
            'fusion' => 'required',
            'cupellationfurno' => 'required',
            'cupellationtimefrom' => 'required',
            'cupellationtimeto' => 'required',
            'cupellation' => 'required',
            'temperature' => 'required',
            'moldused' => 'required',
            'fireassayer' => 'required',
        ]);
        try {
            $worksheet = Worksheet::find($request->id);
            $data = [
                'labbatch' => $request->labbatch,
                'dateshift' => $request->dateshift,
                'timeshift' => $request->timeshift,
                'fusionfurno' => $request->fusionfurno,
                'fusiontimefrom' => $request->fusiontimefrom,
                'fusiontimeto' => $request->fusiontimeto,
                'fusion' => $request->fusion,
                'cupellationfurno' => $request->cupellationfurno,
                'cupellationtimefrom' => $request->cupellationtimefrom,
                'cupellationtimeto' => $request->cupellationtimeto,
                'cupellation' => $request->cupellation,
                'temperature' => $request->temperature,
                'moldused' => $request->moldused,
                'fireassayer' => $request->fireassayer,
                'createdby' => auth()->user()->username
            ];

            $worksheet->update($data);
            return response()->json('success');
        } catch (Exception $e) {
            return response()->json(['errors' =>  $e->getMessage()], 500);
        }
    }
    public function viewWorksheet($id)
    {
        $worksheet = Worksheet::where('id', $id)->first();
        return view('assayer.viewworksheet', compact('worksheet'));
    }
    public function delete(Request $request)
    {
        $request->validate(['id' => 'required']);
        try {
            $worksheet = Worksheet::find($request->id);

            $data = [
                'isdeleted' => 1,
                'deleted_at' => Carbon::now(),
                'deleteby' => auth()->user()->username,
            ];
            $worksheet->update($data);
            return response()->json('success');
        } catch (Exception $e) {
            return response()->json(['errors' => $e->getMessage(), 500]);
        }
    }
}
