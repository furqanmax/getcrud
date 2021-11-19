<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use File;
use App\Traits\getDataTrait;
use App\Traits\laravelTrait;


class HomeController extends Controller
{

    use getDataTrait, laravelTrait;

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

    public function home()
    {
        // Storage::put('file.txt', 'Your name');
        return view('home');
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


    public function downloadFile(){

        // $abc = $this->startwrite($TableName, $folderName, $controllerCode, $tableCode, $APIcontrollercode, $APIResourcecode, $createFormCode, $editFormCode);
        
        $name ="username/res.zip";
        return Storage::download($name);

    }


    public function writAndDownloadZip(Request $request)
    {
        $index = "";
        
        //  code is generated at server side
        $getCheckboxes = $this->getControllerCheckBox($request);
        $TableName = $this->getTable($request);
        
        $folderName = $this->getfolder($request);
        $allcolumns = $this->getColumns($request); 

        list($controllerCode, $getcountry) = $this->makeController($TableName, $folderName, $allcolumns); 

        $tableCode = $this->makeTable($TableName, $folderName, $allcolumns);

        list($APIcontrollercode, $APIResourcecode) = $this->makeAPI($TableName, $folderName, $allcolumns);
        
        list($createFormCode, $editFormCode) = $this->makeForm($TableName, $allcolumns);

        $abc = $this->startwrite($TableName, $folderName, $controllerCode, $tableCode, $APIcontrollercode, $APIResourcecode, $createFormCode, $editFormCode, $getcountry);
        Storage::deleteDirectory('username/code');
        $name ="username/res.zip";
        return "File are ready to download";
        // Storage::put('second.txt', $data);
        
    }




    public function makecontrollerserver(Request $request)
    {
       
        
        $index = "";

        //  code is generated at server side
        $getCheckboxes = $this->getControllerCheckBox($request);
        $TableName = $this->getTable($request);
        $folderName = $this->getfolder($request);
        $allcolumns = $this->getColumns($request); 

        list($controllerCode, $getcountry) = $this->makeController($TableName, $folderName, $allcolumns); 

        $tableCode = $this->makeTable($TableName, $folderName, $allcolumns);

        list($APIcontrollercode, $APIResourcecode) = $this->makeAPI($TableName, $folderName, $allcolumns);
        
        list($createFormCode, $editFormCode) = $this->makeForm($TableName, $allcolumns);

        $migrationCode = $this->makeMigration($TableName, $allcolumns);
        // return $migrationCode;
        
        $filename = "download";
        
        return response()->json([
            'controller_code' => $controllerCode,
            'table_code' => $tableCode,
            'API_controller_code' => $APIcontrollercode,
            'API_resource_code' => $APIResourcecode,
            'Create_form' => $createFormCode,
            'Edit_form' => $editFormCode, 
            'Download_zip' => $filename,
            'migration_code' => $migrationCode,
        ]);
        // // Storage::put('second.txt', $data);
        
       
    }
}
