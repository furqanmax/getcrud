<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use File;
use App\Traits\getDataTrait;
use App\Traits\laravelTrait;
use App\Mail\ContactMail;
use App\Mail\ThankMail;
use Mail;
use App\Savetable;

class TsaveController extends Controller
{

    use getDataTrait, laravelTrait;

        /** 
         * Display a listing of the resource. 
         * @return \Illuminate\Http\Response 
         */  
        public function index()
        {
          $savetables = Savetable::orderBy('updated_at','desc')->get();
          
          return view('history',compact('savetables')); 
        }
        

        /** 
        * Show the form for creating a new resource. 
        * @return \Illuminate\Http\Response  
        */  
        public function create()
        {
          return view('savetables.create');
        }        


        /** 
         * Store a newly created resource in storage. 
         * 
         * @param  \Illuminate\Http\Request   $request 
         * @return \Illuminate\Http\Response 
         */  
        public function store(Request $request)
        {
           $this->validate($request,[
                 
          ]);

        $getCheckboxes = $this->getControllerCheckBox($request);
        $TableName = $this->getTable($request);
        $folderName = $this->getfolder($request);
        $allcolumns = $this->getColumns($request); 

        //   $TableName = $this->getTable($request);
        //   $allcolumns = $this->getColumns($request); 
        //   $allcolumns = implode(", ", $allcolumns);

          $savetables  = new Savetable();
          
            $savetables->table_name = $TableName;
            $savetables->columns = json_encode($allcolumns);

          if($savetables ->save()){
              return response()->json([
                'status' => "Success",
            ]);
          }
          else{
              return response()->json([
                'status' => "Failed",
            ]);
          }
        
        }


        /** 
         * Display the specified resource. 
         * @param  int  $id 
         * @return \Illuminate\Http\Response 
         */  
        public function show($id)
        {
          $savetables = Savetable::findOrFail($id);
          return view('savetables.show',compact('savetables'));
        }


        /** 
         * Show the form for editing the specified resource. 
         * @param  int  $id 
         * @return  \Illuminate\Http\Response 
         */  
        public function edit($id)
        {
            $savetables = Savetable::findOrFail($id);
            return view('savetables.edit',compact('savetables'));
        }        


        /** 
         * Update the specified resource in storage. 
         * @param  \Illuminate\Http\Request   $request 
         * @param  int  $id 
         * @return \Illuminate\Http\Response 
         */  
        public function update(Request $request, $id)
        {
            $this->validate($request,[ 
                 
            ]);

            $savetables = Savetable::findOrFail($id);
                
            $savetables->table_name = $request->table_name;
            $savetables->columns = $request->columns;

            if($savetables ->update()){
                return redirect()->back()->with('success','  savetables  Added successfully.');
            }
            else{
                return redirect()->back()->with('unsuccess','Failed try again.');
            }
            
        }        


        /** 
         * Remove the specified resource from storage. 
         * @param  int  $id 
         * @return  \Illuminate\Http\Response 
         */  
        public function destroy($id)
        {
            $savetables = Savetable::findOrFail($id);
                 
            if( Savetable::where('id',$id)->delete()){
                return redirect()->back()->with('success','  savetables  deleted successfully.');
            }
            else{
                return redirect()->back()->with('unsuccess','Failed try again.');
            }
        }
    }