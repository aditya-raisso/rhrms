<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;

    protected $table= "leaves";

    protected $fillable=['create_by','leave_type','leave_name'];

    function createBy(){
      return $this->belongsTo(User::class,'create_by','id');

    }

     
}
