<?php

namespace App\Traits\Code\Laravel;
use Illuminate\Support\Str;
 
trait formcodeTrait {

    public function formmakeColumns($tablename, $columnname)
    {
 
        $validate = "";
        $createcolumns = "";
        $editcolumns = "";
         
        $table = Str::lower(Str::plural($tablename));

        foreach ($columnname as $key => $value) {

            list($validate, $createcolumns,$editcolumns ) = $this->checkformColumnValidation($table, $value, $validate, $createcolumns, $editcolumns);
            
        }

        return [$validate, $createcolumns, $editcolumns];
    }



    
    /**
     * Checks for wether the field is required and
     * is it a file
     * 
     * @param string $table
     * @param array $value
     * @return Response
     */
    public function checkformColumnValidation($table, $value, $validate, $createcolumns, $editcolumns){
        
        $column = $value['column'];
        $lowersingular = Str::lower(Str::singular($table));
        
        if(isset($value['required'])){
            $validate .= "";
        }
        
        
        if(isset($value['file'])){
            // list($Filecode, ) = $this->getFileCode($table, $value);
            $createcolumns .= <<<EOD
                        
                        <div class="position-relative form-group">
                            <label for="exampleFile" class="">$column</label>
                            <input name="$column" id="id_$column" type="file" class="form-control-file">
                        </div>         
EOD;
        }else{

            $getvalue = $lowersingular."->".$column;

            if($column == "date"){

                $createcolumns .= <<<EOD
                            
                        <div class="position-relative form-group">
                            <label for="" class="">$column</label>
                            <input name="$column" id="id_$column" type="date" placeholder="$column"  class="form-control" value="{{}}">
                        </div>
EOD;

                $editcolumns .= <<<EOD
                            
                        <div class="position-relative form-group">
                            <label for="" class="">$column</label>
                            <input name="$column" id="id_$column" type="date" placeholder="$column"  class="form-control" value="{{$getvalue}}">
                        </div>
EOD;

            }else{

            $createcolumns .= <<<EOD
                        
                        <div class="position-relative form-group">
                            <label for="" class="">$column</label>
                            <input name="$column" id="id_$column" placeholder="$column"  class="form-control" value="">
                        </div>
            
EOD;
                
                $editcolumns .= <<<EOD
                            
                            <div class="position-relative form-group">
                                <label for="" class="">$column</label>
                                <input name="$column" id="id_$column" placeholder="$column"  class="form-control" value="{{$getvalue}}">
                            </div>
EOD;

            }
        }

        return [$validate, $createcolumns, $editcolumns];
        
    }


    public function createform($tablename, $createcolumns){

        $lowerplural = Str::lower(Str::plural($tablename));

        $code = <<<EOD
        <div class="col-md-8">
            <div class="main-card mb-3 card">
            // @include('partials.alert')
                <div class="card-body"><h5 class="card-title">Add Sectors</h5>
                    <form class="" method="post" action="{{route('$lowerplural.store')}}" enctype="multipart/form-data">
                    @csrf
                        $createcolumns
                        <button class="mt-1 btn btn-primary" type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
EOD;
        return $code;
    }


    public function editform($tablename, $editcolumns){

        $lowerplural = Str::lower(Str::plural($tablename));
        $lowersingular = Str::lower(Str::singular($tablename));

        $code = <<<EOD
        <div class="col-md-8">
            <div class="main-card mb-3 card">
            // @include('partials.alert')
                <div class="card-body"><h5 class="card-title">Add Sectors</h5>
                    <form class="" method="post" action="{{route('$lowerplural.update',$$lowersingular ->id)}}" enctype="multipart/form-data">
                    @csrf
                        $editcolumns
                        <button class="mt-1 btn btn-primary" type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
EOD;

return $code;
    }



}


