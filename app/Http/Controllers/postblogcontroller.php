<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\post;
use App\catagory;
use App\tag;

class postblogcontroller extends Controller
{
    //
    public function show(post $post){
        return view('blog.show')->with('post',$post);
    }
    public function catagory(catagory $catagory){
        $search = request()->query('search');
        if($search){
            $posts = $catagory->posts()->where('title', 'LIKE', "%search%")->simplepaginate(3);
        }else{
            $posts= $catagory->posts()->simplepaginate(3);
        }
     return view('blog.catagory')->with('catagory',$catagory)
            ->with('posts',$catagory->posts()->simplepaginate(3))
            ->with('catagories', catagory::all())
            ->with('tags' ,tag::all());

    }
    public function tag(tag $tag){
        return view('blog.tag')->with('tag',$tag)
        ->with('posts',$tag->posts()->simplepaginate(3))
        ->with('catagories' ,catagory::all())
         ->with('tags' ,tag::all());


    }
}
