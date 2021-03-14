<?php

namespace App\Traits\Code\Laravel;
use Illuminate\Support\Str;
 
trait formcodeTrait {

    public function formmakeColumns($tablename, $columnname, $countryscript)
    {
 
        $validate = "";
        $createcolumns = "";
        $editcolumns = "";
         
        $table = Str::lower(Str::plural($tablename));

        foreach ($columnname as $key => $value) {

            list($validate, $createcolumns,$editcolumns, $countryscript ) = $this->checkformColumnValidation($table, $value, $validate, $createcolumns, $editcolumns, $countryscript);
            
        }

       $createcolumns = $createcolumns;

        return [$validate, $createcolumns, $editcolumns, $countryscript];
    }



    
    /**
     * Checks for wether the field is required and
     * is it a file
     * 
     * @param string $table
     * @param array $value
     * @return Response
     */
    public function checkformColumnValidation($table, $value, $validate, $createcolumns, $editcolumns, $countryscript){
        
        $column = $value['column'];
        $lowersingular = Str::lower(Str::singular($table));
        $lowerplural = Str::lower(Str::plural($table));
        
        if(isset($value['required'])){
            $validate .= "";
        }
        
        
        if(isset($value['file'])){
            // list($Filecode, ) = $this->getFileCode($table, $value);
            $createcolumns .= <<<EOD
                        
                        <div class="position-relative form-group">
                            <label for="$column" class="">$column</label>
                            <input name="$column" id="id_$column" type="file" class="form-control-file">
                        </div>         
EOD;

            $getvalue = $lowerplural."->".$column;
            $editcolumns .= <<<EOD
                            
                        <div class="position-relative form-group">
                            <label for="$column" class="">$column</label>
                            <input name="$column" id="id_$column" type="file" placeholder="$column"  class="form-control-file" value="{{ $getvalue }}">
                        </div>
EOD;
        }else{

            $getvalue = $lowerplural."->".$column;

            if(Str::contains($column ,"date")){

                $createcolumns .= <<<EOD
                            
                        <div class="position-relative form-group">
                            <label for="$column" class="">$column</label>
                            <input name="$column" id="id_$column" type="date" placeholder="$column"  class="form-control" value="{{}}">
                        </div>
EOD;

                $editcolumns .= <<<EOD
                            
                        <div class="position-relative form-group">
                            <label for="$column" class="">$column</label>
                            <input name="$column" id="id_$column" type="date" placeholder="$column"  class="form-control" value="{{ $$getvalue }}">
                        </div>
EOD;

            }elseif($column == "country"|| $column == "countries"){
                $uppersingular = Str::ucfirst(Str::singular($table));
                $createcolumns .= <<<EOD
                        
                     <div class="row">
                     <div class="col-md-6">
                         <div class="position-relative form-group"><label for="$column" class="">$column</label>
                             <select name="$column" id="$column" class="form-control select">
                                 <option>Select $column</option>
                               @foreach(@App\\$uppersingular::all() as \$row)
                               <option value="{{\$row->id}}"> {{\$row->name}} ({{\$row->code}})</option>
                               @endforeach
                             </select>
                           </div>
                         
                     </div>
                     
                     <div class="col-md-6">
                         <div class="position-relative form-group"><label for="province" class="">Province</label>
                             <select name="province" id="province" class="form-control select">
                                 <option>Select Province</option>
                               
                             </select>
                           </div>
                         
                     </div>
                     <div class="col-md-6">
                         <div class="position-relative form-group"><label for="city" class="">City</label>
                             <select name="city" id="city" class="form-control select">
                                 <option>Select City</option>
                               
                             </select>
                           </div>
                         
                     </div>
                     <div class="col-md-6">
                         <div class="position-relative form-group">
                             <label for="postal_code" class="">Postal Code</label>
                             <input name="postal_code" id="postal_code" placeholder="Enter Postal Code" type="text"  class="form-control" value="{{old('postal_code')}}">
                         </div>
                     </div>
                     
                 </div>
                     
EOD;

                $editcolumns .= <<<EOD
                        
                     <div class="row">
                     <div class="col-md-6">
                         <div class="position-relative form-group"><label for="$column" class="">$column</label>
                             <select name="$column" id="$column" class="form-control select">
                                 <option>Select $column</option>
                               @foreach(@App\\$uppersingular::all() as \$row)
                               <option value="{{\$row->id}}"> {{\$row->name}} ({{\$row->code}})</option>
                               @endforeach
                             </select>
                           </div>
                         
                     </div>
                     
                     <div class="col-md-6">
                         <div class="position-relative form-group"><label for="province" class="">Province</label>
                             <select name="province" id="province" class="form-control select">
                                 <option>Select Province</option>
                               
                             </select>
                           </div>
                         
                     </div>
                     <div class="col-md-6">
                         <div class="position-relative form-group"><label for="city" class="">City</label>
                             <select name="city" id="city" class="form-control select">
                                 <option>Select City</option>
                               
                             </select>
                           </div>
                         
                     </div>
                     <div class="col-md-6">
                         <div class="position-relative form-group">
                             <label for="postal_code" class="">Postal Code</label>
                             <input name="postal_code" id="postal_code" placeholder="Enter Postal Code" type="text"  class="form-control" value="{{old('postal_code')}}">
                         </div>
                     </div>
                     
                 </div>
                     
EOD;
$countryscript = <<<EOD


        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

        <script>
                $(document).ready( function () { 
                    $('.select').select2();
                    $("#country").change(function(){
                    var id= $("#country").val();
                    $.get("{{url('/').'/states/'}}"+id, function(data, status){
                        console.log(data);
                        $('#province').empty();
                        $.each(data,function(index,value){
                        var newOption = new Option(value.name, value.id, false, false);
                            $('#province').append(newOption);
                        
                        })

                    });
            
                    });
                    $("#province").change(function(){
                    var id= $("#province").val();
                    $.get("{{url('/').'/cities/'}}"+id, function(data, status){
                        console.log(data);
                        $('#city').empty();
                        $.each(data,function(index,value){
                        var newOption = new Option(value.name, value.id, false, false);
                            $('#city').append(newOption);
                        })
                    });
                    });
                });
        </script>
EOD;
//                 $editcolumns .= <<<EOD

// EOD;
            }else{

            $createcolumns .= <<<EOD
                        
                        <div class="position-relative form-group">
                            <label for="$column" class="">$column</label>
                            <input name="$column" id="id_$column" placeholder="$column"  class="form-control" value="">
                        </div>
            
EOD;
                
                $editcolumns .= <<<EOD
                            
                            <div class="position-relative form-group">
                                <label for="$column" class="">$column</label>
                                <input name="$column" id="id_$column" placeholder="$column"  class="form-control" value="{{ $getvalue }}">
                            </div>
EOD;

            }
        }

        return [$validate, $createcolumns, $editcolumns, $countryscript];
        
    }


    public function createform($tablename, $createcolumns){

        $lowerplural = Str::lower(Str::plural($tablename));
        $lowersingular = Str::lower(Str::singular($tablename));

        $code = <<<EOD

        <div class="col-md-8">
            <div class="main-card mb-3 card">
            
                <div class="card-body"><h5 class="card-title">Add $lowersingular</h5>
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
            
                <div class="card-body"><h5 class="card-title">Edit $lowersingular</h5>
                    <form class="" method="post" action="{{route('$lowerplural.update',$$lowerplural ->id)}}" enctype="multipart/form-data">
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


