<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuotationItem extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];
    
    public function quotation_item_parent()
    {
        return $this->belongsTo('App\Models\QuotationItem', 'quotation_item_id', 'id');
    }
    
    public function quotation_item_childs()
    {
        return $this->hasMany('App\Models\QuotationItem', 'quotation_item_id', 'id');
    }
    
    public function job_request_item()
    {
        return $this->belongsTo('App\Models\JobRequestItem', 'job_request_item_id', 'id');
    }
}
