<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Client;
use App\Models\Thought;
use Illuminate\Http\Request;

class SearchController extends Controller
{



    public function searchUser(Request $request)
    {

        if($request->filled('searchUsers')){

            $searchInput= '%'.  $request->input('searchUsers') . '%';
            $foundUser=User::where('name', 'like', $searchInput)->first();

            if ($foundUser) {
                return redirect()->route('users.show', $foundUser->id);
            } else {
               
                return redirect()->route('dashboard')->with('error', 'User does not exist! Please check the name');
            }

        

        }

       
        return redirect()->route('dashboard')->with('error', 'Search input cannot be empty');




    }


    public function searchContent(Request $request)
    {
        $followingsIDs = auth()->user()->followings()->pluck('user_id');
        $blockedIDs = auth()->user()->blockings()->pluck('user_id');
        $thoughts = Thought::whereIn('user_id', $followingsIDs)
            ->whereNotIn('user_id', $blockedIDs)
            ->latest();

        if ($request->filled('search')) {
            $searchContent = '%' . $request->input('search') . '%';
            $thoughts = $thoughts->where('content', 'like', $searchContent)
                ->whereNotIn('user_id', $blockedIDs)
                ->orWhereDate('created_at', 'like', '%' . $request->get('search', '') . '%');
        }

        return view('dashboard', [
            'thoughts' => $thoughts->paginate(5),
            'ourUsers' => $this->getOurUsers(), 
            'todayInHistory' => $this->getTodayInHistory(),
        ]);
    }

    private function getOurUsers()
    {
        $currentUser = auth()->user();
        $followingsUserIDs = $currentUser->followings()->pluck('id');
        $blockedUserIDs = $currentUser->blockings()->pluck('id');

        return User::whereNotIn('id', $followingsUserIDs)
            ->whereNotIn('id', $blockedUserIDs)
            ->where('id', '!=', $currentUser->id)
            ->inRandomOrder()
            ->get()
            ->unique('id');
    }

    private function getTodayInHistory()
    {
        $client = new Client();
        $response = $client->get('https://en.wikipedia.org/api/rest_v1/page/html/' . date('F_j'));

        if ($response->getStatusCode() == 200) {
            $html = $response->getBody()->getContents();
            $events = $this->extractEventsFromHtml($html);
            return $events;
        } else {
            return null;
        }
    }

    private function extractEventsFromHtml($html, $limit = 2)
    {
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($html);
        libxml_clear_errors();

        $events = [];
        $lis = $dom->getElementsByTagName('li');
        $count = 0;
        foreach ($lis as $li) {
            $textContent = $li->textContent;
            $textContent = preg_replace('/\b(\d+)\s?BC\b/i', '$1 BC', $textContent);
            $textContent = preg_replace('/\b(\d+)\s?AD\b/i', '$1 AD', $textContent);
            $events[] = $textContent;
            $count++;
            if ($count >= $limit) {
                break;
            }
        }

        return $events;
    }
}

