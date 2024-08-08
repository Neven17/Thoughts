<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Comment;
use App\Models\Thought;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = auth()->user()->notifications()->paginate(10);
        return view('notifications.index', compact('notifications'));
    }
    public function show($id)
    {
       
        $notification = auth()->user()->notifications()->findOrFail($id);
        $data = $notification->data;
    
        $notification->markAsRead();
    
       
        if (isset($data['thought_id'])) {
            $thought = Thought::find($data['thought_id']);
            if ($thought) {
                return redirect()->route('thoughts.show', $data['thought_id']);
            } else {
                return redirect()->route('dashboard')->with('errorNotify', 'Thought has been deleted.');
            }
        } elseif (isset($data['comment_id'])) {
            $comment = Comment::find($data['comment_id']);
            if ($comment) {
                return redirect()->route('comments.show', $data['comment_id']);
            } else {
                return redirect()->route('dashboard')->with('errorNotify', 'Comment has been deleted.');
            }
        } elseif (isset($data['follower_id'])) { 
            $follower = User::find($data['follower_id']);
            if ($follower) {
                return redirect()->route('users.show', $data['follower_id']);
            } else {
                return redirect()->route('dashboard')->with('errorNotify', 'Follower has been deleted.');
            }
        } else {
            return redirect()->route('dashboard')->with('errorNotify', 'Invalid notification.');
        }
    }
    
    

}
