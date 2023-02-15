<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

     protected $fillable = [
      'id', 'role_id', 'user_id', 'module_name', 'add', 'edit', 'list', 'delete',
    ];
}
