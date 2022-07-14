<?php

namespace App\Http\Controllers;

use App\Models\TransmittalItem;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class TransmittalItemController extends Controller
{
    public function uploadItems(Request $request)
    {
        $request->validate(['itemFile' => "required|mimes:csv,txt"]);

        try {
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
            if (($open = fopen(storage_path() . "/app/public/items files/" . $filenametostore, "r")) !== FALSE) {

                while (($data = fgetcsv($open, 1000, ",")) !== FALSE) {
                    $count++;
                    if ($count == 1) {
                        continue;
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
            return response()->json(['error' =>  $e->getMessage()], 500);
        }
    }
    public function getItems(Request $request)
    {
        $items = TransmittalItem::where([['username', auth()->user()->username], ['isdeleted', 0], ['transmittalno', $request->transmittalno]])->get();
        return  $items;
    }
    public function store(Request $request)
    {
        $request->validate([
            'sampleno' => 'required',
            'description' => 'required',
            'elements' => 'required',
            'methodcode' => 'required',
            'comments' => 'required',
            'transmittalno' => 'required'
        ]);
        try {
            TransmittalItem::create([
                'sampleno' => $request->sampleno,
                'description' => $request->description,
                'elements' => $request->elements,
                'methodcode' =>  $request->methodcode,
                'comments'    => $request->comments,
                'transmittalno' => $request->transmittalno,
                'username' => auth()->user()->username,
            ]);
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
                'deleted_at' => Carbon::now()
            ];
            $item->update($data);
            return response()->json('success');
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage(), 500]);
        }
    }
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'sampleno' => 'required',
            'description' => 'required',
            'elements' => 'required',
            'methodcode' => 'required',
            'comments' => 'required',
            'transmittalno' => 'required'
        ]);
        try {
            $item = TransmittalItem::find($request->id);

            $data = [
                'sampleno' => $request->sampleno,
                'description' => $request->description,
                'elements' => $request->elements,
                'methodcode' =>  $request->methodcode,
                'comments'    => $request->comments,
                'transmittalno' => $request->transmittalno,
                'username' => auth()->user()->username,
                'samplewtvolume' => $request->samplewtvolume,
            ];
            $item->update($data);
            return response()->json('success');
        } catch (Exception $e) {
            return response()->json(['error' =>  $e->getMessage()], 500);
        }
    }
}
