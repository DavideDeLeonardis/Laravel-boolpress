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
            'results' =>  Post::orderBy('created_at', 'desc')->paginate(8)
        ]);
    }
}
