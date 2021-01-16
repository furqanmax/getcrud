<?php

namespace App\Traits\Code\Laravel;
use Illuminate\Support\Str;
 
trait APIcodeTrait {

    /**
     * creates column code.
     *
     * @param  string  $columnname
     * @return void
     */

    public function APIResource($apiResourceCode)
    {
        $code = <<<EOD
        public function toArray(\$request)
        {
            \$url=URL::to('/');
            return [
                'id' =>\$this->id,

                    $apiResourceCode
                   
            ];
        }

EOD;
    }




    /**
     * creates column code.
     *
     * @param  string  $columnname
     * @return void
     */

    public function APImakeColumns($tablename, $columnname)
    {
 
        $validate = "";
        $request = "";
        $destroyFileCode = "";
        $apiResourceCode = "";
        $table = Str::lower(Str::plural($tablename));

        foreach ($columnname as $key => $value) {

            list($validate, $request, $destroyFileCode, $apiResourceCode) = $this->APIcheckColumnValidation($table, $value, $validate, $request, $destroyFileCode, $apiResourceCode);
            
        }

        return [$validate, $request, $destroyFileCode, $apiResourceCode];
    }



    /**
     * Checks for wether the field is required and
     * is it a file
     * 
     * @param string $table
     * @param array $value
     * @return Response
     */
    public function APIcheckColumnValidation($table, $value, $validate, $request, $destroyFileCode, $apiResourceCode){
        
        
        if(isset($value['required'])){
            $validate .= "
            '" . $value['column'] . "'=>'required',";
        }
        
        
        if(isset($value['file'])){
            list($Filecode, $destroyFileCode, $apiResourcefileCode) = $this->APIgetFileCode($table, $value);
            $request .= $Filecode;
            $apiResourceCode .= $apiResourcefileCode;
        }else{
            $request .= "
                $" . Str::lower(Str::plural($table)) . "->" . $value['column'] . ' = $request->' . $value['column'] . ";";
            
            $apiResourceCode .= "'". $value['column'] ."' => \$this->". $value['column'] .",";
        }

        return [$validate, $request, $destroyFileCode, $apiResourceCode];
        
    }



    /**
     * file code is generated
     * 
     * @param string $table
     * @param array $value
     * @return Response
     */
    public function APIgetFileCode($table, $value){
        
        $column = $value['column'];

        $Filecode=<<<EOD

        if(\$request->file('$column')) {
            \$upload = \$request->file('$column');
            \$fileformat = time().\$upload->getClientOriginalName();
            if (\$upload->move('uploads/$table/', \$fileformat)) {
                $$table->$column = \$fileformat;
            }
        }

EOD;

        $destroyFileCode = <<<EOD
        if($$table->$column !=="no-image.png"){
            unlink('uploads/$table/'.$$table->$column );
        }
EOD;

        $apiResourcefileCode = <<<EOD
        '$column' => \$url."/uploads/$table/".\$this->$column,
EOD;
    
        return [$Filecode, $destroyFileCode, $apiResourcefileCode];
    }



    /**
     * generates index function code
     * 
     * @param string $tablename, $foldername, $columnname
     * @return Response
     */

    public function APIindexcode($tablename, $foldername, $columnname){

        $code = "


        public function index()
        {

            return  ". Str::ucfirst(Str::singular($tablename)) ."Resource::collection( ". Str::ucfirst(Str::singular($tablename)) . "::all());

        }";
        
        return $code;
    }




    /**
     * generates store function code
     * 
     * @param string $tablename, $foldername, $columnname
     * @return Response
     */

    public function APIstorecode($tablename, $foldername, $validate, $request){

     

        $ucfirstsingular = Str::ucfirst(Str::singular($tablename));
        $lowerplural = Str::lower(Str::plural($tablename));
        

        $code=<<<EOD
        
        
        public function store(Request \$request)
        {
            \$this->validate([
               
                $validate

            ]);
            $$lowerplural = new $ucfirstsingular();
            
            $request

            if($$lowerplural ->save()){
                return response()->json([ 
                        
                    'status'=>'S',
                        
                ]);
            }
            else{
                return response()->json([ 
            
                    'status'=>'F',            
                        
                ]);
            }

        }
EOD;


        return $code;
    }




    /**
     * generates update function code
     * 
     * @param string $tablename, $foldername, $columnname
     * @return Response
     */

    public function APIupdatecode($tablename, $foldername, $validate, $request){

   

        $ucfirstsingular = Str::ucfirst(Str::singular($tablename));
        $lowerplural = Str::lower(Str::plural($tablename));


        $code = <<<EOD
        
        
        public function update(Request \$request, \$id)
        {
          \$this->validate(\$request,[
                $validate
          ]);
        
          $$lowerplural=$ucfirstsingular::findOrFail(\$id);
               
            $request
        
          if(\$item->update()){
             return [
                 'status' => 'S',
             ];
          }else{
              return [
                  'status' => 'F',
              ];
          }
          return \$request;   
             
        }
EOD;

        return $code;
    }



    /**
     * generates destroy function code
     * 
     * @param string $tablename, $foldername, $columnname
     * @return Response
     */

    public function APIdestroycode($tablename, $destroyFileCode){

        $ucfirstsingular = Str::ucfirst(Str::singular($tablename));
        $lowerplural = Str::lower(Str::plural($tablename));


        $code = <<<EOD
        
        
        public function destroy(\$id)
        {
            $$lowerplural = $ucfirstsingular::findOrFail(\$id);
                $destroyFileCode 
            if( $ucfirstsingular::where('id',\$id)->delete()){
                return "S";
            }
            else{
                return "F";
            }
        }

EOD;

        return $code;
    }

   
}