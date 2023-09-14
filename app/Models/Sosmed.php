<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sosmed extends Model
{
    use HasFactory;
    protected $table = 'sosmeds';

    public function user(){
        return $this->belongsTo(User::class);
    }
}
