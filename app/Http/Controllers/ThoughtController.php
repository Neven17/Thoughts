<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateThoughtRequest;
use App\Http\Requests\UpdateThoughtRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Thought;
use Illuminate\Http\Request;

class ThoughtController extends Controller
{


    public function show(Thought $thought)
    {

        return view('thoughts.show', compact('thought'));
    }


    public function store(CreateThoughtRequest $request)
    {

        $validated = $request->validated();

        $validated['user_id'] = auth()->id(); // kada korisnik stvara thought pise ciji je id

        Thought::create($validated);



        return redirect()->route('dashboard')->with('success', 'Thought created successfully!');
    }




    public function destroy(Thought $thought)
    {
        //DODAO U authserviceprovider logiku az autorizaciju   Nalazi se u policy
        $this->authorize('delete', $thought);

        $thought->delete();

        return redirect()->route('dashboard')->with('success', 'Thought deleted successfully!');
    }

    public function edit(Thought $thought)
    {


        //DODAO U authserviceprovider logiku az autorizaciju  epgates

        $this->authorize('update', $thought);        //Update je iz thoughtpolicy

        $editing = true;
        return view('thoughts.show', compact('thought', 'editing'));
    }

    public function update(UpdateThoughtRequest $request, Thought $thought)
    {

        $this->authorize('update', $thought);

        $validated = $request->validated();

        $thought->update($validated);

        return redirect()->route('thoughts.show', $thought->id)->with('success', 'Thought updated successfully!');
    }
}
