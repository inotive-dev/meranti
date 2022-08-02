<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingJobRequest extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function r_setting_job_request_parent()
    {
        return $this->belongsTo('App\Models\SettingJobRequest', 'setting_job_request_id');
    }

    public function r_setting_job_request_childs()
    {
        return $this->hasMany('App\Models\SettingJobRequest', 'setting_job_request_id');
    }
}
