<?php

namespace App\Http\Controllers;

use App\Models\DeptuserTrans;
use App\Models\Worksheet;
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
}
