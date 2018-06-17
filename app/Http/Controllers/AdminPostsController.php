<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use App\Photo;
use App\Category;
use App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PostsEditRequest;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\PostsCreateRequest;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
        $categories = Category::pluck('name', 'id')->all();
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostsCreateRequest $request)
    {
        //
        $input  = $request->all();
        $user   = Auth::user();
        
        if($file = $request->file('photo_id')){
            $name = time() . $file->getClientOriginalName();
            $file->move('images', $name);
            $photo = Photo::create(['file'=>$name]);
            $input['photo_id'] = $photo->id;
        }
        // this is my way
        // $input['user_id'] = $user->id;
        // Post::create($input);
        // my way end header_register_callback
        // his way start here - relationship way
        $user->posts()->create($input);
        // end here
        return redirect('/admin/posts');
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
    public function edit($id)
    {
        //
        $post = Post::findOrFail($id);
        $categories = Category::pluck('name', 'id')->all();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostsEditRequest $request, $id)
    {
        //
        $input  = $request->all();

        if ($file = $request->file('photo_id')) {
            $name = time() . $file->getClientOriginalName();
            $file->move('images', $name);
            $photo              = Photo::create(['file'=>$name]);
            $input['photo_id']  = $photo->id;
        }

        Post::findOrFail($id)->update($input);
        // Auth::user()->posts()->whereId($id)->first()->update($input);
        return redirect('/admin/posts');
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
        $post = Post::findOrFail($id);
        if ($post->photo) {
            unlink(public_path() . $post->photo->file);
        }
        
        $post->delete();
        // I added this to delete the photo in the database
        $post->photo()->delete();
        
        return redirect('/admin/posts');
    }

    
    public function post($id)
    {
        //
        $post = Post::findOrFail($id);
        $comments = $post->comments()->whereIsActive(1)->get();
        return view('post', compact('post', 'comments'));
    }
}
