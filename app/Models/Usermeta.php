<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usermeta extends Model
{
    protected $fillable = ['user_id', 'key', 'value'];

    use HasFactory;
}
