<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentsController extends Controller
{
    public function index()
    {
        $comments = Comment::paginate(20);
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
