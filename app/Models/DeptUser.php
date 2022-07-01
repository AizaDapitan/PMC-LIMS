<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
// use OwenIt\Auditing\Contracts\Auditable  as AuditableContract;
// use OwenIt\Auditing\Auditable;

class DeptUser extends Model //implements AuditableContract
{

    // use Auditable;


	protected $guarded = [];

    protected $fillable = [
        'transmittal_no', 
        'date_time_submitted',
        'email_address',
        'purpose',
        'date_needed',
        'priority', 
        'source',
        'active',
    ];
    protected $auditInclude = [
        'transmittal_no', 
        'date_time_submitted',
        'email_address',
        'purpose',
        'date_needed',
        'priority', 
        'source',
        'active',
    ];
    protected $appends = ['status','priority_status'];

    public function getStatusAttribute()
    {
        $status = 'Active';
        if($this->active != 1){
            $status  = 'Inactive';
        }
        return $status;
    }    

    public function getPriorityStatusAttribute()
    {
        $priority_status = 'High';
        if($this->priority == 1)
        {
            $priority_status  = 'Hign';
        }
        else if($this->priority == 2)
        {
            $priority_status  = 'Medium';
        }
        else if($this->priority == 3)
        {
            $priority_status  = 'Low';
        }
        return $priority_status;
    }    

}