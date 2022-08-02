<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobRequest extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];
    
    public function project()
    {
        return $this->belongsTo('App\Models\Project');
    }
    
    public function quotations()
    {
        return $this->hasMany('App\Models\Quotation');
    }
    
    public function job_request_items()
    {
        return $this->hasMany('App\Models\JobRequestItem');
    }
    
    public function create_user()
    {
        return $this->belongsTo('App\Models\User', 'created_user_id', 'id');
    }
    
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
