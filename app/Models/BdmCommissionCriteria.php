<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BdmCommissionCriteria extends Model
{
    use HasFactory;

    
    protected $fillable=['from_net_margin_per','to_net_margin_per','monthly_from_net_margin','monthly_to_net_margin','monthly_commission','type'];
}
