<?php

namespace App\Traits\Code\Laravel;
use Illuminate\Support\Str;
 
trait migrationTrait {

    public function getColumnsOfMigration($tablename, $columnname){
        
        $valueCode ="" ;
        $ColumnCode = "";

        foreach ($columnname as $key => $value) {

            // list($validate, $request, $destroyFileCode) = $this->checkColumnValidation($table, $value, $validate, $request, $destroyFileCode);
            
            $valueCode .="
                \$table->string('".$value['column']."');" ;

            // if(isset($value['file'])){
            //     $valueCode .= '
            //             <td>
            //                 <img src="{{asset("uploads/'.Str::lower(Str::singular($tablename)).'/".$'.Str::lower(Str::singular($tablename)).'->'. $value['column'] .' )}}" width=100>
            //             </td>';
            // }else{
            //     $valueCode .="\n\$table->string('".$value['column']."');" ;
            // }
            $ColumnCode .= "
                        <th> ". $value['column'] . "</th>";

        }

        return [$valueCode, $ColumnCode];

    }




    public function migrationCode($tablename, $columnname){

        list($valueCode, $ColumnCode) = $this->getColumnsOfMigration($tablename, $columnname);

        $ucfirstsingular = Str::ucfirst(Str::singular($tablename));
        $lowerplural = Str::lower(Str::plural($tablename));
        $lowersingular = Str::lower(Str::singular($tablename));


        $code = <<<EOD
        

        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('$lowerplural', function (Blueprint \$table) {
                \$table->id();
                $valueCode
                \$table->timestamps();
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::drop('$lowerplural');
        }

EOD;

// $replaced = Str::of($code)->replace('<', '&lt;');
// $replaceds = Str::of($replaced)->replace('>', '&gt;');
// print_r($replaced);
// return $replaceds;

return $code;

    }

}