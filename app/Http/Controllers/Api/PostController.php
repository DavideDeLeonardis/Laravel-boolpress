<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Post;

class PostController extends Controller
{
    public function index()
    {
        return response()->json([
            'response' => true,
            'results' =>  Post::orderBy('created_at', 'desc')->paginate(6)
        ]);
    }

    public function inRandomOrder()
    {
        return response()->json([
            'response' => true,
            'results' =>  [
                'data' => Post::inRandomOrder()->limit(13)->get()
            ]
        ]);
    }

    public function show($id)
    {
        $post = Post::find($id);

        return response()->json([
            'response' => true,
            'count' => $post ? 1 : 0,
            'results' =>  [
                'data' => $post
            ]
        ]);
    }
}
