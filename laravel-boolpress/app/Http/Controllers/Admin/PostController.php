<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Post;
use App\Tag;
use App\Category;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=> 'required|max:255',
            'content' => 'required',
            "tags" => 'exists:tags,id',
        ]);


        $form_data = $request->all();

        // verifica caricamento immagine
        if(array_key_exists('image', $form_data)) {
            $cover_path = Storage::put('post_covers', $form_data['image']);
            $form_data['cover'] = $cover_path;
        }


        $new_post = new Post();
        $new_post->fill($form_data);
        $slug = Str::slug($new_post->title, '-');
        

        $slug_presente = Post::where('slug', $slug)->first();

        $contatore = 1;
        while($slug_presente) {
            $slug = $slug . '-' . $contatore;
            $slug_presente = Post::where('slug', $slug)->first();
            $contatore++;
        }


        $new_post->slug = $slug;

        


        $new_post->save();

        // Attach
        $new_post->tags()->attach($form_data['tags']);

        return redirect()->route('admin.posts.index')->with('status', 'POST SALVATO');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->first();
        if (!$post) {
            abort(404);
        }
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if(!$post) {
            abort(404);
        }

        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title'=> 'required|max:255',
            'content' => 'required',
        ]);

        $form_data = $request->all();
        if($form_data['title'] != $post->title) {
            $slug = Str::slug($form_data['title']->title, '-');
        

            $slug_presente = Post::where('slug', $slug)->first();

            $contatore = 1;
            while($slug_presente) {
                $slug = $slug . '-' . $contatore;
                $slug_presente = Post::where('slug', $slug)->first();
                $contatore++;
            }

            $form_data['slug'] = $slug;
        }

        if (array_key_exists('image', $form_data)) {
            $cover_path = Storage::put('post_covers', $form_data['image']);
            $form_data['cover'] = $cover_path;
        }

        $post->update($form_data);

        return redirect()->route('admin.posts.index')->with('status', 'POST AGGIORNATO');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index')->with('status', 'POST ELIMINATO');
    }
}
