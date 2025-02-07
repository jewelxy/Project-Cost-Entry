<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'tbl_customer';
    protected $fillable = ['name', 'phone', 'email', 'comapny', 'address', 'created_by', 'updated_by'];

    public function projects()
    {
        return $this->hasMany(Project::class, 'customer_id');
    }
}
