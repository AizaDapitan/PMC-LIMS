<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;

class Worksheet extends Model
{
    protected $fillable = [
        'labbatch', 'dateshift', 'timeshift', 'fusionfurno', 'fusiontimefrom', 'fusiontimeto',
        'fusion', 'cupellationfurno', 'cupellationtimefrom', 'cupellationtimeto', 'cupellation', 'temperature', 'moldused', 'fireassayer', 'createdby',
        'isdeleted', 'deleted_at', 'updatedby', 'deleteby','isApproved','approvedby','approved_at','transType','dateweighed','shiftweighed','micnocheckweights',
        'measuredby','analyzedby','isAnalyzed'
    ];
    protected $auditInclude = [
        'labbatch', 'dateshift', 'timeshift', 'fusionfurno', 'fusiontimefrom', 'fusiontimeto',
        'fusion', 'cupellationfurno', 'cupellationtimefrom', 'cupellationtimeto', 'cupellation', 'temperature', 'moldused', 'fireassayer', 'createdby',
        'isdeleted', 'deleted_at', 'updatedby', 'deleteby','isApproved','approvedby','approved_at','transType','dateweighed','shiftweighed','micnocheckweights',
        'measuredby','analyzedby','isAnalyzed'
    ];
    protected $appends = ['fusion_furnace','cupellation_furnace','statuses'];

    public function getFusionFurnaceAttribute()
    {
        $from = new DateTime($this->fusiontimefrom);
        $from = $from->format('h:i A');
        $to = new DateTime($this->fusiontimeto);
        $to = $to->format('h:i A');
        $fusionFurnace = $this->fusionfurno . '-' . $from  . '-' . $to;
        return $fusionFurnace;
    }
    public function getCupellationFurnaceAttribute()
    {
        $from = new DateTime($this->cupellationtimefrom);
        $from = $from->format('h:i A');
        $to = new DateTime($this->cupellationtimeto);
        $to = $to->format('h:i A');
        $cupellationFurnace = $this->cupellationfurno . '-' . $from  . '-' . $to;
        return $cupellationFurnace;
    }
    public function getStatusesAttribute()
    {
        $statuses = "Pending";
        if ($this->isApproved) {
            $statuses = 'Approved';
        } 
        return $statuses;
    }
}
