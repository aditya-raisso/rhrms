<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id','start_date','end_date','qualification','file','board_of_education',
     ];


      public function user()
      {
          return $this->belongsTo('App\Models\User','user_id','id');
      }
}
