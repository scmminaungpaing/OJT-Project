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

    public static function getPostData(){
        $record = DB::table('posts')->select('id','title','description','user_id','publish')->orderBy('created_at','asc')->get()->toArray();
        return $record;
    }
}
