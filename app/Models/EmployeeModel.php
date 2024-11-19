<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeModel extends Model
{
    use HasFactory;
    
    protected $table = 'employees'; 
    protected $fillable = ['name', 'phone_number', 'address', 'company_id', 'soft_delete'];

    public function company()
    {
        return $this->belongsTo(CompanyModel::class);
    }
}