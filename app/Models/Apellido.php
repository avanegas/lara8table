<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apellido extends Model
{
    use HasFactory;

 protected $fillable = [
 		'lastname', 'user_id'
 ];

 public function user()
 {
     return $this->belongsTo(User::class);
 }
}
