<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobRequestItem extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];
    
    public function job_request_item_parent()
    {
        return $this->belongsTo('App\Models\JobRequestItem', 'job_request_item_id', 'id');
    }
    
    public function job_request_item_childs()
    {
        return $this->hasMany('App\Models\JobRequestItem', 'job_request_item_id', 'id');
    }
    
    public function approved_job_request_item_childs()
    {
        return $this->hasMany('App\Models\JobRequestItem', 'job_request_item_id', 'id')->where('verification', 1);
    }
    
    public function quotation_item()
    {
        return $this->hasOne('App\Models\QuotationItem', 'job_request_item_id', 'id');
    }
}
