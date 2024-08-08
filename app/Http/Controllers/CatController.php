<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CatController extends Controller
{
    public function showCatForm()
    {
        return view('cats');
    }

    public function fetchCatImages(Request $request)
    {
        $request->validate([
            'limit' => 'required|integer|min:1|max:10',
        ]);

        $limit = $request->input('limit');
        $apiKey = env('CAT_API_KEY');
        $apiUrl = "https://api.thecatapi.com/v1/images/search?limit={$limit}&api_key={$apiKey}";

        $response = Http::get($apiUrl);

        if ($response->successful()) {
            $catImages = $response->json();
            return view('cats', ['catImages' => $catImages, 'limit' => $limit]);
        } else {
            return view('cats', ['error' => 'Unable to fetch cat images.']);
        }
    }
}
