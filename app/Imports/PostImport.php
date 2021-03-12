<?php

namespace App\Imports;

use App\Models\Post;
use App\Models\User;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PostImport implements ToModel,WithHeadingRow,SkipsOnError
{
    use SkipsErrors ;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $user_id = User::where("name",$row['post_by'])->first();
        $row['publish'] =  ($row['publish'] === "published") ? true : false ;
        return new Post([
            'title' => $row['title'],
            'description' => $row['description'],
            'user_id' => $user_id['id'],
            'publish' => $row['publish']
        ]);
    }
}
