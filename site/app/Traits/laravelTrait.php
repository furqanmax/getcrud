<?php
 
namespace App\Traits;

use App\Traits\Code\Laravel\controllercodeTrait;
use App\Traits\Code\Laravel\tablecodeTrait;
use App\Traits\Code\Laravel\APIcodeTrait;
use App\Traits\Code\Laravel\formcodeTrait;
use App\Traits\Code\Laravel\writetofileTrait;
use App\Traits\Code\Laravel\migrationTrait;

use App\Traits\makeZipTrait;



trait laravelTrait {
 
    use tablecodeTrait, controllercodeTrait, APIcodeTrait, formcodeTrait, writetofileTrait, makeZipTrait, migrationTrait;


    public function composeController($tablename, $columnname) {
       $makecol = makeControllerColumns($tablename, $columnname);
       return $makecol;
    }

    public function writeToFileController() {
        
    }

    public function makeForm($tablename, $columnname) {
        $countryscript="";

        list($validate, $createcolumns, $editcolumns, $countryscript) = $this->formmakeColumns($tablename, $columnname, $countryscript);

        $createcolumnscode = $this->createform($tablename, $createcolumns);
        $createcolumnscode = $createcolumnscode.$countryscript;

        $editcolumnscode = $this->editform($tablename, $editcolumns);
        $editcolumnscode = $editcolumnscode.$countryscript;

        return[$createcolumnscode, $editcolumnscode];
        
    }

    public function makeAPI($tablename, $foldername, $columnname) {

        $APIResourceCode = "";
        $APIControllerCode = "";

        list($validate, $request, $destroyFileCode, $APIResourceCode) = $this->APImakeColumns($tablename, $columnname);
        
        $code = $this->APIindexcode($tablename, $foldername, $columnname);
        
        $code .= $this->APIstorecode($tablename, $foldername, $validate, $request);
        $code .= $this->APIupdatecode($tablename, $foldername, $validate, $request);
        
        $code .= $this->APIdestroycode($tablename, $destroyFileCode);
        
        $ResourceCode = $this->APIResource($APIResourceCode);
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
        $getcountry = "";
        list($validate, $request, $destroyFileCode, $getcountry) = $this->makeColumns($tablename, $columnname, $getcountry);

        $code = $this->indexcode($tablename, $foldername, $columnname);
        $code .= $this->createcode($tablename, $foldername, $columnname);
        $code .= $this->storecode($tablename, $foldername, $validate, $request);
        $code .= $this->showcode($tablename, $foldername, $columnname);
        $code .= $this->editcode($tablename, $foldername, $columnname);
        $code .= $this->updatecode($tablename, $foldername, $validate, $request);
        $code .= $this->destroycode($tablename, $destroyFileCode);

        $controller_code .= $code.$getcountry;

        return [$controller_code, $getcountry];
    }

    public function startwrite($TableName, $folderName, $controllerCode, $tableCode, $APIcontrollercode, $APIResourcecode, $createFormCode, $editFormCode, $getcountry){
        // $code = $this->makeDirectories($TableName, $folderName, $controllerCode, $tableCode, $APIcontrollercode, $APIResourcecode, $createFormCode, $editFormCode);
        $code = $this->writeController($TableName, $folderName, $controllerCode, $getcountry);
        $code .= $this->writeTable($TableName, $folderName, $tableCode);
        $code .= $this->writecreate($TableName, $folderName, $createFormCode);
        $code .= $this->writeEdit($TableName, $folderName, $editFormCode);
        $code = $this->downloadZip($productPath = '', $dirName = '', $overwrite = false);
        return $code;
    }

    public function makeZip(){
        $getzipstatus = $this->downloadZip($productPath = '', $dirName = '', $overwrite = false);

        return $getzipstatus;
    }

    public function makeMigration($tablename, $columnname){

        $makeMigrationCode = $this->migrationCode($tablename, $columnname);

        return $makeMigrationCode;
    }


 
}