<?php

namespace App\Exports;

use App\Models\Post;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
class PostsExport implements FromCollection,WithMapping,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Post::with('user')->get();
    }

    public function map($post): array
    {
        $post->publish = ($post->publish) ? "published" : "draft";

        return [
            $post -> title,
            $post -> description,
            $post -> user->name,
            $post -> publish,
            $post -> created_at
        ];
    } 

    public function headings(): array
    {
        return [
            'Title',
            'Description',
            'Post By',
            'Publish',
            'Created_At'
        ];
    }
}
