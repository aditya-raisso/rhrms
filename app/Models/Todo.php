<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

   protected $fillable = [
    'create_by','user_id','comment',
   ];
    
    function createBy(){
      return $this->belongsTo(User::class,'create_by','id');

    }

     function userBy(){
      return $this->belongsTo(User::class,'user_id','id');

    }

  
   
}
