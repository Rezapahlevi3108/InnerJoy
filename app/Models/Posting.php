<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posting extends Model
{
    use HasFactory;
    protected $table = 'postings';

    protected $fillable = [
        'status',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
