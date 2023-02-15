<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    use HasFactory;
    
    protected $fillable = [
      'id', 'role_id', 'user_id', 'commission',
    ];

      public function role()
    {
        return $this->belongsTo(Role::class,'role_id','id');
    }
}
