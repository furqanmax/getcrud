<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Storage::put('file.txt', 'Your name');
        return view('playground');
    }
    public function savefile(Request $request)
    {
        // code = $request->asdf;
        $response = array(
            'status' => 'success',
            'msg' => $request->message,
        );
        Storage::put('cont.txt', $request->message);
        return response()->json($response);
        
    }
}
