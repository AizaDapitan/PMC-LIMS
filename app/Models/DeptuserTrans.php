<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use OwenIt\Auditing\Contracts\Auditable  as AuditableContract;
// use OwenIt\Auditing\Auditable;

class DeptuserTrans extends Model //implements AuditableContract
{

    // use Auditable;


    protected $guarded = [];

    protected $fillable = [
        'transmittalno', 'purpose', 'datesubmitted', 'timesubmitted', 'date_needed', 'priority',
        'status', 'email_address', 'source', 'cocFile', 'isdeleted','deleted_at'
    ];
    protected $auditInclude = [
        'transmittalno', 'purpose', 'datesubmitted', 'timesubmitted', 'date_needed', 'priority',
        'status', 'email_address', 'source', 'cocFile', 'isdeleted','deleted_at'
    ];
}
