<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use App\Models\Series;

class AllocationResult extends Model
{
    use HasFactory;
    protected $table = 'allocation_result';
    protected $fillable = [
        'id',
        'Name',
        'Project_ID',
        'Project_Name',
        'CS_Academic',
        'Contact_Email',
        'Allocation_Operator_Id',
        'Allocation_Operator_Name',
        'Allocated',
    ];
    
    protected $primaryKey = 'id'; 

    
}
