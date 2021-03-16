<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Post extends Model
{
    protected $fillable = ['title','description','user_id','publish'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
