<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><?php echo e(__('Dashboard')); ?></div>

                <div class="card-body">
                    <?php if(session('status')): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>

                    <?php echo e(__('You are logged in!')); ?>

                </div>
            </div>
        </div>
    </div>
</div>



    <div style="width: 45%; float: left;">
        <button class="tablinks" onclick="aj()">Toggle dark mode</button>
        <div>
            <h1 id="titles" style="margin-bottom: 0px;">CRUD maker</h1>

            <p style="font-size: 14px; margin-top: 0px;">Write table name and columns in the text field.</p>
        </div>

        <input type="checkbox" checked="true" id="selectAll" onclick="selectAll()">
        <input type="checkbox" checked="true" id="indexc" onclick="fun_handle()"> <label for="indexc"> Index </label> &nbsp;&nbsp;&nbsp;&nbsp;
        <input type="checkbox" checked="true" id="createc" onclick="fun_handle()"> <label for="createc"> create </label> &nbsp;&nbsp;&nbsp;&nbsp;
        <input type="checkbox" checked="true" id="storec" onclick="fun_handle()"> <label for="storec"> store </label> &nbsp;&nbsp;&nbsp;&nbsp;
        <input type="checkbox" checked="true" id="showc" onclick="fun_handle()"> <label for="showc"> show </label> &nbsp;&nbsp;&nbsp;&nbsp;
        <input type="checkbox" checked="true" id="editc" onclick="fun_handle()"> <label for="editc"> edit </label> &nbsp;&nbsp;&nbsp;&nbsp;
        <input type="checkbox" checked="true" id="updatec" onclick="fun_handle()"> <label for="updatec"> update </label> &nbsp;&nbsp;&nbsp;&nbsp;
        <input type="checkbox" checked="true" id="deletec" onclick="fun_handle()"> <label for="deletec"> delete </label> &nbsp;&nbsp;&nbsp;&nbsp;

        <br>
        <input type="text" placeholder="Table name" autofocus="" onkeypress="tablehandle(event)" id="tablename" oninput="myFunction()">
        <input type="text" placeholder="Folder name" id="folder" oninput="myFunction()">
        <div class="input_fields_wrap" ondrop="drop(event)" ondragover="allowDrop(event)">
            <!-- <button class="add_field_button">Add col</button> -->
            <div id="hcol" draggable="true" ondragstart="drag(event)" style="display: none;">
                <input type="text" id="0" placeholder="column name" autofocus="" onkeypress="handle(event)" name="mytext[]" oninput="myFunction()">
                <input type="checkbox" id="f0" onclick="myFunction()">
                <label for="f0">file</label>&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="checkbox" id="r0" onclick="myFunction()">
                <label for="r0">required</label>
            </div>
            <p id="pn" style="font-size: 12px; color: #969696;">Press enter to add column.</p>
        </div>
    </div>
    <div style="width: 50%; float: left; color: #444; margin-left: 20px;">



        <div class="tab">
            <button class="tablinks active" onclick="openCode(event, 'Controller')">Controller</button>
            <button class="tablinks" onclick="openCode(event, 'API Resource')">API Resource & Controller</button>
            <button class="tablinks" onclick="openCode(event, 'Table')">Table</button>
            <button class="tablinks" onclick="openCode(event, 'Form')">Form</button>
            <button class="tablinks" onclick="openCode(event, 'SQL query')">SQL query</button>


        </div>

        <div id="Controller" style="display: block;" class="tabcontent">
            <!-- <p>Controller code</p> -->
            <button class="copy" onclick="copyCode('p1')">Copy</button>
            <pre style="border: none;" id="p1">
    <code id="phpcode" class="php">
    <pre  id="index" ></pre>
            <pre id="create"></pre>
            <pre id="store"></pre>
            <pre id="show"></pre>
            <pre id="edit"></pre>
            <pre id="update"></pre>
            <pre id="deletes"></pre>
            </code>
            </pre>
        </div>

        <div id="API Resource" class="tabcontent">
            <p style="margin:0px">API Resource code</p>
            <p style="font-size: 12px;">copy and paste this code in app/http/Resource/ in resource file</p>
            <button class="copy" onclick="copyCode('p3')">Copy</button>
            <pre id="p3">
      <code class="php" id="apiResource"></code>
  </pre>
            <p style="margin:0px">API Controller code</p>
            <p style="font-size: 12px;">copy and paste this code in app/http/controller/api/ in controller file</p>
            <button class="copy" onclick="copyCode('p4')">Copy</button>
            <pre id="p4">
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
            <pre id="p2">
      <code class="html" id="htmlTable"></code>
  </pre>
        </div>

        <div id="Form" class="tabcontent">
            <h3>form</h3>
            <p>Comming soon...</p>
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
            <h3>SQL query</h3>
            <p>Comming soon...</p>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\crud\resources\views/home.blade.php ENDPATH**/ ?>