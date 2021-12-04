<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\catagory;
use App\post;
use App\tag;
use App\User;
class PostsTbaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $catagory1=catagory::create([
            'name'=>'News'
        ]);
        $catagory2=catagory::create([
            'name'=>'Markiting',
        ]);
        $catagory3=catagory::create([
            'name'=>'Partenrship',
        ]);
        $author1= User::create([
            'name'=>'habto',
            'email'=>'habto@gmail.com',
            'password'=>Hash::make('password')
        ]);

        $author2= User::create([
            'name'=>'habtewold',
            'email'=>'habti656@gmail.com',
            'password'=>Hash::make('password')
        ]);

        $post1=post::create([
            'title'=>'ሀብተወልድ relocated our office to a new designed garage',
            'description'=>'lbljdsbflzskbfk;asbfasgflbasdljfhgaslfglasjgflas',
            'content'=>'ckjvblzghvljzshbvljzhbvljzxhvj,zxcvlzsjhvflsdvfulsdgvf',
            'catagory_id'=>$catagory1->id,
            'image'=>'posts/1.jpg',
            'user_id'=>$author1->id

        ]);
         $post2=post::create([
            'title'=>'Top 5 brilliant content marketing strategies',
            'description'=>'lbljdsbflzskbfk;asbfasgflbasdljfhgaslfglasjgflas',
            'content'=>'ckjvblzghvljzshbvljzhbvljzxhvj,zxcvlzsjhvflsdvfulsdgvf',
            'catagory_id'=>$catagory2->id,
            'image'=>'posts/2.jpg',
            'user_id'=>$author2->id
            
        ]);
          $post3=post::create([
            'title'=>'Best practices for minimalist design with example',
            'description'=>'lbljdsbflzskbfk;asbfasgflbasdljfhgaslfglasjgflas',
            'content'=>'ckjvblzghvljzshbvljzhbvljzxhvj,zxcvlzsjhvflsdvfulsdgvf',
            'catagory_id'=>$catagory3->id,
            'image'=>'posts/3.jpg',
            'user_id'=>$author1->id
            
        ]);
          $post4=post::create([
            'title'=>'Congratulate and thank to Maryam for joining our team',
            'description'=>'lbljdsbflzskbfk;asbfasgflbasdljfhgaslfglasjgflas',
            'content'=>'ckjvblzghvljzshbvljzhbvljzxhvj,zxcvlzsjhvflsdvfulsdgvf',
            'catagory_id'=>$catagory2->id,
            'image'=>'posts/4.jpg',
            'user_id'=>$author1->id
            
        ]);
          $tag1=tag::create([
            'name'=>'Jobs'
        ]);
           $tag2=tag::create([
            'name'=>'custumers'
        ]);
            $tag3=tag::create([
            'name'=>'record'
        ]);
            $post1->tags()->attach([$tag1->id,$tag2->id]);
            $post2->tags()->attach([$tag3->id,$tag2->id]);
            $post1->tags()->attach([$tag1->id,$tag3->id]);
    }
}
