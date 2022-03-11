<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Post;
use Illuminate\Database\Eloquent\Builder;

class PostController extends Controller
{
    public function index()
    {
        return response()->json([
            'response' => true,
            'results' => Post::orderBy('created_at', 'desc')->with(['tags', 'category'])->paginate(12),
        ]);
    }

    public function inRandomOrder()
    {
        return response()->json([
            'response' => true,
            'results' => [
                'data' => Post::inRandomOrder()
                    ->limit(30)
                    ->get()
            ],
        ]);
    }

    public function show($id)
    {
        $post = Post::find($id);

        return response()->json([
            'response' => true,
            'count' => $post ? 1 : 0,
            'results' => [
                'data' => $post,
            ],
        ]);
    }

    public function search(Request $request)
    {
        $data = $request->all();

        $posts = Post::where('id', '>=', 1);

        if (
            array_key_exists('orderbycolumn', /** esiste in */ $data) &&
            array_key_exists('orderbysort', /** esiste in */ $data)
        ) {
            $posts->orderBy($data['orderbycolumn'], $data['orderbysort']);
        }

        if (array_key_exists('tags', $data)) {
            foreach ($data['tags'] as $tag) {
                // join
                $posts->whereHas('tags', function (Builder $query) use ($tag) {
                    $query->where('name', '=', $tag);
                });
            }
        }

        // default
        $posts = $posts->with(['tags', 'category'])->get();

        return response()->json([
            'response' => true,
            'count' => $posts->count(),
            'results' => [
                'data' => $posts,
            ],
        ]);
    }
}
