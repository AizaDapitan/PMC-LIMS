<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransmittalItem extends Model
{
    protected $fillable = [
        'sampleno', 'description', 'elements', 'methodcode', 'comments', 'isdeleted', 'transmittalno',
        'username', 'deleted_at','samplewtvolume','labbatch','reassayed','reaasyedby','source','updatedby','deletedby','receiveby',
        'samplewtgrams','fluxg','flourg','niterg','leadg','silicang','crusibleused','assayedby','assayed_at','isAssayed'
    ];
}
