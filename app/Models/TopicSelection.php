<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopicSelection extends Model
{
    protected $table = 'topic_selections'; 

    protected $fillable = [ 
        'id',
        'Name',
        'Project_ID',
        'Project_Name',
        'Quota',
        'CS_Academic',
        'Contact_email',
        'Rank',
        'Contacted_with_advisor',
        'Allocated',
    ];
    protected $casts = [
        'Project_ID' => 'string', 
        'contacted_with_supervisor' => 'string',
    ];
    protected $primaryKey = 'id'; 
    public $incrementing = false; 
    
    public function users()
{
    return $this->belongsToMany(User::class);
}

public function topicDatas()
{
    return $this->belongsToMany(TopicData::class);
}

}
