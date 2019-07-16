<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Tag;
use App\Post;
use App\Category;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;

class PostsController extends Controller
{

    public function index(Request $request)
    {
        $categories = Category::pluck('title', 'id')->all();

        $catSearch = $request->get('category_id');
        $search = $request->get('search');

        $q = Post::query();
        if ($search) {
            $q = $q->where('title', 'like', "%{$search}%");
        }
        if ($catSearch) {
            $q = $q->where('category_id', $catSearch);
        }
        $posts = $q->paginate(10);
        return view('admin.posts.index', compact('categories','posts'));
    }

    public function create()
    {
        $categories = Category::pluck('title', 'id')->all();
        $tags = Tag::pluck('title', 'id')->all();
        return view('admin.posts.create', compact('categories','tags'));
    }

    public function store(\App\Http\Requests\Post $request)
    {
        $post = $request->validated();
        $post = Post::add($request->all());
        $post->uploadImage($request->file('image'));
        $post->setCategory($request->get('category_id'));
        $post->setTags($request->get('tags'));
        $post->toggleStatus($request->get('status'));
        $post->toggleFeature($request->get('is_featured'));
        $post->user_id = Auth::user()->id;
        $post->save();

        return redirect()->route('posts.index');
    }

    public function edit($id)
    {
        $post = Post::find($id);
        $categories = Category::pluck('title', 'id')->all();
        $tags = Tag::pluck('title', 'id')->all();
        $selectedTags = $post->tags->pluck('id')->all();
        return view('admin.posts.edit', compact('categories','tags', 'post', 'selectedTags'));

    }

    public function update(\App\Http\Requests\Post $request, $id)
    {
        $date = $request->validated();
        $post = Post::find($id);
        $data = $request->all();
        $data['is_featured'] = $request->get('is_featured', 0);
        $data['status'] = $request->get('status', 0);
        $post->edit($data);
        $post->uploadImage($request->file('image'));
        $post->setTags($request->get('tags'));

        return redirect()->route('posts.index');
    }

    public function destroy($id)
    {
        Post::find($id)->remove();
        return redirect()->route('posts.index');
    }
}
