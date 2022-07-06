<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transmittal extends Model
{
    protected $fillable = ['transmittalno','purpose','datesubmitted','timesubmitted','dateneeded','priority',
    'status','email_add','source','coc_path','created_by'];
}
