<?php

namespace App\Http\Controllers;

use App\Models\TransmittalItem;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransmittalItemController extends Controller
{
    public function uploadItems(Request $request)
    {
        $request->validate(['itemFile' => "required|mimes:csv,txt"]);

        try {
            $item = TransmittalItem::where('transmittalno', $request->transmittalno);

            $data = [
                'isdeleted' => 1,
                'deleted_at' => Carbon::now()
            ];
            $item->update($data);

            $filenamewithextension = $request->file('itemFile')->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = $request->file('itemFile')->getClientOriginalExtension();

            //filename to store
            $filenametostore = $filename . '_' . $request->transmittalno . '_' . auth()->user()->id . '.' . $extension;

            $request->file('itemFile')->storeAs(('public/items files/'), $filenametostore);

            $items = [];

            $count = 0;

            $requiredHeaders = array('Sample No', 'description', 'elements', 'method code', 'comments'); //headers we expect

            if (($open = fopen(storage_path() . "/app/public/items files/" . $filenametostore, "r")) !== FALSE) {

                $firstLine = fgets($open); //get first line of csv file

                $foundHeaders = str_getcsv(trim($firstLine), ',', '"'); //parse to array

                if ($foundHeaders !== $requiredHeaders) {
                    fclose($open);
                    $error =   ['Uploading Item' => ['Headers do not match: '  . implode(', ', $foundHeaders)]];
                    return response()->json(['errors' => $error], 500);
                }

                while (($data = fgetcsv($open, 1000, ",")) !== FALSE) {
                    $count++;
                    if ($count == 1) {
                        continue;
                    }
                    $row = $count;

                    $validator = Validator::make(
                        [
                            'sampleno' => $data[0],
                            'description' => $data[1],
                            'elements' => $data[2],
                            'methodcode' => $data[3],
                        ],
                        [
                            'sampleno' => 'required',
                            'description' => 'required',
                            'elements' => 'required',
                            'methodcode' => 'required',
                        ],
                        [
                            'sampleno.required' => 'Uploading Item: sampleno is required! Check csv file row # ' . $row,
                            'description.required' => 'Uploading Item: description is required! Check csv file row # ' . $row,
                            'elements.required' => 'Uploading Item: elements is required! Check csv file row # ' . $row,
                            'methodcode.required' => 'Uploading Item: methodcode is required! Check csv file row # ' . $row,
                        ]
                    );
                    // dd($validator->errors());
                    if ($validator->fails()) {
                        fclose($open);
                        return response()->json(['errors' => $validator->errors()], 500);
                    }
                    $items[] = $data;
                }

                fclose($open);
            }
            foreach ($items as $item) {
                TransmittalItem::create([
                    'sampleno' => $item[0],
                    'description' => $item[1],
                    'elements' => $item[2],
                    'methodcode' =>  $item[3],
                    'comments'    => $item[4],
                    'transmittalno' => $request->transmittalno,
                    'username' => auth()->user()->username,
                ]);
            }
            return response()->json('success');
        } catch (Exception $e) {
            return response()->json(['errors' =>  $e->getMessage()], 500);
        }
    }
    public function getItems(Request $request)
    {
        $items = TransmittalItem::where([['isdeleted', 0], ['transmittalno', $request->transmittalno]])->get();
        return  $items;
    }
    public function store(Request $request)
    {
        if ($request->isAssayer) {
            $request->validate([
                'sampleno' => 'required',
                'samplewtgrams' => 'required',
                'fluxg' => 'required',
                'flourg' => 'required',
                'niterg' => 'required',
                'leadg' => 'required',
                'silicang' => 'required',
                'crusibleused' => 'required'
            ]);
        } else {
            $request->validate([
                'sampleno' => 'required',
                'description' => 'required',
                'elements' => 'required',
                'methodcode' => 'required',
                'transmittalno' => 'required'
            ]);
        }
        try {
            if ($request->isAssayer) {
                TransmittalItem::create([
                    'sampleno' => $request->sampleno,
                    'samplewtgrams' => $request->samplewtgrams,
                    'fluxg' => $request->fluxg,
                    'flourg' =>  $request->flourg,
                    'niterg' => $request->niterg,
                    'leadg' => $request->leadg,
                    'silicang' => $request->silicang,
                    'crusibleused' => $request->crusibleused,
                    'labbatch' => $request->labbatch,
                    'assayedby' => auth()->user()->username,
                    'assayed_at' => Carbon::now(),
                ]);
            } else {
                TransmittalItem::create([
                    'sampleno' => $request->sampleno,
                    'description' => $request->description,
                    'elements' => $request->elements,
                    'methodcode' =>  $request->methodcode,
                    'transmittalno' => $request->transmittalno,
                    'comments' => $request->comments,
                    'username' => auth()->user()->username,
                    'source'    => $request->source,
                ]);
            }

            return response()->json('success');
        } catch (Exception $e) {
            return response()->json(['error' =>  $e->getMessage()], 500);
        }
    }
    public function delete(Request $request)
    {
        $request->validate(['id' => 'required']);
        try {
            $item = TransmittalItem::find($request->id);

            $data = [
                'isdeleted' => 1,
                'deleted_at' => Carbon::now(),
                'deletedby' => auth()->user()->username
            ];
            $item->update($data);
            return response()->json('success');
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage(), 500]);
        }
    }
    public function update(Request $request)
    {

        if ($request->isAssayer) {
            $request->validate([
                'id' => 'required',
                'sampleno' => 'required',
                'samplewtgrams' => 'required',
                'fluxg' => 'required',
                'flourg' => 'required',
                'niterg' => 'required',
                'leadg' => 'required',
                'silicang' => 'required',
                'crusibleused' => 'required'
            ]);
        } else {
            $request->validate([
                'id' => 'required',
                'sampleno' => 'required',
                'description' => 'required',
                'elements' => 'required',
                'methodcode' => 'required',
                'transmittalno' => 'required'
            ]);
        }
        try {
            $item = TransmittalItem::find($request->id);
            $receiver = "";
            if ($request->receiving) {
                $receiver = auth()->user()->username;
            }
            if ($request->isAssayer) {
                $data = [
                    'sampleno' => $request->sampleno,
                    'samplewtgrams' => $request->samplewtgrams,
                    'fluxg' => $request->fluxg,
                    'flourg' => $request->flourg,
                    'niterg' =>  $request->niterg,
                    'leadg' => $request->leadg,
                    'silicang' => $request->silicang,
                    'crusibleused'    => $request->crusibleused,
                    'updatedby' => auth()->user()->username,
                    'assayedby'  =>  auth()->user()->username,
                    'assayed_at' => Carbon::now(),
                ];
            } else {
                $data = [
                    'sampleno' => $request->sampleno,
                    'description' => $request->description,
                    'elements' => $request->elements,
                    'comments' => $request->comments,
                    'methodcode' =>  $request->methodcode,
                    'transmittalno' => $request->transmittalno,
                    'samplewtvolume' => $request->samplewtvolume,
                    'source'    => $request->source,
                    'updatedby' => auth()->user()->username,
                    'receiveby'  => $receiver
                ];
            }
            $item->update($data);
            return response()->json('success');
        } catch (Exception $e) {
            return response()->json(['error' =>  $e->getMessage()], 500);
        }
    }
    public function getWorksheetItems(Request $request)
    {
        $items = TransmittalItem::where('labbatch', $request->labbatch)->get();
        return  $items;
    }
}
