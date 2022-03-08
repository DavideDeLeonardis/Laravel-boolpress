<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Post;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('id', 'asc')->paginate(20);

        return view('admin.categories.index', compact('categories'));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        // $post->tags()->detach();
        // $category->posts();
        // dd($category->posts()->tags());
        // $category->posts()->tags()->detach();
        $posts = $category->posts();
        // dd($posts);
        // dd($category);
//
        // $posts->tags()->get()->detach();
        // foreach ($posts->tags() as $post) {
            // $post->detach();
        // }
        dd($posts->tags());




        $category->delete();

        return redirect()
            ->route('admin.categories.index')
            ->with('status', "Category $category->id deleted!");
    }
}
