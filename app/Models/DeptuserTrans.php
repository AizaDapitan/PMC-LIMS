<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

// use OwenIt\Auditing\Contracts\Auditable  as AuditableContract;
// use OwenIt\Auditing\Auditable;

class DeptuserTrans extends Model //implements AuditableContract
{

    // use Auditable;


    protected $guarded = [];

    protected $fillable = [
        'transmittalno', 'purpose', 'datesubmitted', 'timesubmitted', 'date_needed', 'priority',
        'status', 'email_address', 'source', 'cocFile', 'csvFile', 'isdeleted','deleted_at','approvedDate','approver',
        'isReceived','receiver','received_date'
    ];
    protected $auditInclude = [
        'transmittalno', 'purpose', 'datesubmitted', 'timesubmitted', 'date_needed', 'priority',
        'status', 'email_address', 'source', 'cocFile', 'csvFile', 'isdeleted','deleted_at','approvedDate','approver',
        'isReceived','receiver','received_date'
    ];
    protected $appends = ['coc_path'];

    public function getCocPathAttribute()
    {
        $cocFile = $this->cocFile;

        $cocPath = asset(Storage::url('//coc Files//'.$cocFile));
        return $cocPath;
    }
}
