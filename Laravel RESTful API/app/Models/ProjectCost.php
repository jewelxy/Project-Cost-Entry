<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectCost extends Model
{
    use HasFactory;
    protected $table = 'tbl_project_cost';
    protected $fillable = ['customer_id', 'project_id', 'cost', 'tracking_id', 'created_by', 'updated_by'];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
