<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $table = 'tbl_project';
    protected $fillable = ['name', 'projectdescription', 'customer_id', 'created_by', 'updated_by'];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function projectCosts()
    {
        return $this->hasMany(ProjectCost::class, 'project_id');
    }
}
