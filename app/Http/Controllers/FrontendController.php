<?php

namespace App\Http\Controllers;

use App\Contracts\Services\Post\PostServiceInterface;
use App\Exports\PostExport;
use App\Imports\PostImport;
use Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FrontendController extends Controller
{
    private $postInterface;

    public function __construct(PostServiceInterface $postInterface)
    {
        $this->postInterface = $postInterface;
    }

    public function index(){
        $posts = $this->postInterface->getPost();
        return view('index',compact('posts'));
    }
    public function search(Request $request){
        $posts = $this->postInterface->searchData($request);
        return view('post.search',['posts' => $posts]);
    }

    public function profile($id){
        $user = $this->postInterface->getPostUserProfile($id);
        $posts = $this->postInterface->getPostUser($id);
        return view('post.profile',['posts' => $posts,'user' => $user]);
    }

    public function exportIntoExcel(){
        return Excel::download(new PostExport,'posts.xlsx');
    }

    public function exportIntoCSV(){
        return Excel::download(new PostExport,'posts.csv');
    }

    public function exportIntoPDF(){
        return Excel::download(new PostExport,'posts.pdf');
    }

    public function import(Request $request){
        $this->validate($request,[
            'file' => 'required|mimes:xls,xlsx,csv'
        ]);
        Excel::import(new PostImport,$request->file);
        Session::flash('message', 'Post are successfully imported!');
        return redirect()->route('admin#postlist');
    }
}
