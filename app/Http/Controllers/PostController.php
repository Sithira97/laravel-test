<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use File;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$posts = Post::with('category')->get();

        $posts = Post::paginate(10);
        return view('index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required'],
            'category_id' => ['required', 'integer'],
            'content' => ['required', 'max: 255'],
            'image' => ['required', 'max: 2028', 'image']
        ]);

        $fileName = time() . '_' . $request->image->getClientOriginalName();
        $filePath = $request->image->storeAs('uploads', $fileName);

        //return $filePath;

        $post = new Post();
        $post->title = $request->title;
        $post->category_id = $request->category_id;
        $post->content = $request->content;
        $post->image = $filePath;
        $post->save();

        return redirect()->route('posts.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::findOrFail($id);
        return view('show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::all();
        return view('edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => ['required'],
            'category_id' => ['required', 'integer'],
            'content' => ['required', 'max: 255'],
        ]);

        $post = Post::findOrFail($id);

        if ($request->hasFile('image')) {
            $request->validate([
                'image' => ['required', 'max: 2028', 'image']
            ]);
            
            $fileName = time() . '_' . $request->image->getClientOriginalName();
            $filePath = $request->image->storeAs('uploads', $fileName);

            File::delete(public_path('storage/' . $post->image));

            $post->image = $filePath;

        };

       

        //return $filePath;


        $post->title = $request->title;
        $post->category_id = $request->category_id;
        $post->content = $request->content;
    
        $post->save();

        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        //return redirect()->route('posts.index');
        return redirect()->back();
    }

    public function trashed()
    {
        //$posts = Post::onlyTrashed()->get();
        $posts = Post::onlyTrashed()->paginate(10);
        return view('trashed', compact('posts'));

    }

    public function restore(string $id)
    {
        $post = Post::onlyTrashed()->findOrFail($id);
        $post->restore();

        return redirect()->back();
    }

    public function forceDelete(string $id)
    {
        $post = Post::onlyTrashed()->findOrFail($id);

        File::delete(public_path('storage/' . $post->image));
        $post->forceDelete();

        return redirect()->back();
    }
}
