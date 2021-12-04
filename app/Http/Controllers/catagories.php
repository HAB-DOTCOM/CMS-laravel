<?php

namespace App\Http\Controllers;
use App\catagory;

use Illuminate\Http\Requests;
use App\Http\Requests\catagories\createcatagoryrequest;
use App\Http\Requests\catagories\updatecatagories;
class catagories extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('catagories.index')->with('catagories',catagory::all());
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('catagories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(createcatagoryrequest $request)
    {
        //validiting te data
       // $this->validate($request,[
           // 'name'=>'required|unique:catagories'
       // ]);

        //storing the the data

        catagory::create([
            'name'=>$request->name
        ]);

        //flashing the message

        session()->flash('success','catagory created successfully');
        return redirect(route('catagories.index'));
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
    public function edit(catagory $catagory)
    {
        //
        return view('catagories.create')->with('catagory',$catagory);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(updatecatagories $request, catagory $catagory)
    {
        //
        $catagory->update([
            'name'=>$request->name
        ]);
        session()->flash('success','catagory updated successfully!');

        return redirect(route('catagories.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(catagory $catagory)
    {
        if($catagory->posts->count()>0){
            session()->flash('error','catagory can not be deleted ,Beacuse it has some posts!');
             return redirect()->back();
        }

        $catagory->delete();
        session()->flash('success','catagory deleted successfully');

        return redirect(route('catagories.index'));
    }
}
