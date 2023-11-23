<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use App\Models\Series;

class TopicData extends Model
{
    use HasFactory;
    protected $table = 'topic_data';
    protected $fillable = [
        'CS_Academic',
        'Project_ID',
        'Research_Area',
        'Project_Name',
        'Project_Detail',
        'Contact',
        'Suitable_for',
        'Associate_Supervisor',
        'Prerequisite',
        'Quota',
        'References',
        'Allocated',
        'hide',
    ];
    
    //protected $primaryKey = 'Project_ID';

    
}
