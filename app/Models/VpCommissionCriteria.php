<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VpCommissionCriteria extends Model
{
    use HasFactory;
    protected $fillable = [
   'id', 'from_net_margin', 'to_net_margin', 'percent',
   ];
}
