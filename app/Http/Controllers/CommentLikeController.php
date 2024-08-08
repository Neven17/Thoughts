<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Notifications\LikeComment;

class CommentLikeController extends Controller
{
    public function like(Comment $comment)
    {
        $user = auth()->user();
        $user->likesComment()->attach($comment);

        $comment->user->notify(new LikeComment($user, $comment));

        return back();
    }







    public function unlike(Comment $comment)
    {
        $user = auth()->user();
        $user->likesComment()->detach($comment);

        return back();
    }
}