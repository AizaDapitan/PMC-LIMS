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
        'status', 'email_address', 'source', 'cocFile', 'csvFile', 'isdeleted', 'deleted_at', 'approvedDate', 'approver',
        'isReceived', 'receiver', 'received_date', 'isSaved', 'created_by', 'transType', 'assayedby', 'transcode'
    ];
    protected $auditInclude = [
        'transmittalno', 'purpose', 'datesubmitted', 'timesubmitted', 'date_needed', 'priority',
        'status', 'email_address', 'source', 'cocFile', 'csvFile', 'isdeleted', 'deleted_at', 'approvedDate', 'approver',
        'isReceived', 'receiver', 'received_date', 'isSaved', 'created_by', 'transType', 'assayedby', 'transcode'
    ];
    protected $appends = ['coc_path', 'statuses', 'isupdated', 'isEditable'];

    public function getCocPathAttribute()
    {
        $cocFile = $this->cocFile;

        $cocPath = asset(Storage::url('//coc Files//' . $cocFile));
        return $cocPath;
    }
    public function getStatusesAttribute()
    {
        $statuses = "Pending";
        if ($this->isReceived) {
            $statuses = 'Received';
        } else if ($this->status == 'Approved') {
            $statuses = 'Approved';
        };
        return $statuses;
    }
    public function getIsupdatedAttribute()
    {
        if ($this->transType != 'Solutions') {
            $items = TransmittalItem::where('transmittalno', $this->transmittalno)->get();
            if (count($items) > 0) {
                $count = 0;
                foreach ($items as $item) {

                    if ($item->samplewtvolume == null || $item->samplewtvolume == '') {
                        $count += 1;
                    }
                }
                if ($count > 0) {
                    return false;
                }
                return true;
            }
            return false;
        } else {
            return true;
        }
    }
    public function getIsEditableAttribute()
    {
        if ($this->isReceived) {
            $items = TransmittalItem::where('transmittalno', $this->transmittalno)->get();
            if (count($items) > 0) {
                $count = 0;
                foreach ($items as $item) {
                    if ($item->isAssayed == 0) {
                        $count += 1;
                    }
                }
                if ($count > 0) {
                    return true;
                }
                return false;
            }
            return true;
        }
        return false;
    }
}
