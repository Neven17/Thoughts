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
        

        $followingsIDs =  auth()->user()->followings()->pluck('user_id');  //dobiti cemo ids sve koje pratimo, pluck c especificno ciljati na taj stupac

        $blockedIDs = auth()->user()->blockings()->pluck('user_id');
        $blockedByUsers = auth()->user()->blockedUsers()->pluck('blocks_id');

        // Spajanje ID-ova koje pratimo s ID-om trenutnog korisnika
        $userIdsToInclude = $followingsIDs->concat([$currentUser->id]);
        return Thought::whereIn('user_id', $userIdsToInclude)
            ->whereNotIn('user_id', $blockedIDs)
            ->whereNotIn('user_id', $blockedByUsers)
            ->orWhere('user_id', $currentUser->id)  
            ->latest()
            ->paginate(8);          //latest je isto kao i orderBy('created_at', 'DESC')

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
        // Koristimo PHP Simple HTML DOM parser za parsiranje HTML-a
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($html);
        libxml_clear_errors();

        // Pronalazimo sve elemente koji sadrže događaje
        $events = [];
        $lis = $dom->getElementsByTagName('li');
        $count = 0;
        foreach ($lis as $li) {
            // Uzimamo tekst iz svakog <li> elementa
            $events[] = $li->textContent;
            $count++;
            if ($count >= $limit) {
                break;
            }
        }

        return $events;
    }
}










        // $thoughts = Thought::withCount('likes')->orderBy('created_at', 'DESC');        OVO JE BIO OBICNI DASHBOARD

       
/*
        $thoughts = Thought::when(request()->has('search'), function ($query) {

            $query->search(request('search', ''));    //ep45 Globalblade, definirao sam u thougt modelu te ovdje pozvao
        })->orderBy('created_at', 'DESC')->paginate(5);

        return view(
            'dashboard',
            [
                'thoughts' => $thoughts

            ]
        );
    }
    */











/*


    private function getThoughts()
    {
        $currentUser = auth()->user();
        //dobili smo usera koji je trenutno logiran

        $followingsIDs =  auth()->user()->followings()->pluck('user_id');  //dobiti cemo ids sve koje pratimo, pluck c especificno ciljati na taj stupac

        $blockedIDs = auth()->user()->blockings()->pluck('user_id');
        $blockedByUsers = auth()->user()->blockedUsers()->pluck('blocks_id');

       // Spajanje ID-ova koje pratimo s ID-om trenutnog korisnika
    $userIdsToInclude = $followingsIDs->concat([$currentUser->id]);
        return Thought::whereIn('user_id', $userIdsToInclude)
            ->whereNotIn('user_id', $blockedIDs)
            ->whereNotIn('user_id', $blockedByUsers)
            ->orWhere('user_id', $currentUser->id)  // Uključujemo i misli trenutnog korisnika
            ->latest()
            ->paginate(8);          //latest je isto kao i orderBy('created_at', 'DESC')




    }

    */