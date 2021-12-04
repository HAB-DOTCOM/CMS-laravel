<?php

namespace App\Http\Controllers;
use App\catagory;
use App\tag;
use App\post;

use Illuminate\Http\Request;

class welcomecontroller extends Controller
{
    //
    
    public function index(){
        $search = request()->query('search');
    if($search){
        $posts=post::where('title','LIKE',"%{$search}%")->simplepaginate(3);
    }
    else{
        $posts=post::simplepaginate(3);
    }
        return view('welcome')
        ->with('catagories',catagory::all())
        ->with('tags',tag::all())
        ->with('posts',post::searched()->simplepaginate());
    
    }
}
