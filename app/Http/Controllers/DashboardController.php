<?php

namespace App\Http\Controllers;


use App\Models\User;
use GuzzleHttp\Client;
use App\Models\Thought;
use App\Mail\WelcomeEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{


  

    public function index()
    {
        $todayInHistory = $this->getTodayInHistory();

        return view('dashboard', [
            'thoughts' => $this->getThoughts(),
            'ourUsers' => $this->getOurUsers(),
            'todayInHistory' => $todayInHistory,
        ]);
    }

    public function welcome()
    {
        $thoughts = Thought::latest()->paginate(10);
        $todayInHistory = $this->getTodayInHistory();

        return view('welcome', compact('thoughts', 'todayInHistory'));
    }




    private function getOurUsers()
    {
        $currentUser = auth()->user();
        $followingsUserIDs = $currentUser->followings()->pluck('id');
        $blockedUserIDs = $currentUser->blockings()->pluck('id');
        $blockedByUsers = $currentUser->blockedUsers()->pluck('id');



        return User::whereNotIn('id', $followingsUserIDs)
            ->whereNotIn('id', $blockedUserIDs)
            ->whereNotIn('id', $blockedByUsers)
            ->where('id', '!=', $currentUser->id)
            ->inRandomOrder()
            ->get()
            ->unique('id');
    }


    private function getThoughts()
    {
        $currentUser = auth()->user();
        

        $followingsIDs =  auth()->user()->followings()->pluck('user_id');  

        $blockedIDs = auth()->user()->blockings()->pluck('user_id');
        $blockedByUsers = auth()->user()->blockedUsers()->pluck('blocks_id');

      
        $userIdsToInclude = $followingsIDs->concat([$currentUser->id]);
        return Thought::whereIn('user_id', $userIdsToInclude)
            ->whereNotIn('user_id', $blockedIDs)
            ->whereNotIn('user_id', $blockedByUsers)
            ->orWhere('user_id', $currentUser->id)  
            ->latest()
            ->paginate(8);         

    }

    private function getTodayInHistory()
    {
        $client = new Client();
        $response = $client->get('https://en.wikipedia.org/api/rest_v1/page/html/' . date('F_j'));
    
        if ($response->getStatusCode() == 200) {
            $html = $response->getBody()->getContents();
            $events = $this->extractEventsFromHtml($html, 4); 
            return $events;
        } else {
            return null;
        }
    }
    
   
   
   
    private function extractEventsFromHtml($html, $numberOfEvents = 3)
{
   
    $dom = new \DOMDocument();
    libxml_use_internal_errors(true);
    $dom->loadHTML($html);
    libxml_clear_errors();

    
    $events = [];
    $lis = $dom->getElementsByTagName('li');
    $count = 0;

    foreach ($lis as $li) {
        
        $textContent = trim($li->textContent); 

       
        $firstDotPosition = strpos($textContent, '.');

        if ($firstDotPosition !== false) {
           
            $shortenedText = substr($textContent, 0, $firstDotPosition + 1);
        } else {
          
            $shortenedText = $textContent;
        }

        $events[] = $shortenedText;

        $count++;
        if ($count >= $numberOfEvents) {
            break;
        }
    }

    return $events;
}


}

