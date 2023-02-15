<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadComissionCriteria extends Model
{
    use HasFactory;

    
    protected $table="lead_comission_criterias";

    protected $fillable=[ 'from_net_margin', 'to_net_margin', 'from_slab',
     'to_slab', 'comission_amount'];
}
