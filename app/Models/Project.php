<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];
    
    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }
    
    public function job_requests()
    {
        return $this->hasMany('App\Models\JobRequest');
    }
    
    public function job_request_approved_quotations()
    {
        return $this->hasMany('App\Models\JobRequest')->whereHas('quotations', function($q){
            $q->where('verification', '1');
        });
    }
    
    public function approved_job_requests()
    {
        return $this->hasMany('App\Models\JobRequest')->whereHas('job_request_items', function($q){
            $q->where('verification', '1');
        });
    }
    
    public function approved_client_quotations()
    {
        return $this->hasMany('App\Models\JobRequest')->whereHas('job_request_items', function($q){
            $q->where('remarks', '1');
        });
    }
}
