<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
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
        if (Auth::user()->role->role == 'super'){
          $posts = Post::all();
        } elseif (Auth::user()->role->role == 'admin'){
          $posts = Post::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        }
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        return view('admin.posts.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $request->validate([
          'title' => 'required|min:5|max:100',
          'body' => 'required|min:5|max:1000',
        'img' => 'image'
        ]);
        $data['user_id'] = Auth::id();
        $data['slug'] = Str::slug($data['title'], '-');

        $newPost = new Post();
        if(!empty($data['img'])){
          $data['img'] = Storage::disk('public')->put('images', $data['img']);
        }
        $newPost->fill($data);
        $saved = $newPost->save();
        $newPost->tags()->attach($data['tags']);
        if($saved){
          return redirect()->route('posts.index');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $tags = Tag::all();
        return view('admin.posts.edit', compact('post', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
       $data = $request->all(); #array di dati
       $data['slug'] = Str::slug($data['title'], '-');
       $data['updated_at'] = Carbon::now('Europe/Rome');

       if(!empty($data['img'])){
         if (!empty($post->img)){
           Storage::disk('public')->delete($post->img);
         }
         $data['img'] = Storage::disk('public')->put('images', $data['img']);
       }

       $post->update($data); #update salva già i dati
       $post->tags()->sync($data['tags']);
       if ($post) {
         return redirect()->route('posts.index')->with('status', 'Hai modificato il post dell\'id: ' . $post->id);
       }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
       $post->delete();
       return redirect()->route('posts.index')->with('status', 'Hai cancellato il post dell\'id: ' . $post->id);
    }
}
