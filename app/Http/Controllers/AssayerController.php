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
        $transmittals = DeptuserTrans::where([['isdeleted', 0], ['isReceived', 1]])->orderBy('created_at', 'asc')->get();
        $transnos = [];
        foreach ($transmittals as $transmittal) {
            $count = 0;
            $count = TransmittalItem::where([['isdeleted', 0], ['transmittalno', $transmittal->transmittalno], ['isAssayed', 0]])->count();

            if ($count > 0) {
                $transno = $transmittal->transmittalno;
                array_push($transnos, $transmittal->transmittalno);
            }
        }
        $transmittals = $transmittals->whereIn('transmittalno', $transnos)->values();

        return $transmittals;
    }
    public function view($id)
    {
        $transmittal = DeptuserTrans::where('id', $id)->first();
        return view('assayer.view', compact('transmittal'));
    }
    public function create($id)
    {
        $transids = $id;
        $ids = explode(',', $transids);
        $transmittal = DeptuserTrans::whereIn('transmittalno', $ids)->first();
        return view('assayer.create', compact('transids', 'transmittal'));
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
            'transType' => 'required'
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
                'transType' => $request->transType,
                'createdby' => auth()->user()->username
            ];

            Worksheet::create($data);
            $transids = explode(',', $request->ids);
            // $itemsId = TransmittalItem::whereIn('transmittalno', $transids)->where('reassayed', 0)->get('id')->toArray();
            $itemdata = [
                'labbatch' => $request->labbatch,
                'isAssayed' => 1,
                'assayedby' => auth()->user()->username,
                'assayed_at' => Carbon::now(),
            ];
            $itemIds = explode(",", $request->itemIds);
            TransmittalItem::whereIn('id', $itemIds)->update($itemdata);
            // DeptuserTrans::whereIn('transmittalno', $transids)->update(['isAssayed' => 1, 'assayedby' =>  auth()->user()->username]);
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
        $items = TransmittalItem::whereIn('transmittalno', $transids)->where('isAssayed', 0)->Orwhere('labbatch', $labbatch)->get();
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
            'transType' => 'required',
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
                'transType' => $request->transType,
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
    public function checkBatchNo(Request $request)
    {
        $worksheet = Worksheet::where('labbatch', $request->labbatch)->get();
        return $worksheet;
    }
    public function getItemList(Request $request)
    {
        $trans_nos = DeptuserTrans::where([['isReceived', true], ['isdeleted', 0],['transType',$request->transType]])->get('transmittalno')->toArray();
        $forAssayer = 0;
        $transids = [];
        foreach ($trans_nos as $trans_no) {
            $items = TransmittalItem::where([['transmittalno', $trans_no['transmittalno']], ['isAssayed', 0]])->get();
            if (count($items) > 0) {
                $count = 0;
                foreach ($items as $item) {
                    if ($item->samplewtvolume == null || $item->samplewtvolume == '') {
                        $count += 1;
                    }
                }
                if ($count == 0) {
                    // dd($trans_no["transmittalno"]);
                    array_push($transids, $trans_no["transmittalno"]);
                }
            }
        }
        $labbatch = $request->labbatch;
        $itemsList = TransmittalItem::whereIn('transmittalno', $transids)->where('isAssayed', 0)->get();
        $itemsList = $itemsList->WhereNull('labbatch')->values();
        return  $itemsList;
    }
    public function addSample(Request $request)
    {
        $itemdata = [
            'labbatch' => $request->labbatch,
            'isAssayed' => 1,
            'assayedby' => auth()->user()->username,
            'assayed_at' => Carbon::now(),
        ];
        $itemIds = explode(",", $request->itemIds);
        TransmittalItem::whereIn('id', $itemIds)->update($itemdata);
        return response()->json('success');
    }
    public function excludeSample(Request $request)
    {
        $request->validate(['id' => 'required']);
        try {
            $item = TransmittalItem::find($request->id);
            $data = [
                'labbatch' => NULL,
                'isAssayed' => 0,
                'assayedby' => NULL,
            ];
            $item->update($data);
            return response()->json('success');
        } catch (Exception $e) {
            return response()->json(['errors' => $e->getMessage(), 500]);
        }
    }
}
