<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleModel extends Model
{
    use HasFactory;

    protected $table = 'roles';
    protected $fillable = ['name', 'company_id', 'soft_delete'];

    public function company()
    {
        return $this->belongsTo(CompanyModel::class);
    }
}
