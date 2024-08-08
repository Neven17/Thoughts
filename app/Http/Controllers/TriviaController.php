<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TriviaController extends Controller
{
    public function showTriviaForm()
    {
        return view('trivia');
    }

    public function fetchTriviaQuestions(Request $request)
    {
        $request->validate([
            'amount' => 'required|integer|min:1|max:50',
        ]);

        $amount = $request->input('amount');
        $apiUrl = "https://opentdb.com/api.php?amount={$amount}";

        $response = Http::get($apiUrl);

        if ($response->successful()) {
            $triviaData = $response->json();
            $questions = $triviaData['results'];
            return view('trivia', ['questions' => $questions]);
        } else {
            return view('trivia', ['error' => 'Unable to fetch trivia questions.']);
        }
    }
}
