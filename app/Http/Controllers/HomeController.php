<?php

namespace App\Http\Controllers;

use App\Models\MyPost;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use App\Models\Address;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use File;

class HomeController extends Controller
{
    public function index()
    {
        // return view('home');


        // return DB::table('posts')->get();
        // return DB::table('posts')->find(7);
        // return DB::table('posts')->first();
        // return DB::table('posts')->where('id','<','10')->where('id','>','5',)->get();
        // return DB::table('posts')->where('status',false)->get();
        // return DB::table('posts')->pluck('title','id');   
        // return DB::table('posts')->insert([[
        //     'title' => 'New Post',
        //     'content' => 'Sint mollit ullamco consectetur minim ex quis consequat.',
        //     'user_id' => 1,
        //     'published_date' => date('Y-m-d'),
        //     'created_at' => now(),
        //     'updated_at' => now()
        // ],[
        //     'title' => 'New Post2',
        //     'content' => '2Sint mollit ullamco consectetur minim ex quis consequat.',
        //     'user_id' => 1,
        //     'published_date' => date('Y-m-d'),
        //     'created_at' => now(),
        //     'updated_at' => now()
        // ]]);

        // return DB::table('posts')->where('id', '=', '13')->update([
        //     'title' => 'Updated Title',
        //     'content' => 'Ad tempor quis ut sunt adipisicing sit consectetur elit reprehenderit. Id ea elit exercitation consequat nulla proident irure enim. Laboris consectetur esse occaecat veniam nisi. Irure pariatur cupidatat nisi amet elit veniam sit. Labore nostrud occaecat aliqua pariatur duis Lorem commodo irure laboris pariatur cupidatat ad in.'
        // ]);

        // return DB::table('posts')->where('id','54')->delete();
        // return DB::table('posts')->delete(55);

        // return DB::table('posts')->join('categories','posts.category_id','=','categories.id')->get();
        // return DB::table('posts')->join('categories','posts.category_id','=','categories.id')->select('categories.*')->get();

        // return DB::table('posts')->count();

        // return DB::table('posts')->max('views');
        // return DB::table('posts')->sum('views');
        // return DB::table('posts')->min('views');
        // return DB::table('posts')->average('views');


        // return $posts = MyPost::all();

        // $posts = MyPost::find(13);
        // return $posts->title;    
        // $posts = MyPost::findOrFail(16);
        // return $posts; 

        // $post = MyPost::all();
        // foreach($post as $p){
        //     echo $p->title.'<br>';
        // }


        //return Post::where('views', '>', 100)->where('id', 33)->get();
        //return Post::where('views', '>', 100)->orWhere('id', 33)->get();


        // $post = new Post;
        // $post->title = 'New Post';
        // $post->content = 'This is a content of the post';
        // $post->status = 1;
        // $post->user_id = 1;
        // $post->published_date = date('Y-m-d');
        // $post->category_id = 2;
        // $post->views = 400;
        // $post->save();

        // $post = Post::where('id', 42)->first();
        // $post->title = 'updated Post 42';
        // $post->content = 'This is a content changed by  Eloquent 42 of the post';
        // $post->save();

        //Post::findOrFail(12)->delete();
        //Post::where('id',15)->delete();


        // $post = Post::create([
        //     'title' => 'New Post',
        //     'content' => 'Sint mollit ullamco consectetur minim ex quis consequat.',
        //     'status' => 1,
        //     'user_id' => 1,
        //     'published_date' => date('Y-m-d'),
        //     'category_id' => 3,
        //     'views' => 253,
        // ]);

        // $post = Post::find(33)->update([
        //     'title' => 'New Post 33',
        //     'content' => '33Sint mollit ullamco consectetur minim ex quis consequat.',
        //     'status' => 1,
        //     'user_id' => 1,
        //     'published_date' => date('Y-m-d'),
        //     'category_id' => 3,
        //     'views' => 253,
        // ]);

        // $post = Post::where('id',48)->update([
        //     'title' => 'New Post 48',
        //     'content' => '45=8Sint mollit ullamco consectetur minim ex quis consequat.',
        // ]);

        //Post::where('id',3)->delete();
        //return Post::onlyTrashed()->get();


        //Post::withTrashed()->find(3)->restore();
        //Post::withTrashed()->find(3)->forcedelete();
        //dd('success');

        // $users = User::all();
        // return view('home',compact('users'));

        // $addresses = Address::all();
        // return view('home',compact('addresses'));

        // $categories = Category::find(3)->posts;
        // return view('home',compact('categories'));


        // $post = Post::with('tags')->first();
        // $tag = Tag::first();

        // $post->tags()->attach($tag);
        // $post->tags()->attach([3,4]);

        // $posts = Post::with('tags')->get();
        // return view('home',compact('posts'));


        return view('home');

        //Storage::delete('images/IGpZcxDZoDMEUcm7MxzbnT9OhyYnaZZMouFCyow3.jpg');
        //Storage::disk('public')->delete('images/IGpZcxDZoDMEUcm7MxzbnT9OhyYnaZZMouFCyow3.jpg');
        //File::delete(storage_path('/app/public/At3jzCNNJlyKGNl3mdF9zO43p5tEiouwfFPcnzOJ.svg'));
        //unlink(storage_path('/app/public/images/new_image.jpg'));
    

        //$posts = Post::all();
        //return response()->json($posts);
        //return response($posts);
    }
}
