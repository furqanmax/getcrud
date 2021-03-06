@extends('layouts.playground')

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



    <div id="allfields" style="width: 45%; float: left;background:#fff;padding:25px;">
        {{-- <button class="tablinks btn-primary" onclick="clientSideRendering()">Client Side Rendering</button>
        <button class="tablinks btn-primary" onclick="serverSideRendering()">Server Side Rendering</button> --}}
        
        <p id="zpiresponce"></p>
        {{-- <a href=""  id="Download_zip">Download zip</a> --}}
        
        <div class="alert alert-warning" id="gettingstated" style="background-color:#013BF7;  color:white; display:block;">
            <h1 id="titles" style="margin-bottom: 0px; font-size: 48px;
            font-weight: 400;
            letter-spacing: -.5px;
            line-height: 56px;">Getting started</h1>

            <p style="color: white;
            
            font-size: 16px;
            line-height: 1.8;
            padding: 16px 0 24px;">Simply type table name in the text field below and press enter and then type columns in the text field and again press enter to generate code. </p>
        </div>
        {{-- <div class="alert alert-primary" role="alert">
            <h4 class="alert-heading">Well done!</h4>
            <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
            <hr>
            <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>
          </div> --}}
        <div id="downloadzip" style="display:none;">
            <button class="tablinks btn-primary "  style="margin-bottom:10px" onclick="writeanddownloadzip()">Generate And Download zip</button>
        <p class="alert alert-primary" style="color: #5f6368;
            font-size: 14px;
            line-height: 1.5; margin-bottom:30px">Once all the columns are entered click on the button above to download zip file</p>
        
        </div>
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
                                <input type="text" placeholder="Table name" autofocus="" onkeypress="handle(event,this.id,0)" id="tablename0" name="tablename" oninput="myFunction()">
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
                        <p id="pn0" class="pn" style="font-size: 16px; color: #212121;"><b>Press enter to add column.</b></p>
                    </section>
                </form>
            </div>
        </div>

    
    </div>
    <div style="width: 50%; float: left; color: #444; margin-left: 20px;" >



        <div class="tab">
            <button class="tablinks active" style="" onclick="openCode(event, 'Controller')">Controller</button>
            <button class="tablinks"  onclick="openCode(event, 'API Resource')">API Resource & Controller</button>
            <button class="tablinks"  onclick="openCode(event, 'Table')">Table</button>
            <button class="tablinks"  onclick="openCode(event, 'Form')">Form</button>
            <button class="tablinks"  onclick="openCode(event, 'SQL query')">Routes</button>


        </div>

        <div id="Controller" style="display: block;" class="tabcontent">
            <!-- <p>Controller code</p> -->
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
            <p style="margin:0px">API Resource code</p>
            <p style="font-size: 12px;">copy and paste this code in app/http/Resource/ in resource file</p>
            <button class="copy" onclick="copyCode('p3')">Copy</button>

            <pre>
                <code id="API_resource_code"> </code>
            </pre>

            <pre style="display: none;" id="p3">
                <code class="php" id="apiResource"></code>
            </pre>
            <p style="margin:0px">API Controller code</p>
            <p style="font-size: 12px;">copy and paste this code in app/http/controller/api/ in controller file</p>
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
            <p>Index table code</p>
            <button class="copy" onclick="copyCode('p2')">Copy</button>

            <pre>
                <code id="table_code"> </code>
            </pre>

            <pre style="display: none" id="p2">
                <code class="html" id="htmlTable"></code>
            </pre>
        </div>

        <div id="Form" class="tabcontent">
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




        <!-- <div id="API Resource" class="tabcontent">
  <p style="margin:0px">API Resource code</p>
  <p style="font-size: 12px;">copy and paste this code in app/http/Resource/ in resource file</p>
  <button class="copy"  onclick="copyCode('p3')">Copy</button>
  <pre id="p3">
      <code id="apiResource"></code>
  </pre>
</div> -->


        <div id="SQL query" class="tabcontent">
            <h3>Routes</h3>
            <p>Routes comming soon</p>
            {{-- <p>Routes code. paste this code in routes/web.php</p> --}}
        </div>





        <!-- <p>Controller code</p>
<pre style="border: none;"  class="prettyprint">
    <code  class="lang-php">
    <pre id="index" ></pre>
    <pre id="create"></pre>
    <pre id="store"></pre>
    <pre id="show"></pre>
    <pre id="edit"></pre>
    <pre id="update"></pre>
    <pre id="deletes"></pre>
</code>
</pre> -->

    </div>
    <p id="pn" class="pn"></p>
@endsection
