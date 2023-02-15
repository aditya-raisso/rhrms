<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class WorkingHour extends Model
{
    use HasFactory;
     protected $fillable = [
    'id', 'user_id', 'working_hours','start_date','end_date',
   ];

   
      public function user()
      {
          return $this->belongsTo('App\Models\User','user_id','id');
      }

        

}
