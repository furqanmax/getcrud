@extends('layouts.visitorsplayground')

@section('content')
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div> --}}


<div class="container">
    <div class="row">
        <div class="col-lg-5" id="allfields" style=" float: left;">
            {{-- <button class="tablinks btn-primary" onclick="clientSideRendering()">Client Side Rendering</button>
            <button class="tablinks btn-primary" onclick="serverSideRendering()">Server Side Rendering</button> --}}
            
            <p id="zpiresponce"></p>
            {{-- <a href=""  id="Download_zip">Download zip</a> --}}
            
            <div class="" id="gettingstated" style="">
                <h1 id="titles" style="margin-bottom: 0px; font-size: 48px;
                font-weight: 400;
                letter-spacing: -.5px;
                line-height: 56px;"> <b> Get CRUD</b></h1>
    
                <p style="
                font-size: 14px;
                line-height: 1.8;
                padding: 16px 0 24px;">Makes laravel CRUD operations effertless. <br> <b>Start with inserting table name and press enter to see magic.</b>  </p>
                
            </div>
            {{-- <div class="alert alert-primary" role="alert">
                <h4 class="alert-heading">Well done!</h4>
                <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
                <hr>
                <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>
              </div> --}}
          
            <div class="tab " style="display:none">
                <div  class="tab_wrap">
                    <div id="tabdivid0">
                        <button id="tabbtn0"  class="tablelinks active" onclick="opentable(event, 'table0',0)" style="font-size: 13px;  ">Table0</button><button id="removetab0" onclick="removetab(event, this.id,0)">x</button>
                    </div>
                    
                </div>
                <button class="tablelinks"  onclick="addtable(event)">+</button>
            </div>
            <div class="table_wrap">
                <div class="tablecontent" id="table0">
                    <form id ="tableForm0" action="" method="GET">
                        @csrf
                        <div style="display: none">
                            <input type="checkbox" checked="true" id="selectAll" name="selectAll" onclick="selectAllCheckboxes()">
                            <input type="checkbox" checked="true" id="indexc" name="indexc" onclick="fun_handle()"> <label for="indexc"> Index </label> &nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="checkbox" checked="true" id="createc" name="createc" onclick="fun_handle()"> <label for="createc"> create </label> &nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="checkbox" checked="true" id="storec" name="storec" onclick="fun_handle()"> <label for="storec"> store </label> &nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="checkbox" checked="true" id="showc" name="showc" onclick="fun_handle()"> <label for="showc"> show </label> &nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="checkbox" checked="true" id="editc" name="editc" onclick="fun_handle()"> <label for="editc"> edit </label> &nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="checkbox" checked="true" id="updatec" name="updatec" onclick="fun_handle()"> <label for="updatec"> update </label> &nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="checkbox" checked="true" id="deletec" name="deletec" onclick="fun_handle()"> <label for="deletec"> delete </label> &nbsp;&nbsp;&nbsp;&nbsp;
                        </div>
                        <br>
                        
                        <section id="section0" class="drag-sort-enable" >
                            <ul id="ultableid0" class="input_fields_wrap drag-sort-enable" >
                                <li class="" id="gggg0"  >
                                    {{-- <label for="f0">Table name</label>&nbsp;&nbsp;&nbsp;&nbsp; --}}
                                    <input type="text" placeholder="Table name" autofocus="" onkeypress="handle(event,this.id,0)" id="tablename0" name="tablename" >
                                    {{-- <input type="text" placeholder="Folder name" id="folder" name="foldername" oninput="myFunction()"> --}}
                                </li>
                                <!-- <button class="add_field_button">Add col</button> -->
                                {{-- <li class="list-item dragdots" id="hcol0"  style="display: none;">
                                    <input type="text" id="0"  placeholder="column name" autofocus="" onkeypress="handle(event,this.id)" name="textfieldcolumn[0]" oninput="myFunction()">
                                    <input type="checkbox" id="f0" name="checkboxfile[0]" onclick="myFunction()">
                                    <label for="f0">file</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="checkbox" id="r0" name="checkbioxrequired[0]" onclick="myFunction()">
                                    <label for="r0">required</label>
                                </li> --}}
                                
                            </ul>
                            <p id="pn0" class="pn" style="font-size: 12px; color: #212121;">Press enter </p>
                        </section>
                    </form>
                </div>
            </div>
    
        
        </div>
        <div class="col-lg-7" style=" float: left; color: #959595; " >
    
    
    
            <div class="tab">
                <button class="tablinks active" style="" onclick="openCode(event, 'Controller')">Controller</button>
                <button class="tablinks"  onclick="openCode(event, 'API Resource')">API Resource & Controller</button>
                <button class="tablinks"  onclick="openCode(event, 'Table')">Table</button>
                <button class="tablinks"  onclick="openCode(event, 'Form')">Form</button>
                <button class="tablinks"  onclick="openCode(event, 'SQL query')">Routes</button>
    
    
            </div>
    
            <div id="Controller" style="display: block;" class="tabcontent p-0">
                <h4 style="margin:0px; " class="pt-4">Controller code</h4>
                <p style="">Controller code contains all finctions index, create, store, edit, update and destroy.</p> 
                <button class="copy" onclick="copyCode('p1')">Copy</button>
                <pre style="border: none;" id="p1">
                    <code style="display: none;" id="phpcode" class="php">
                        <pre  id="index" ></pre>
                        <pre id="create"></pre>
                        <pre id="store"></pre>
                        <pre id="show"></pre>
                        <pre id="edit"></pre>
                        <pre id="update"></pre>
                        <pre id="deletes"></pre>
                    </code>
                </pre>
                <pre>
                    <code id="phpservercode"></code>
                </pre>
            </div>
    
            <div id="API Resource" class="tabcontent">
                <div class="alert alert-dark" role="alert">
                    Scrole down for API Controller Code
                </div>
                <p style="margin:0px" class="pt-4">API Resource code</p>
                <p style="">copy and paste this code in app/http/Resource/ in resource file</p>
                <button class="copy" onclick="copyCode('p3')">Copy</button>
    
                <pre>
                    <code id="API_resource_code"> </code>
                </pre>
    
                <pre style="display: none;" id="p3">
                    <code class="php" id="apiResource"></code>
                </pre>
                <p style="margin:0px" >API Controller code</p>
                <p style="">copy and paste this code in app/http/controller/api/ in controller file</p>
                <button class="copy" onclick="copyCode('p4')">Copy</button>
    
                <pre>
                    <code id="API_controller_code"> </code>
                </pre>
    
                <pre style="display: none;" id="p4">
                    <code class="php" id="apiC">
                    <code id="apiindex"></code>
                    <code id="apistore"></code>
                    <code id="apiupdate"></code>
                    <code id="apideletes"></code>
                    </code>
                    <!-- <code id="apiController"></code> -->
                </pre>
            </div>
    
            <div id="Table" class="tabcontent">
                <h4 style="margin:0px" class="pt-4">Table code</h4>
                <p>shows all entries in database with edit and delete button</p>
                <button class="copy" onclick="copyCode('p2')">Copy</button>
    
                <pre>
                    <code id="table_code"> </code>
                </pre>
    
                <pre style="display: none" id="p2">
                    <code class="html" id="htmlTable"></code>
                </pre>
            </div>
    
            <div id="Form" class="tabcontent">
                <div class="alert alert-dark" role="alert">
                   Scrole down for Edit form code
                </div>
                <h3>form</h3>
                <p>Create form code</p>
                <pre>
                    <code id="Create_form_code"> </code>
                </pre>
    
                <p>Edit form code</p>
                <pre>
                    <code id="Edit_form_code"> </code>
                </pre>
            </div>
    
    
    
    
    
            <div id="SQL query" class="tabcontent">
                <h3>Routes</h3>
                <p>Routes comming soon</p>
                {{-- <p>Routes code. paste this code in routes/web.php</p> --}}
            </div>
    
    
    
    
    
    
    
        </div>
    </div>
</div>
    

    <p id="pn" class="pn"></p>
@endsection
