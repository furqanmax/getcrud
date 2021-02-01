<?php

namespace App\Traits\Code\Laravel;
use Illuminate\Support\Str;
 
trait tablecodeTrait {

    public function getColumnsOfTable($tablename, $columnname){
        
        $valueCode ="" ;
        $ColumnCode = "";

        foreach ($columnname as $key => $value) {

            // list($validate, $request, $destroyFileCode) = $this->checkColumnValidation($table, $value, $validate, $request, $destroyFileCode);

            if(isset($value['file'])){
                $valueCode .= '
                <td><img src="{{asset("uploads/'.Str::lower(Str::singular($tablename)).'/".$'.Str::lower(Str::singular($tablename)).'->'. $value['column'] .' )}}" width=100></td>';
            }else{
                $valueCode .="
                <td>{{\$".Str::lower(Str::singular($tablename))."->". $value['column'] ."}}</td>" ;
            }
            $ColumnCode .= "
                <th> ". $value['column'] . "</th>";

        }

        return [$valueCode, $ColumnCode];

    }




    public function tablecode($tablename, $foldername, $columnname){

        list($valueCode, $ColumnCode) = $this->getColumnsOfTable($tablename, $columnname);

        $ucfirstsingular = Str::ucfirst(Str::singular($tablename));
        $lowerplural = Str::lower(Str::plural($tablename));
        $lowersingular = Str::lower(Str::singular($tablename));


        $code = <<<EOD
        <div class="box-header">
          <div class="row mt-3">
              <div class="col-md-6">
                  <h3 class="box-title text-color">Slide Images</h3>

              </div>
              <div class="col-md-6 text-right">
                  <a href="{{route('$lowerplural.create')}}" class="btn btn-sm px-4 btn-custom">;<i class="fa fa-plus"></i>&nbsp; Add new Image</a>

              </div>
          </div>
       </div>
       <div class="box-body">
            <table id="table_id" class="table display responsive nowrap" width="100%">
                <thead>
                      <tr>
                      <th>SR NO</th><br>
                      $ColumnCode
                      <th>Action</th>
                      </tr>
                </thead>
                <tbody>
                      <?php \$i=1;?>
                  @foreach(\$$lowerplural as \$$lowersingular)
                      <tr>
                      <td>{{\$i}}</td><br>
                      
                      $valueCode

                      <td>
                          <div class="row">
                              <div class="col-md-2">
                                  <a href="{{route('$lowerplural.edit',\$$lowersingular ->id)}}" class=" " style="margin-left: 5px;"><i class="fa fa-edit icon fa-1x"></i> </a>

                              </div>
                              <div class="col-md-2">
                                  <form action="{{ route('$lowerplural.destroy',\$$lowersingular ->id)}}" method="POST">
                                      @csrf
                                      @method('DELETE')
                                      <button type="submit"  class="" style="margin-left: 5px;">
                                          <i class="fa fa-trash icon fa-1x">;</i>;</button>
                                  </form>
                              </div>
                              <div class="col-md-2">
                                  <a href="{{route('$lowerplural.show',\$$lowersingular ->id)}}" style="margin-left: 5px;" class="icon"><i class="fa fa-eye  fa-1x" ></i>&ensp;</span></a>

                              </div>
                          </div>
                      </td>
                      </tr>
                  <?php \$i++?>
                  @endforeach
                </tbody>
            </table>
        </div>

EOD;

// $replaced = Str::of($code)->replace('<', '&lt;');
// $replaceds = Str::of($replaced)->replace('>', '&gt;');
// print_r($replaced);
// return $replaceds;

return $code;

    }

}