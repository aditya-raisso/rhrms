<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Attendance extends Model
{ 

        protected $fillable = [
        'id','user_id', 'punch_in', 'punch_out', 'ip', 'location', 
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

  public function user(){
          return $this->belongsTo(User::class,'user_id','id');

    }
 
}
