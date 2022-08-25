<?php

namespace App\Http\Controllers;

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
        return view('digester.view', compact('worksheet'));
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
}
