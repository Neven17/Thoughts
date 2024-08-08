<?php
namespace App\Http\Controllers\Lang;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LangController extends Controller
{
    
    public function lang(Request $request, $lang)
    {
        app()->setLocale($lang);
        session()->put('locale', $lang);

        
        return back();
    }
}
