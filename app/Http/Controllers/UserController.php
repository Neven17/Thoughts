<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Thought;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateUserRequest;
use PhpParser\Node\Stmt\Return_;

class UserController extends Controller
{

  

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $thoughts = $user->thoughts()->paginate(5);                  
        
        $ourUsers = $this->getOurUsers();



        return view('users.show', compact('user', 'thoughts', 'ourUsers'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user);
        $editing = true;
        $thoughts = $user->thoughts()->paginate(5);
        return view('users.edit', compact('user', 'editing', 'thoughts')); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)  

    {
        $this->authorize('update', $user); 
        $validated = $request->validated();     
        if ($request->has('image')) {        

            $imagePath = $request->file('image')->store('profile', 'public'); 
            $validated['image'] = $imagePath;        

            Storage::disk('public')->delete($user->image ?? '');     
        }




        $user->update($validated);
        return redirect()->route('profile');
    }

    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        $user->delete();

        return redirect()->route('dashboard')->with('success', 'Acc deleted successfully!');

    }






    public function profile()  
    {
        return $this->show(auth()->user());
    }

    public function terms()
    {


        $ourUsers = $this->getOurUsers();

        return view('terms', compact('ourUsers'));
    }






    public function allUsers()
    {


        $ourUsers = $this->getOurUsers()->paginate(10);
        return view('users.all-users', compact('ourUsers'));
    }

    public function getOurUsers()
    {
        $currentUser = auth()->user();
        $followingsUserIDs = $currentUser->followings()->pluck('id');
        $blockedUserIDs = $currentUser->blockings()->pluck('id');
        $blockedByUsers=$currentUser->blockedUsers()->pluck('id');
        

        return User::whereNotIn('id', $followingsUserIDs)
            ->whereNotIn('id', $blockedUserIDs)
             ->whereNotIn('id', $blockedByUsers)
            ->where('id', '!=', $currentUser->id)
            ->inRandomOrder();
    }


    public function showFollowers(User $user)
    {
        $currentUser = auth()->user();

        if ($currentUser->isBlockedByOrBlocking($user)) {
        }


        $ourFollowers = $user->followers()->paginate(3);
        return view('users.all-followers', compact('ourFollowers', 'user'));
    }

    public function showLikes(User $user)
{
    $currentUser = auth()->user();

    if ($currentUser->isBlockedByOrBlocking($user)) {
       
    }

    $user->load('thoughts.likes.user');

    return View::make('users.likes', compact('user'));
}
}
