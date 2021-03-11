<?php

namespace App\Exports;

use App\Models\Post;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PostExport implements FromCollection,WithHeadings
{
    public function headings():array{
        return [
            "id",
            "Title",
            "Description",
            "User-ID",
            "Publish"
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect(Post::getPostData());
    }
}
