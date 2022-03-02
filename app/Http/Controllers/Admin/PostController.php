<?php

namespace App\Http\Controllers\Admin;

use App\Model\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    protected $validationParams = [
        'title' => 'required|max:255',
        'content' => 'required',
        // 'category_id' => 'exists:App\Model\Category,id'
    ];


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(20);

        return view('admin.posts.index', compact('posts'));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexUser()
    {
        $posts = Post::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(20);

        return view('admin.posts.index', ['posts' => $posts]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
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
        $data['user_id'] = Auth::user()->id;

        $request->validate($this->validationParams);

        $post = new Post();
        $post->fill($data);
        $post->slug = $post->createSlug($data['title']);
        $post->save();

        return redirect()->route('admin.posts.show', $post->slug);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', ['post' => $post]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if (Auth::user()->id != $post->user_id) {
            abort('403');
        }

        // $categories = Category::all();

        $data = [
            'post' => $post,
            // 'categories' => $categories
        ];

        return view('admin.posts.edit', $data);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->all();

        if (Auth::user()->id != $post->user_id) {
            abort('403');
        }

        $request->validate($this->validationParams);

        if ($data['title'] != $post->title) {
            $post->title = $data['title'];
            $post->slug = $post->createSlug($data['title']);
        }
        if ($data['content'] != $post->content) {
            $post->content = $data['content'];
        }
        // if ($data['category_id'] != $post->category_id) {
        //     $post->category_id = $data['category_id'];
        // }

        $post->update();

        return redirect()->route('admin.posts.show', $post);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if (Auth::user()->id != $post->user_id) {
            abort('403');
        }

        $post->delete();

        return redirect()
            ->route('admin.posts.index')
            ->with('status', "Post $post->id deleted!");
    }
}
