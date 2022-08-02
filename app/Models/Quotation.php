<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];
    
    public function job_request()
    {
        return $this->belongsTo('App\Models\JobRequest');
    }
    
    public function quotation_items()
    {
        return $this->hasMany('App\Models\QuotationItem');
    }
}
