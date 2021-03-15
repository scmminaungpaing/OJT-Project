<?php

namespace App\Http\Controllers;

use App\Contracts\Services\Post\PostServiceInterface;
use App\Exports\PostsExport;
use App\Exports\UserExport;
use App\Imports\PostImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class FrontendController extends Controller
{
    private $postInterface;

    public function __construct(PostServiceInterface $postInterface)
    {
        $this->postInterface = $postInterface;
    }

     /**
     * Show the main page
     *
     * @return Response
     */
    public function index(){
        $posts = $this->postInterface->getPost();
        return view('index',compact('posts'));
    }

    /**
     * Show the serach lsit
     *
     * @return Response
     */
    public function search(Request $request){
        $posts = $this->postInterface->searchData($request);
        return view('post.search',['posts' => $posts]);
    }

    /**
    * Get User Profile
    *
    * @param      integer         $userid
    * @return     Response
    */
    public function profile($id){
        $user = $this->postInterface->getPostUserProfile($id);
        $posts = $this->postInterface->getPostUser($id);
        return view('post.profile',['posts' => $posts,'user' => $user]);
    }

    /**
    * Export Posts Excel List
    * @return     Response
    */
    public function exportIntoExcel(){
        return Excel::download(new PostsExport,'posts.xlsx');
    }

    /**
    * Export Posts CSV List
    * @return     Response
    */
    public function exportIntoCSV(){
        return Excel::download(new PostsExport,'posts.csv');
    }

    /**
    * Export Users Excel List
    * @return     Response
    */
    public function userExcel(){
        return Excel::download(new UserExport,'users.xlsx');
    }

    /**
    * Export User CSV List
    * @return     Response
    */
    public function userCSV(){
        return Excel::download(new UserExport,'users.csv');
    }

    /**
    * Import Posts List
    * @param    Request $file
    * @return   Response
    */
    public function import(Request $request){
        $this->validate($request,[
            'file' => 'required|mimes:xls,xlsx,csv,pdf'
        ]);
        Excel::import(new PostImport,$request->file);
        Session::flash('message', 'Post are successfully imported!');
        return redirect()->route('admin#postlist');
    }
}
