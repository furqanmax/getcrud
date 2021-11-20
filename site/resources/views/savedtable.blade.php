@extends('layouts.savedtable')

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


<div  class="container">
    <div class="row">
        <div class="col-lg-5" id="allfields" style=" float: left;">
            {{-- <button class="tablinks btn-primary" onclick="clientSideRendering()">Client Side Rendering</button>
            <button class="tablinks btn-primary" onclick="serverSideRendering()">Server Side Rendering</button> --}}
            
            <p id="zpiresponce"></p>
            {{-- <a href=""  id="Download_zip">Download zip</a> --}}
            
            <div class="" id="gettingstated" style="">
                <h3 id="titles" style="font-weight: 400;margin-bottom: 0px; font-size: 54px;"> <b> Get CRUD</b></h3>
    
                <p style="
                font-size: 14px;
                padding-top:0px;
                font-weight:300;
                padding-bottom:8px;">Makes laravel CRUD operations effortless.  </p>
                
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
                    <form id ="tableForm0" action="" method="GET" >
                        @method('PATCH')
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
                        
                        
                        <section id="section0" class="drag-sort-enable" >

                            <h5 id="inserttab" style="font-size:18px; font-weight:500; padding-bottom: 8px;"> Insert the table name, hit enter to be amazed.</h5>

                            <span id="tsave" class=" label tooltip-test" style="display: none;" onclick="tablesave()"  title="Save ">
                                <svg width="18" height="18" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M17 19H3C2.46957 19 1.96086 18.7893 1.58579 18.4142C1.21071 18.0391 1 17.5304 1 17V3C1 2.46957 1.21071 1.96086 1.58579 1.58579C1.96086 1.21071 2.46957 1 3 1H14L19 6V17C19 17.5304 18.7893 18.0391 18.4142 18.4142C18.0391 18.7893 17.5304 19 17 19Z" stroke="#959595" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M15 19V11H5V19" stroke="#959595" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M5 1V6H13" stroke="#959595" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    
                                    
                                    
                            </span>

                            <a href="{{url('history')}}">
                                <span id="thistory" class=" label tooltip-test" style="display: none;"   title="History ">

                                    <svg width="20" height="18" viewBox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1 2V8H7" stroke="#959595" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M11 5V11L15 13" stroke="#959595" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M3.51 13C4.15839 14.8404 5.38734 16.4202 7.01166 17.5014C8.63598 18.5826 10.5677 19.1066 12.5157 18.9945C14.4637 18.8824 16.3226 18.1402 17.8121 16.8798C19.3017 15.6193 20.3413 13.909 20.7742 12.0064C21.2072 10.1037 21.0101 8.11196 20.2126 6.3311C19.4152 4.55024 18.0605 3.07679 16.3528 2.13276C14.6451 1.18873 12.6769 0.825262 10.7447 1.09712C8.81245 1.36897 7.02091 2.26142 5.64 3.64L1 8" stroke="#959595" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        
                                        
                                </span>
                            </a>
                            <ul id="ultableid0" class="input_fields_wrap drag-sort-enable" >
                                <li class="" id="gggg0"  >
                                    {{-- <label for="f0">Table name</label>&nbsp;&nbsp;&nbsp;&nbsp; --}}
                                    <input type="text" placeholder="Table name" autofocus="" onkeypress="handle(event,this.id,0)" id="tablename0" name="tablename"  value="{{ $savetables->table_name }}">
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
                            <p id="pn0" class="pn" style="font-size: 12px; color: #212121;">
                                Press enter
                                <svg  viewBox="0 0 512 512" width="12" height="12" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <g id="Solid">
                                    <path d="m400 24a24 24 0 0 0 -24 24v272a32 32 0 0 1 -32 32h-174.059l47.03-47.029a24 24 0 0 0 -33.942-33.942l-88 88a24 24 0 0 0 0 33.942l88 88a24 24 0 0 0 33.942-33.942l-47.03-47.029h174.059a80 80 0 0 0 80-80v-272a24 24 0 0 0 -24-24z"/>
                                </g>
                                </svg>

                                 </p>

                        </section>
                    </form>
                </div>
            </div>
    
        

            


        </div>
        <div class="col-lg-7" id="all_code_tabs" style="display:none;  color: #959595; " >
    
    
    
            <div class="tab">
                <button class="tablinks active" style="" onclick="openCode(event, 'Controller')">Controller</button>
                <button class="tablinks"  onclick="openCode(event, 'API Resource')">API Resource & Controller</button>
                <button class="tablinks"  onclick="openCode(event, 'Table')">Table</button>
                <button class="tablinks"  onclick="openCode(event, 'Form')">Form</button>
                <button class="tablinks"  onclick="openCode(event, 'Migration')">Migration</button>
                {{-- <button class="tablinks"  onclick="openCode(event, 'Route')">Routes</button> --}}
    
    
            </div>
    
            <div id="Controller" style="display: block;" class="tabcontent p-0">
                <div style="display: none;">
                    <p class="p-0 m-0 pt-5">You can make controller using following command</p>
                <pre class="p-0 m-0">
                    <code class="p-0 m-0">
    php artisan make:controller
                    </code>
                </pre>
                </div>

               <div style="display: none;">
                <p class="p-0 m-0 pt-3">You can make model using following command</p>
                <pre class="p-0 m-0">
                    <code class="p-0 m-0">
    php artisan make:model
                    </code>
                </pre>

               </div>
                
                
                <h4 style="margin:0px; " class="pt-4">Controller code</h4>
                <p style="">Controller code contains all finctions index, create, store, edit, update and destroy.</p> 
                {{-- <button class="copy" onclick="copyCode('p1')">Copy</button>
                <pre style="border: none;" class="blog-posts" id="p1">
                    <code style="display: none;" id="phpcode" class="php">
                        <pre id="index" ></pre>
                        <pre id="create"></pre>
                        <pre id="store"></pre>
                        <pre id="show"></pre>
                        <pre id="edit"></pre>
                        <pre id="update"></pre>
                        <pre id="deletes"></pre>
                    </code>
                </pre> --}}
                
                
                    
                       
                   
                        <div class="content">
                            
                                <div id="phpservercode_copy" class="copy right-panel-link mt-2"  onclick="copyCode('phpservercode',this.id)">
                                    <i ><!-- Generator: Adobe Illustrator 19.1.0, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
                                        <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"  width="18" height="18" fill="currentColor" x="0px" y="0px"
                                            viewBox="0 0 488.3 488.3" style="enable-background:new 0 0 488.3 488.3;" xml:space="preserve">
                                        <g>
                                            <g>
                                                <path d="M314.25,85.4h-227c-21.3,0-38.6,17.3-38.6,38.6v325.7c0,21.3,17.3,38.6,38.6,38.6h227c21.3,0,38.6-17.3,38.6-38.6V124
                                                    C352.75,102.7,335.45,85.4,314.25,85.4z M325.75,449.6c0,6.4-5.2,11.6-11.6,11.6h-227c-6.4,0-11.6-5.2-11.6-11.6V124
                                                    c0-6.4,5.2-11.6,11.6-11.6h227c6.4,0,11.6,5.2,11.6,11.6V449.6z"/>
                                                <path d="M401.05,0h-227c-21.3,0-38.6,17.3-38.6,38.6c0,7.5,6,13.5,13.5,13.5s13.5-6,13.5-13.5c0-6.4,5.2-11.6,11.6-11.6h227
                                                    c6.4,0,11.6,5.2,11.6,11.6v325.7c0,6.4-5.2,11.6-11.6,11.6c-7.5,0-13.5,6-13.5,13.5s6,13.5,13.5,13.5c21.3,0,38.6-17.3,38.6-38.6
                                                    V38.6C439.65,17.3,422.35,0,401.05,0z"/>
                                        </g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
                                    </i>copy
                                </div>
                                <div style="">
                                    <pre>
                                        <code style="margin-top:-20px;" class="pb-4" id="phpservercode"></code> 
                                    </pre>
                                </div>
                            
                        </div>
                    
            </div>
    
            <div id="API Resource" class="tabcontent">
                <div class="alert alert-dark" role="alert">
                    Scrole down for API Controller Code
                </div>
                <p style="margin:0px" class="pt-4">API Resource code</p>
                <p style="">copy and paste this code in app/http/Resource/ in resource file</p>
                

                <div class="content">
                            
                    <div id="API_resource_code_copy" class="copy right-panel-link mt-2"  onclick="copyCode('API_resource_code',this.id)">
                        <i ><!-- Generator: Adobe Illustrator 19.1.0, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
                            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"  width="18" height="18" fill="currentColor" x="0px" y="0px"
                                viewBox="0 0 488.3 488.3" style="enable-background:new 0 0 488.3 488.3;" xml:space="preserve">
                            <g>
                                <g>
                                    <path d="M314.25,85.4h-227c-21.3,0-38.6,17.3-38.6,38.6v325.7c0,21.3,17.3,38.6,38.6,38.6h227c21.3,0,38.6-17.3,38.6-38.6V124
                                        C352.75,102.7,335.45,85.4,314.25,85.4z M325.75,449.6c0,6.4-5.2,11.6-11.6,11.6h-227c-6.4,0-11.6-5.2-11.6-11.6V124
                                        c0-6.4,5.2-11.6,11.6-11.6h227c6.4,0,11.6,5.2,11.6,11.6V449.6z"/>
                                    <path d="M401.05,0h-227c-21.3,0-38.6,17.3-38.6,38.6c0,7.5,6,13.5,13.5,13.5s13.5-6,13.5-13.5c0-6.4,5.2-11.6,11.6-11.6h227
                                        c6.4,0,11.6,5.2,11.6,11.6v325.7c0,6.4-5.2,11.6-11.6,11.6c-7.5,0-13.5,6-13.5,13.5s6,13.5,13.5,13.5c21.3,0,38.6-17.3,38.6-38.6
                                        V38.6C439.65,17.3,422.35,0,401.05,0z"/>
                            </g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
                        </i>copy
                    </div>
                    <div style="">
                        <pre>
                            <code style="margin-top:-20px;" class="pb-4" id="API_resource_code"></code> 
                        </pre>
                    </div>
                
                </div>
                {{-- <pre style="display: none;" id="p3">
                    <code class="php" id="apiResource"></code>
                </pre> --}}
                <p style="margin:0px" >API Controller code</p>
                <p style="">copy and paste this code in app/http/controller/api/ in controller file</p>
                {{-- <button class="copy" onclick="copyCode('API_controller_code',this.id)">Copy</button>
    
                <pre>
                    <code id="API_controller_code"> </code>
                </pre> --}}

                <div class="content">
                            
                    <div id="API_controller_code_copy" class="copy right-panel-link mt-2"  onclick="copyCode('API_controller_code',this.id)">
                        <i ><!-- Generator: Adobe Illustrator 19.1.0, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
                            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"  width="18" height="18" fill="currentColor" x="0px" y="0px"
                                viewBox="0 0 488.3 488.3" style="enable-background:new 0 0 488.3 488.3;" xml:space="preserve">
                            <g>
                                <g>
                                    <path d="M314.25,85.4h-227c-21.3,0-38.6,17.3-38.6,38.6v325.7c0,21.3,17.3,38.6,38.6,38.6h227c21.3,0,38.6-17.3,38.6-38.6V124
                                        C352.75,102.7,335.45,85.4,314.25,85.4z M325.75,449.6c0,6.4-5.2,11.6-11.6,11.6h-227c-6.4,0-11.6-5.2-11.6-11.6V124
                                        c0-6.4,5.2-11.6,11.6-11.6h227c6.4,0,11.6,5.2,11.6,11.6V449.6z"/>
                                    <path d="M401.05,0h-227c-21.3,0-38.6,17.3-38.6,38.6c0,7.5,6,13.5,13.5,13.5s13.5-6,13.5-13.5c0-6.4,5.2-11.6,11.6-11.6h227
                                        c6.4,0,11.6,5.2,11.6,11.6v325.7c0,6.4-5.2,11.6-11.6,11.6c-7.5,0-13.5,6-13.5,13.5s6,13.5,13.5,13.5c21.3,0,38.6-17.3,38.6-38.6
                                        V38.6C439.65,17.3,422.35,0,401.05,0z"/>
                            </g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
                        </i>copy
                    </div>
                    <div style="">
                        <pre>
                            <code style="margin-top:-20px;" class="pb-4" id="API_controller_code"></code> 
                        </pre>
                    </div>
                
                </div>
    
                {{-- <pre style="display: none;" id="p4">
                    <code class="php" id="apiC">
                    <code id="apiindex"></code>
                    <code id="apistore"></code>
                    <code id="apiupdate"></code>
                    <code id="apideletes"></code>
                    </code>
                    <!-- <code id="apiController"></code> -->
                </pre> --}}
            </div>
    
            <div id="Table" class="tabcontent">
                <h4 style="margin:0px" class="pt-4">Table code</h4>
                <p>shows all entries in database with edit and delete button</p>
                {{-- <button class="copy" onclick="copyCode('table_code',this.id)">Copy</button>
    
                <pre>
                    <code id="table_code"> </code>
                </pre> --}}

                <div class="content">
                            
                    <div id="table_code_copy" class="copy right-panel-link mt-2"  onclick="copyCode('table_code',this.id)">
                        <i ><!-- Generator: Adobe Illustrator 19.1.0, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
                            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"  width="18" height="18" fill="currentColor" x="0px" y="0px"
                                viewBox="0 0 488.3 488.3" style="enable-background:new 0 0 488.3 488.3;" xml:space="preserve">
                            <g>
                                <g>
                                    <path d="M314.25,85.4h-227c-21.3,0-38.6,17.3-38.6,38.6v325.7c0,21.3,17.3,38.6,38.6,38.6h227c21.3,0,38.6-17.3,38.6-38.6V124
                                        C352.75,102.7,335.45,85.4,314.25,85.4z M325.75,449.6c0,6.4-5.2,11.6-11.6,11.6h-227c-6.4,0-11.6-5.2-11.6-11.6V124
                                        c0-6.4,5.2-11.6,11.6-11.6h227c6.4,0,11.6,5.2,11.6,11.6V449.6z"/>
                                    <path d="M401.05,0h-227c-21.3,0-38.6,17.3-38.6,38.6c0,7.5,6,13.5,13.5,13.5s13.5-6,13.5-13.5c0-6.4,5.2-11.6,11.6-11.6h227
                                        c6.4,0,11.6,5.2,11.6,11.6v325.7c0,6.4-5.2,11.6-11.6,11.6c-7.5,0-13.5,6-13.5,13.5s6,13.5,13.5,13.5c21.3,0,38.6-17.3,38.6-38.6
                                        V38.6C439.65,17.3,422.35,0,401.05,0z"/>
                            </g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
                        </i>copy
                    </div>
                    <div style="">
                        <pre>
                            <code style="margin-top:-20px;" class="pb-4" id="table_code"></code> 
                        </pre>
                    </div>
                
                </div>
    
                {{-- <pre style="display: none" id="p2">
                    <code class="html" id="htmlTable"></code>
                </pre> --}}
            </div>
    
            <div id="Form" class="tabcontent">
                <div class="alert alert-dark" role="alert">
                   Scrole down for Edit form code
                </div>
                <h3>form</h3>
                <p>Create form code</p>
                {{-- <button class="copy" onclick="copyCode('Create_form_code',this.id)">Copy</button>
                <pre>
                    <code id="Create_form_code"> </code>
                </pre> --}}
    

                <div class="content">
                            
                    <div id="Create_form_code_copy" class="copy right-panel-link mt-2"  onclick="copyCode('Create_form_code',this.id)">
                        <i ><!-- Generator: Adobe Illustrator 19.1.0, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
                            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"  width="18" height="18" fill="currentColor" x="0px" y="0px"
                                viewBox="0 0 488.3 488.3" style="enable-background:new 0 0 488.3 488.3;" xml:space="preserve">
                            <g>
                                <g>
                                    <path d="M314.25,85.4h-227c-21.3,0-38.6,17.3-38.6,38.6v325.7c0,21.3,17.3,38.6,38.6,38.6h227c21.3,0,38.6-17.3,38.6-38.6V124
                                        C352.75,102.7,335.45,85.4,314.25,85.4z M325.75,449.6c0,6.4-5.2,11.6-11.6,11.6h-227c-6.4,0-11.6-5.2-11.6-11.6V124
                                        c0-6.4,5.2-11.6,11.6-11.6h227c6.4,0,11.6,5.2,11.6,11.6V449.6z"/>
                                    <path d="M401.05,0h-227c-21.3,0-38.6,17.3-38.6,38.6c0,7.5,6,13.5,13.5,13.5s13.5-6,13.5-13.5c0-6.4,5.2-11.6,11.6-11.6h227
                                        c6.4,0,11.6,5.2,11.6,11.6v325.7c0,6.4-5.2,11.6-11.6,11.6c-7.5,0-13.5,6-13.5,13.5s6,13.5,13.5,13.5c21.3,0,38.6-17.3,38.6-38.6
                                        V38.6C439.65,17.3,422.35,0,401.05,0z"/>
                            </g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
                        </i>copy
                    </div>
                    <div style="">
                        <pre>
                            <code style="margin-top:-20px;" class="pb-4" id="Create_form_code"></code> 
                        </pre>
                    </div>
                
                </div>


                <p>Edit form code</p>
                {{-- <button class="copy" onclick="copyCode('Edit_form_code',this.id)">Copy</button>
                <pre>
                    <code id="Edit_form_code"> </code>
                </pre> --}}

                <div class="content">
                            
                    <div id="Edit_form_code_copy" class="copy right-panel-link mt-2"  onclick="copyCode('Edit_form_code',this.id)">
                        <i ><!-- Generator: Adobe Illustrator 19.1.0, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
                            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"  width="18" height="18" fill="currentColor" x="0px" y="0px"
                                viewBox="0 0 488.3 488.3" style="enable-background:new 0 0 488.3 488.3;" xml:space="preserve">
                            <g>
                                <g>
                                    <path d="M314.25,85.4h-227c-21.3,0-38.6,17.3-38.6,38.6v325.7c0,21.3,17.3,38.6,38.6,38.6h227c21.3,0,38.6-17.3,38.6-38.6V124
                                        C352.75,102.7,335.45,85.4,314.25,85.4z M325.75,449.6c0,6.4-5.2,11.6-11.6,11.6h-227c-6.4,0-11.6-5.2-11.6-11.6V124
                                        c0-6.4,5.2-11.6,11.6-11.6h227c6.4,0,11.6,5.2,11.6,11.6V449.6z"/>
                                    <path d="M401.05,0h-227c-21.3,0-38.6,17.3-38.6,38.6c0,7.5,6,13.5,13.5,13.5s13.5-6,13.5-13.5c0-6.4,5.2-11.6,11.6-11.6h227
                                        c6.4,0,11.6,5.2,11.6,11.6v325.7c0,6.4-5.2,11.6-11.6,11.6c-7.5,0-13.5,6-13.5,13.5s6,13.5,13.5,13.5c21.3,0,38.6-17.3,38.6-38.6
                                        V38.6C439.65,17.3,422.35,0,401.05,0z"/>
                            </g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
                        </i>copy
                    </div>
                    <div style="">
                        <pre>
                            <code style="margin-top:-20px;" class="pb-4" id="Edit_form_code"></code> 
                        </pre>
                    </div>
                
                </div>


            </div>
    
    
            <div id="Migration" class="tabcontent">
                <h3>Migration</h3>
                <p>Migration code</p>
                <div class="content">
                    <div id="Migration_code_copy" class="copy right-panel-link mt-2"  onclick="copyCode('Migration_code',this.id)">
                        <i ><!-- Generator: Adobe Illustrator 19.1.0, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
                            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"  width="18" height="18" fill="currentColor" x="0px" y="0px"
                                viewBox="0 0 488.3 488.3" style="enable-background:new 0 0 488.3 488.3;" xml:space="preserve">
                            <g>
                                <g>
                                    <path d="M314.25,85.4h-227c-21.3,0-38.6,17.3-38.6,38.6v325.7c0,21.3,17.3,38.6,38.6,38.6h227c21.3,0,38.6-17.3,38.6-38.6V124
                                        C352.75,102.7,335.45,85.4,314.25,85.4z M325.75,449.6c0,6.4-5.2,11.6-11.6,11.6h-227c-6.4,0-11.6-5.2-11.6-11.6V124
                                        c0-6.4,5.2-11.6,11.6-11.6h227c6.4,0,11.6,5.2,11.6,11.6V449.6z"/>
                                    <path d="M401.05,0h-227c-21.3,0-38.6,17.3-38.6,38.6c0,7.5,6,13.5,13.5,13.5s13.5-6,13.5-13.5c0-6.4,5.2-11.6,11.6-11.6h227
                                        c6.4,0,11.6,5.2,11.6,11.6v325.7c0,6.4-5.2,11.6-11.6,11.6c-7.5,0-13.5,6-13.5,13.5s6,13.5,13.5,13.5c21.3,0,38.6-17.3,38.6-38.6
                                        V38.6C439.65,17.3,422.35,0,401.05,0z"/>
                            </g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
                        </i>copy
                    </div>
                    <div style="">
                        <pre>
                            <code style="margin-top:-20px;" class="pb-4" id="Migration_code"></code> 
                        </pre>
                    </div>
                </div>
            </div>
    
