<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use File;
use App\Traits\getDataTrait;
use App\Traits\laravelTrait;


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



    public function makecontrollerclient(Request $request)
    {
        // code is generated in javascript at client side and complet code is sent 

        $response = array(
            'status' => 'success',
            'msg' => $request->message,
        );
        Storage::append('second.txt', $request->message);

    }

    use getDataTrait;
    use laravelTrait;
    public function makecontrollerserver(Request $request)
    {
       
        
        $index = "";

        //  code is generated at server side
        $getCheckboxes = $this->getControllerCheckBox($request);
        $TableName = $this->getTable($request);
        $folderName = $this->getfolder($request);
        $allcolumns = $this->getColumns($request); 

        $controllerCode = $this->makeController($TableName, $folderName, $allcolumns); 

        $controllerCode = $this->makeTable($TableName, $folderName, $allcolumns);

        list($APIcontrollercode, $APIResourcecode) = $this->makeAPI($TableName, $folderName, $allcolumns); 

        $controllerCode .= $APIcontrollercode.$APIResourcecode;

        // foreach($allcolumns as $value){
        //     $index .= '$' . $value . '->' . $value . ' = $request->' . $value . ';<br>';
        // }
        // $index = "";
        // foreach ($request->mytext as $key => $value) {
        
        //     // ProductStock::create($value);
        //     // Storage::put('second.txt', $value);

            

        //     foreach($value as $v){

        //         $index .= '

        //                 $' . $v . '->' . $v . ' = $request->' . $v . ';<br>';
                
        //     }


            // $data =  $value; 
            
        // }
        Storage::append('second.txt', $controllerCode);
        return response($controllerCode);
        // // Storage::put('second.txt', $data);
        
       
    }
}
