<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
// use OwenIt\Auditing\Contracts\Auditable  as AuditableContract;
// use OwenIt\Auditing\Auditable;

class Role extends Model //implements AuditableContract
{

    // use Auditable;


	protected $guarded = [];

    protected $fillable = [
        'name', 
        'description', 
        'active',
    ];
    protected $auditInclude = [
        'name', 
        'description', 
        'active',
    ];
    protected $appends = ['status'];

    public function getStatusAttribute()
    {
        $status = 'Active';
        if($this->active != 1){
            $status  = 'Inactive';
        }
        return $status;
    }    
}