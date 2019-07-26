<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Post;
use App\Category;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::with('author')->where('status', 0)->paginate(3);
        return view('pages.index', ['posts' => $posts,]);
    }

    public function show($slug)
    {

        $posts = Post::where('slug', $slug)->firstOrFail();
        return view('pages.show', ['post' => $posts,]);
    }

    public function tag($slug)
    {
        $tag = Tag::where('slug', $slug)->firstOrFail();
        $posts = $tag->posts()->paginate(2);
        return view('pages.list', compact('posts', 'category'));
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $posts = $category->posts()->paginate(2);

        return view('pages.list', compact('posts', 'category'));
    }
}
