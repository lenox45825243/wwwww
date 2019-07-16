<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentsController extends Controller
{
    public function index(Request $request)
    {
        $comSearch = $request->get('search');
        $q = Comment::query()->with('post');
        if ($comSearch !== null) {
            $q->where('text', 'like', "%{$comSearch}%");
        }
        $comments = $q->paginate(10);
        return view('admin.comments.index', ['comments' => $comments]);
    }

    public function toggle($id)
    {
        $comment = Comment::find($id);
        $comment->toggleStatus();
        return redirect()->back();
    }

    public function destroy($id)
    {
        Comment::find($id)->remove();
        return redirect()->back();
    }
}