{{--     
            <div id="Route" class="tabcontent">
                <h3>Routes</h3>
                <p>Routes comming soon</p>
                <p>Routes code. paste this code in routes/web.php</p>

                <div class="content">
                            
                    <div id="route_code" class="copy right-panel-link mt-2"  onclick="copyCode('route_code_copy',this.id)">
                        <i ><!-- Generator: Adobe Illustrator 19.1.0, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
                            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"  width="18" height="18" fill="currentColor" x="0px" y="0px"
                                viewBox="0 0 488.3 488.3" style="enable-background:new 0 0 488.3 488.3;" xml:space="preserve">
                            <g>
                                <g>
                                    <path d="M314.25,85.4h-227c-21.3,0-38.6,17.3-38.6,38.6v325.7c0,21.3,17.3,38.6,38.6,38.6h227c21.3,0,38.6-17.3,38.6-38.6V124
                                        C352.75,102.7,335.45,85.4,314.25,85.4z M325.75,449.6c0,6.4-5.2,11.6-11.6,11.6h-227c-6.4,0-11.6-5.2-11.6-11.6V124
                                        c0-6.4,5.2-11.6,11.6-11.6h227c6.4,0,11.6,5.2,11.6,11.6V449.6z"/>
                                    <path d="M401.05,0h-227c-21.3,0-38.6,17.3-38.6,38.6c0,7.5,6,13.5,13.5,13.5s13.5-6,13.5-13.5c0-6.4,5.2-11.6,11.6-11.6h227
                                        c6.4,0,11.6,5.2,11.6,11.6v325.7c0,6.4-5.2,11.6-11.6,11.6c-7.5,0-13.5,6-13.5,13.5s6,13.5,13.5,13.5c21.3,0,38.6-17.3,38.6-38.6
                                        V38.6C439.65,17.3,422.35,0,401.05,0z"/>
                            </g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
                        </i>copy
                    </div>
                    <div style="">
                        <pre>
                            <code style="margin-top:-20px;" class="pb-4" id="route_code_copy">
        Route::resource('students', 'StudentController');
                            </code> 
                        </pre>
                    </div>
                
                </div>
            </div>
     --}}
    
    
    
    
    
    
        </div>
    </div>
</div>
    

    <p id="pn" class="pn"></p>
@endsection
