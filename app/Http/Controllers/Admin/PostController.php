<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Post;
use App\Model\Tag;
use App\Model\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Faker\Generator as Faker;

class PostController extends Controller
{
    protected $validationParams = [
        'title' => 'required|max:240',
        'content' => 'required',
        'category_id' => 'exists:App\Model\Category,id',
        'tags.*' => 'nullable|exists:App\Model\Tag,id',
        'image' => 'nullable|image'
    ];


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->roles()->get()->contains('1')) {
            $posts = Post::orderBy('created_at', 'desc')->paginate(20);
        } else {
            $posts = Post::where('user_id', Auth::user()->id)
                ->orderBy('created_at', 'desc')
                ->paginate(20);
        }

        $data = [
            'posts' => $posts,
            'postH1' => 'All Posts'
        ];

        return view('admin.posts.index', $data);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexUser()
    {
        $data = [
            'posts' => Post::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(20),
            'postH1' => 'My Posts'
        ];

        return view('admin.posts.index', $data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'categories' => Category::all(),
            'tags' => Tag::all()
        ];

        return view('admin.posts.create', $data);
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

        if (!empty($data['image'])) {
            $data['image'] = Storage::put('uploads', $data['image']);
        }

        $post = new Post();
        $post->fill($data);
        $post->slug = $post->createSlug($data['title']);
        $post->save();

        if (!empty($data['tags'])) {
            $post->tags()->attach($data['tags']);
        }

        return redirect()->route('admin.posts.show', $post->slug);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post, Faker $faker)
    {
        $data = [
            'post' => $post,
            'faker' => $faker
        ];

        return view('admin.posts.show', $data);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if (Auth::user()->id != $post->user_id && !Auth::user()->roles()->get()->contains(1)) {
            abort('403');
        }

        $data = [
            'post' => $post,
            'categories' => Category::all(),
            'tags' => Tag::all()
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

        if (Auth::user()->id != $post->user_id && !Auth::user()->roles()->get()->contains(1)) {
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
        if ($data['category_id'] != $post->category_id) {
            $post->category_id = $data['category_id'];
        }

        if (!empty($data['image'])) {
            Storage::delete($post->image);
            $post->image = Storage::put('uploads', $data['image']);
        }

        $post->update();

        if (!empty($data['tags'])) {
            $post->tags()->sync($data['tags']);
        } else {
            $post->tags()->detach();
        }

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
        if (Auth::user()->id != $post->user_id && !Auth::user()->roles()->get()->contains(1)) {
            abort('403');
        }

        $post->tags()->detach();
        $post->delete();

        return redirect()
            ->route('admin.posts.index')
            ->with('status', "Post $post->id deleted!");
    }
}
