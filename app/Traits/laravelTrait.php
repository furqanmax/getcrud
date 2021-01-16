<?php
 
namespace App\Traits;

use App\Traits\Code\Laravel\controllercodeTrait;
use App\Traits\Code\Laravel\tablecodeTrait;
use App\Traits\Code\Laravel\APIcodeTrait;



trait laravelTrait {
 
    use tablecodeTrait, controllercodeTrait, APIcodeTrait;


    public function composeController($tablename, $columnname) {
       $makecol = makeControllerColumns($tablename, $columnname);
       return $makecol;
    }

    public function writeToFileController() {
        
    }

    public function makeAPI($tablename, $foldername, $columnname) {

        $APIResourceCode = "";
        $APIControllerCode = "";

        list($validate, $request, $destroyFileCode, $apiResourceCode) = $this->APImakeColumns($tablename, $columnname);

        $code = $this->APIindexcode($tablename, $foldername, $columnname);
        
        $code .= $this->APIstorecode($tablename, $foldername, $validate, $request);
        $code .= $this->APIupdatecode($tablename, $foldername, $validate, $request);
        
        $code .= $this->APIdestroycode($tablename, $destroyFileCode);

        $ResourceCode = $this->APIResource($apiResourceCode);
        $ControllerCode = $code;
        return [$ControllerCode, $ResourceCode];
    }

    // public function checkControllerCheckBox() {

    // }

    
    public function makeTable($tablename, $foldername, $columnname) {

        $getTableCode = $this->tablecode($tablename, $foldername, $columnname);

        return $getTableCode;
    }


    public function makeController($tablename, $foldername, $columnname) {
        
        $controller_code = "";

        list($validate, $request, $destroyFileCode) = $this->makeColumns($tablename, $columnname);

        $code = $this->indexcode($tablename, $foldername, $columnname);
        $code .= $this->createcode($tablename, $foldername, $columnname);
        $code .= $this->storecode($tablename, $foldername, $validate, $request);
        $code .= $this->showcode($tablename, $foldername, $columnname);
        $code .= $this->editcode($tablename, $foldername, $columnname);
        $code .= $this->updatecode($tablename, $foldername, $validate, $request);
        $code .= $this->destroycode($tablename, $destroyFileCode);

        $controller_code .= $code;

        return $controller_code;
    }


 
}