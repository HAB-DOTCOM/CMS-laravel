<?php

namespace App\Http\Controllers;
use App\post;
use App\catagory;
use App\tag;

use Illuminate\Http\Request;
use App\Http\Requests\post\createpostrequest;
use App\Http\Requests\post\updatepost;
use Illuminate\Support\Facades\Storage;
use App\Http\Middleware\verfycatagory;


class postscontroller extends Controller
{
    public function __construct(){

        $this->middleware('verifycatagoriescount')->only(['create','store']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        //
        return view('posts.index')->with('posts',post::all());
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
         return view('posts.create')->with('catagories',catagory::all())->with('tags',tag::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(createpostrequest $request)
    {
        $image=$request->image->store('posts');
        $post = post::create([
            'title'=>$request->title,
            'description'=>$request->description,
            'content'=>$request->content,
            'image'=>$request->image,
            'published_at'=>$request->published_at,
            'catagory_id'=>$request->catagory,
            'user_id'=>auth()->user()->id
        ]);

       if ($request->tags) {
           $post->tags()->attach($request->tags);
       }

        //flashing the message

        session()->flash('success','Post created successfully');
        return redirect(route('posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(post $post)
    {
        //
        return view('posts.create')->with('post',$post)->with('catagories',catagory::all())->with('tags',tag::all());

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(updatepost $request, post $post)
    {
        $data=$request->only(['title','description','published_at','content']);
        if($request->tags)
        {
            $post->tags()->sync($request->tags);
        }

        $post->update($data);
        session()->flash('success','catagory updated successfully');
        return redirect(route('posts.index'));
    }

        
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $post=post::withTrashed()->where('id',$id)->firstOrFail();

        if($post->trashed()){
            Storage::delete($post->image);
            $post->forcedelete();
             }
        else{
             $post->delete();
        }
       
       
        session()->flash('success','Post trashed successfully');
        return redirect(route('posts.index'));
    }

    /**
     * display trashed posts.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function trashed()
    {

        $trashed=post::onlyTrashed()->get();
        return view('posts.index')->with('posts',$trashed);


    }

    public function restore($id)
    {
        $post=post::withTrashed()->where('id',$id)->firstOrFail();

        $post->restore();

        session()->flash('success','post Restored successfully');

        return redirect()->back();
    }
}
 