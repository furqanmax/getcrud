<?php

namespace App\Traits\Code\Laravel;
use Illuminate\Support\Str;

use Storage;
use File;
use ZipArchive;
 
trait writetofileTrait {

    public function makeDirectories($TableName, $folderName, $controllerCode, $tableCode, $APIcontrollercode, $APIResourcecode, $createFormCode, $editFormCode){
        
        // $response = Storage::makeDirectory('app/Http/Controllers');
        $table = Str::ucfirst(Str::singular($TableName));
        $path = 'app/Http/Controllers/';
        $filename = $table.'Controller.php';
        $file = $path.$filename;
    

        if(!Storage::exists($file)){

            Storage::makeDirectory($path, 0777, true, true);
            $response ="success";
            // $response = Storage::put($file, $controllerCode);
            $response = Storage::put($file, $controllerCode);
            $response ="Controller created";
        }
        else{
            $response = "file exist";
        }

        return($response); 
    }

    public function writeController($TableName, $folderName, $controllerCode){
        $table = Str::ucfirst(Str::singular($TableName));

        $path = ('username/code/app/Http/Controllers/');
        $filepath = $path;
        $file = $filepath.'/'.$table.'Controller.php';

        // Storage::makeDirectory($filepath, 0777, true, true);
        // $response ="success";
        // $response = Storage::put($file, $controllerCode);
        $response = Storage::put($file, $controllerCode);
        // $response ="Controller created";

        // return "Index.balde.php created successfully";
    }

    public function writeTable($TableName, $folderName, $tableCode){
        
        $table = Str::ucfirst(Str::singular($TableName));

        $path = ('username/code/resources/views/');
        $filepath = $path.$table;
        $file = $filepath.'/index.blade.php';

        // Storage::makeDirectory($filepath, 0777, true, true);
        // $response ="success";
        // $response = Storage::put($file, $controllerCode);
        $response = Storage::put($file, $tableCode);
        $response ="Table created created";

        // return "Index.balde.php created successfully";

    }

    public function writecreate($TableName, $folderName, $createFormCode){
        $table = Str::ucfirst(Str::singular($TableName));

        $path = ('username/code/resources/views/');
        $filepath = $path.$table;
        $file = $filepath.'/create.blade.php';

        $response = Storage::put($file, $createFormCode);

        // return "create.balde.php created successfully";
    }

    public function writeEdit($TableName, $folderName, $editFormCode){

        $table = Str::ucfirst(Str::singular($TableName));

        $path = ('username/code/resources/views/');
        $filepath = $path.$table;
        $file = $filepath.'/edit.blade.php';

        $response = Storage::put($file, $editFormCode);

        // return "edit.balde.php created successfully";
    }

    public function writeAPIResource(){
        
    }

    public function writeAPIController(){
        
    }


    

    
}