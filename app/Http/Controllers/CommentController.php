<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCommentRequest;
use App\Models\Comment;
use App\Models\Thought;
use Illuminate\Http\Request;

class CommentController extends Controller                 
{



public function show(Comment $comment)
{
    return redirect()->route('thoughts.show', $comment->thought->id);
}


      

    public function store(CreateCommentRequest $request,Thought $thought)                   
    {
       $validated =$request->validated();

       $validated['user_id'] = auth()->id();
       $validated['thought_id'] = $thought->id;
       $validated['content'] = $request->input('comment_content');

       Comment::create($validated);
        

       return redirect()->route('thoughts.show', $thought->id)
                     ->with('comment_content', $request->input('comment_content'));

    }


    public function destroy(Comment $comment)
{
    $this->authorize('delete', $comment);
    $comment->delete();

    return redirect()->route('thoughts.show', $comment->thought->id);
}



}
