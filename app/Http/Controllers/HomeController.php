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

    
    public function makecontroller(Request $request)
    {
        if($request->ajax())
        {
            $mytext= $request->mytext;
            
       
            for($count = 0; $count < count($mytext); $count++)
            {
             $data = array(
              'mytext' => $mytext[$count],
             );
       
             $insert_data[] = $data; 
            }
       
            // ::insert($insert_data);
            Storage::put('second.txt', $insert_data);
            return response()->json([
             'success'  => ' Saved Successfully!'
            ]);
           }
    }
}
