<?php
 
namespace App\Traits;
 
trait getDataTrait {
 
    // public function getAllData(Request $request, $allData = 'data') {
 
    // }

    public function getControllerCheckBox($request) {
        $AllCheckBoxes = array();
        $AllCheckBoxes = $request->selectAll;
        $AllCheckBoxes = $request->indexc;
        $AllCheckBoxes = $request->createc;
        $AllCheckBoxes = $request->storec;
        $AllCheckBoxes = $request->showc;
        $AllCheckBoxes = $request->editc;
        $AllCheckBoxes = $request->updatec;
        $AllCheckBoxes = $request->deletec;
        // print_r($AllCheckBoxes);
        // return $AllCheckBoxes;
    }

    public function getfolder($request) {

        $foldername = "";
        $foldername = $request->foldername;

        if ($foldername == ""){
            $foldername = "";
        }else{
            $foldername = $foldername.".";
        }
        
        return $foldername;
    }

    public function getTable($request) {
        $tabname = "";
        $tabname = $request->tablename;
        // print_r($tabname."aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa");
        return $tabname;
    }

    public function getColumns($request) {
      //  return $request;
        $index = array();
        $i = 0;
        if (!Empty($request->textfieldcolumn)){
            foreach ($request->textfieldcolumn as $key => $value) {
                $index[$key]['column']=$value;
                if(isset($request->checkboxfile)){
                    if(array_key_exists($key,$request->checkboxfile)){
                        $index[$key]['file']=$request->checkboxfile[$key];
                    }
                }

                if(isset($request->checkbioxrequired)){
                    if(array_key_exists($key, $request->checkbioxrequired)){
                        $index[$key]['required']=$request->checkbioxrequired[$key];
                    } 
                }
                

            }
        }
// print_r($index);
        return $index;
    }


 
}