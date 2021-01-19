<?php

namespace App\Traits\Code\Laravel;
use Illuminate\Support\Str;
 
trait controllercodeTrait {
    
    /**
     * creates column code.
     *
     * @param  string  $columnname
     * @return void
     */

    public function makeColumns($tablename, $columnname)
    {
 
        $validate = "";
        $request = "";
        $destroyFileCode = "";
        $table = Str::lower(Str::plural($tablename));

        foreach ($columnname as $key => $value) {

            list($validate, $request, $destroyFileCode) = $this->checkColumnValidation($table, $value, $validate, $request, $destroyFileCode);
            
        }

        return [$validate, $request, $destroyFileCode];
    }



    /**
     * Checks for wether the field is required and
     * is it a file
     * 
     * @param string $table
     * @param array $value
     * @return Response
     */
    public function checkColumnValidation($table, $value, $validate, $request, $destroyFileCode){
        
        
        if(isset($value['required'])){
            $validate .= "
            '" . $value['column'] . "'=>'required',";
        }
        
        
        if(isset($value['file'])){
            list($Filecode, $destroyFileCode) = $this->getFileCode($table, $value);
            $request .= $Filecode;
        }else{
            $request .= "
                $" . Str::lower(Str::plural($table)) . "->" . $value['column'] . ' = $request->' . $value['column'] . ";";
        }

        return [$validate, $request, $destroyFileCode];
        
    }



    /**
     * file code is generated
     * 
     * @param string $table
     * @param array $value
     * @return Response
     */
    public function getFileCode($table, $value){
        
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
    
        return [$Filecode, $destroyFileCode];
    }



    /**
     * generates index function code
     * 
     * @param string $tablename, $foldername, $columnname
     * @return Response
     */

    public function indexcode($tablename, $foldername, $columnname){

        $code = "

        public function index()
        {
          $" . Str::lower(Str::plural($tablename)) . " = " . Str::ucfirst(Str::singular($tablename)) . "::orderBy('updated_at','desc')->get();
          
          return view('". $foldername . Str::lower(Str::plural($tablename)) . ".index',compact('" . Str::lower(Str::plural($tablename)) . "')); 
        }";
        
        return $code;
    }



    /**
     * generates create function code
     * 
     * @param string $tablename, $foldername, $columnname
     * @return Response
     */

    public function createcode($tablename, $foldername, $columnname){

        $code = "

        public function create()
        {
          return view('" . $foldername . Str::lower(Str::plural($tablename)) . ".create');
        }";

        return $code;
    }



    /**
     * generates store function code
     * 
     * @param string $tablename, $foldername, $columnname
     * @return Response
     */

    public function storecode($tablename, $foldername, $validate, $request){

        // list($validate, $request) = $this ->makeColumns($tablename, $columnname);

        $ucfirstsingular = Str::ucfirst(Str::singular($tablename));
        $lowerplural = Str::lower(Str::plural($tablename));
        

        $code=<<<EOD
        
        
        public function store(Request \$request)
        {
           \$this->validate(\$request,
                $validate 
          ]);
          $$lowerplural  = new $ucfirstsingular();
          $request
          if($$lowerplural ->save()){
              return redirect()->back()->with('success',' $ucfirstsingular Added successfully.');
          }
          else{
              return redirect()->back()->with('unsuccess','Failed try again.');
          }
        
        }
EOD;


        return $code;
    }



    /**
     * generates show function code
     * 
     * @param string $tablename, $foldername, $columnname
     * @return Response
     */

    public function showcode($tablename, $foldername, $columnname){

        $ucfirstsingular = Str::ucfirst(Str::singular($tablename));
        $lowerplural = Str::lower(Str::plural($tablename));

        $code = <<<EOD


        public function show(\$id)
        {
          $$lowerplural = $ucfirstsingular::findOrFail(\$id);
          return view('$foldername$lowerplural.show',compact('$lowerplural'));
        };
EOD;
        return $code;
    }



    /**
     * generates edit function code
     * 
     * @param string $tablename, $foldername, $columnname
     * @return Response
     */

    public function editcode($tablename, $foldername, $columnname){

        $ucfirstsingular = Str::ucfirst(Str::singular($tablename));
        $lowerplural = Str::lower(Str::plural($tablename));

        $code = <<<EOD


        public function edit(\$id)
        {
            $$lowerplural = $ucfirstsingular::findOrFail(\$id);
            return view('$foldername$lowerplural.edit',compact('$lowerplural'));
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

    public function updatecode($tablename, $foldername, $validate, $request){

        // list($validate, $request) = $this ->makeColumns($tablename, $columnname);

        $ucfirstsingular = Str::ucfirst(Str::singular($tablename));
        $lowerplural = Str::lower(Str::plural($tablename));


        $code = <<<EOD
        
        
        public function update(Request \$request, \$id)
        {
            \$this->validate(\$request,[ 
                $validate 
            ]);

            $$lowerplural = $ucfirstsingular::findOrFail(\$id);
                $request

            if($$lowerplural ->update()){
                return redirect()->back()->with('success','  $lowerplural  Added successfully.');
            }
            else{
                return redirect()->back()->with('unsuccess','Failed try again.');
            }
            
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

    public function destroycode($tablename, $destroyFileCode){

        $ucfirstsingular = Str::ucfirst(Str::singular($tablename));
        $lowerplural = Str::lower(Str::plural($tablename));


        $code = <<<EOD
        
        
        public function destroy(\$id)
        {
            $$lowerplural = $ucfirstsingular::findOrFail(\$id);
                $destroyFileCode 
            if( $ucfirstsingular::where('id',\$id)->delete()){
                return redirect()->back()->with('success','  $lowerplural  deleted successfully.');
            }
            else{
                return redirect()->back()->with('unsuccess','Failed try again.');
            }
        }

EOD;

        return $code;
    }

   
}