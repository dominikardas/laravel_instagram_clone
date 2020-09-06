<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

use App\Post;

class PostsController extends Controller
{
    private $_validateRules = [
        'description' => ['required', 'string', 'nullable'],
        'image'   => ['required', 'image', 'max:1999']
    ];

    public function __construct()
    {        
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        if (!auth()->user()) { return view('posts.index'); }

        $users = auth()->user()->following()->pluck('profiles.user_id');
        $posts = Post::whereIn('user_id', $users)->latest()->paginate(2);
        $data = array('posts' => $posts);
        
        return view('posts.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->validate($this->_validateRules);

        $imagePath = request('image')->store('posts', 'public');
        $image = Image::make(public_path('storage/' . $imagePath))->fit(1200, 1200);
        $image->save();

        auth()->user()->posts()->create([
            'description' => $data['description'],
            'image' => $imagePath
        ]);

        return redirect('/profile/' . auth()->user()->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        $data = array('post' => $post);
        return view('posts.show', $data);

        // $post = Post::findOrFail($id);
        // $data = array(
        //     'post' => $post,
        //     'user' => $post->user,
        //     'isLiked' => auth()->user()->isLikedPost($post->id)
        // );
        
        // return view('posts.show', $data);
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
    }
}
