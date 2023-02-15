<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

     protected $fillable = [
       'id','role_name',
        
    ];

    public function permission($value)
    {
        return $this->belongsTo(Permission::class,'id','role_id')->where('module_name',$value);
    }


}
