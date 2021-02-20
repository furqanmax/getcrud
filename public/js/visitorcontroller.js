function allowDrop(ev) {
    ev.preventDefault();
}

function drag(ev) {
    ev.dataTransfer.setData("text", ev.target.id);
}

function drop(ev) {
    ev.preventDefault();
    var data = ev.dataTransfer.getData("text");
    ev.target.appendChild(document.getElementById(data));
}


document.addEventListener('DOMContentLoaded', (event) => {
    document.querySelectorAll('pre code').forEach((block) => {
        hljs.highlightBlock(block);
    });
});









/* Made with love by @fitri
 https://codepen.io/fitri/full/oWovYj/ */

function enableDragSort(listClass) {
    const sortableLists = document.getElementsByClassName(listClass);
    Array.prototype.map.call(sortableLists, (list) => { enableDragList(list) });
}

function enableDragList(list) {
    Array.prototype.map.call(list.children, (item) => { enableDragItem(item) });
}

function enableDragItem(item) {
    item.setAttribute('draggable', true)
    item.ondrag = handleDrag;
    item.ondragend = handleDrop;
}

function handleDrag(item) {
    const selectedItem = item.target,
        list = selectedItem.parentNode,
        x = event.clientX,
        y = event.clientY;

    selectedItem.classList.add('drag-sort-active');
    let swapItem = document.elementFromPoint(x, y) === null ? selectedItem : document.elementFromPoint(x, y);

    if (list === swapItem.parentNode) {
        swapItem = swapItem !== selectedItem.nextSibling ? swapItem : swapItem.nextSibling;
        list.insertBefore(selectedItem, swapItem);
    }
}

function handleDrop(item) {
    item.target.classList.remove('drag-sort-active');
    var parentid = document.getElementById(item).parentElement.id;
    var parentid = document.getElementById(parentid).parentElement.id;
    var renderform = document.getElementById(parentid).parentElement.id;
    var renderform = "#" + document.getElementById(renderform).parentElement.id;
    // console.log(renderform);


    serverSideRendering(renderform);
}

(() => { enableDragSort('drag-sort-enable') })();





function selectAllCheckboxes() {
    if (selectAll.checked == true) {
        indexc.checked = true;
        createc.checked = true;
        storec.checked = true;
        showc.checked = true;
        editc.checked = true;
        updatec.checked = true;
        deletec.checked = true;
        selectAll.checked = true;
        fun_handle();
    } else {
        indexc.checked = false;
        createc.checked = false;
        storec.checked = false;
        showc.checked = false;
        editc.checked = false;
        updatec.checked = false;
        deletec.checked = false;
        selectAll.checked = false;
        fun_handle();
    }
}

function copyCode(e) {

    var range = document.createRange();
    range.selectNode(document.getElementById(e));
    window.getSelection().removeAllRanges(); // clear current selection
    window.getSelection().addRange(range); // to select text
    document.execCommand("copy");
    window.getSelection().removeAllRanges(); // to deselect
}

function darkMode() {
    var element = document.body;
    element.classList.toggle("dark");
}

function openCode(evt, codeTab) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(codeTab).style.display = "block";
    evt.currentTarget.className += " active";
}

function fun_handle() {


    var indexc = document.getElementById("indexc");
    var index = document.getElementById("index");

    var createc = document.getElementById("createc");
    var create = document.getElementById("create");

    var storec = document.getElementById("storec");
    var store = document.getElementById("store");

    var showc = document.getElementById("showc");
    var show = document.getElementById("show");

    var editc = document.getElementById("editc");
    var edit = document.getElementById("edit");

    var updatec = document.getElementById("updatec");
    var update = document.getElementById("update");

    var deletec = document.getElementById("deletec");
    var deletes = document.getElementById("deletes");


    if (indexc.checked != true) {
        index.style.display = "none";
    } else {
        index.style.display = "block";
    }

    if (createc.checked != true) {
        create.style.display = "none";
    } else {
        create.style.display = "block";
    }

    if (storec.checked != true) {
        store.style.display = "none";
    } else {
        store.style.display = "block";
    }

    if (showc.checked != true) {
        show.style.display = "none";
    } else {
        show.style.display = "block";
    }

    if (editc.checked != true) {
        edit.style.display = "none";
    } else {
        edit.style.display = "block";
    }

    if (updatec.checked != true) {
        update.style.display = "none";
    } else {
        update.style.display = "block";
    }

    if (deletec.checked != true) {
        deletes.style.display = "none";
    } else {
        deletes.style.display = "block";
    }

}

var colcount = 0;

function tablehandle(e, id) {
    if (e.keyCode === 13) {
        e.preventDefault(); // Ensure it is only this code that runs

    }
}

var x = 0;

function handle(e, id, num) {
    var max_fields = 50; //maximum input boxes allowed
    var wrapper = $(".input_fields_wrap"); //Fields wrapper
    var add_button = $(".add_field_button"); //Add button ID

    var parentid = document.getElementById(id).parentElement.id;
    var parentid = document.getElementById(parentid).parentElement.id;
    // console.log(parentid);

    var renderform = document.getElementById(parentid).parentElement.id;
    var renderform = "#" + document.getElementById(renderform).parentElement.id;
    // console.log(renderform);




    if (e.keyCode === 13) {
        e.preventDefault(); // Ensure it is only this code that runs
        var str = document.getElementById(id).id;
        if (str.includes("tablename")) {
            var text = document.getElementById(id).value;
            document.getElementById("tabbtn" + num).innerHTML = text;
        }

        // var txt = document.getElementById(x.toString()).value;
        // var len = txt.split(" ").length;
        // console.log(len < 1);
        // if (len >= 2) {

        //     alert("column name cannot have space");
        //     // console.log("Invalid Text");
        //     return;
        // }

        document.getElementById("pn").style.display = "none";
        // document.getElementById("titles").style.display="none";
        if (x < max_fields) { //max input box allowed
            x++; //text box increment
            // console.log(x.toString());

            // textbox.focus();
            // textbox.scrollIntoView();
            serverSideRendering(renderform);
            var parentid = "#" + parentid;
            var cod = ` <li id="hcol` + x + `" class="list-item dragdots" draggable="true" ondragstart="drag(event)">
                        
                            <input  type="text" placeholder="column name" id="` + x + `" name="textfieldcolumn[` + x + `]" autofocus onkeypress="handle(event,this.id)" onkeypress="" oninput="myFunction()"/> 
                        
                            
                                <input type="checkbox" id="f` + x + `" name="checkboxfile[` + x + `]" onclick="myFunction()">
                                <label for="f` + x + `">file</label>
                             &nbsp&nbsp&nbsp&nbsp 

                             
                                <input type="checkbox" id="r` + x + `" name="checkbioxrequired[` + x + `]" onclick="myFunction()">
                                <label for="r` + x + `">required</label>
                            

                            <button class="btn-danger bi bi-trash" style="margin-left:5px; padding:0px 7px;" id="removeid` + x + `" onclick="removecolumn(event, this.id)">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                </svg>
                            </button>
                        </li>`;
            $(parentid).append(cod); //add input box
            document.getElementById(x.toString()).focus();

            myFunction();

        }
    }
}



// $(document).ready(function() {
//     var max_fields = 50; //maximum input boxes allowed
//     var wrapper = $(".input_fields_wrap"); //Fields wrapper
//     var add_button = $(".add_field_button"); //Add button ID

//     //initlal text box count
//     $(add_button).click(function(e) { //on add input button click
//         e.preventDefault();
//         if (x < max_fields) { //max input box allowed
//             x++; //text box increment
//             $(wrapper).append('<div><input type="text" id="' + x + '" name="mytext[]" onkeypress="" oninput="myFunction()"/><button onclick="" class="remove_field">x</button></div>&nbsp&nbsp'); //add input box
//         }
//     });

//     $(wrapper).on("click", ".remove_field", function(e) { //user click on remove text
//         e.preventDefault();
//         $(this).parent('div').remove();
//         x--;
//     })
// });




function myFunction() {

}


function clientSideRendering() {
    var controllercode = document.getElementById('Controller').textContent;

    $.get('makecontrollerclient?message=' + controllercode)
}

async function serverSideRendering(renderform) {

    var res = $.get('visitormakecontrollerserver?' + $(renderform).serialize(), function(data) {});
    let response = await res;
    // console.log(res);
    var code = res.responseJSON;

    document.getElementById("phpservercode").innerHTML = code.controller_code;

    var tablecode = code.table_code.replaceAll("<", "&lt;");
    var tablecodereplaced = tablecode.replaceAll(">", "&gt;");
    document.getElementById("table_code").innerHTML = tablecodereplaced;

    var create_form_code = code.Create_form.replaceAll("<", "&lt;");
    var create_form_code_replaced = create_form_code.replaceAll(">", "&gt;");
    document.getElementById("Create_form_code").innerHTML = create_form_code_replaced;

    var edit_form_code = code.Edit_form.replaceAll("<", "&lt;");
    var edit_form_code_replaced = edit_form_code.replaceAll(">", "&gt;");
    document.getElementById("Edit_form_code").innerHTML = edit_form_code_replaced;

    document.getElementById("API_controller_code").innerHTML = code.API_controller_code;

    document.getElementById("API_resource_code").innerHTML = code.API_resource_code;

    // document.getElementById("Download_zip").href = code.Download_zip;


    hljs.highlightBlock(phpservercode);
    hljs.highlightBlock(table_code);
    hljs.highlightBlock(API_controller_code);
    hljs.highlightBlock(API_resource_code);
    hljs.highlightBlock(Create_form_code);
    hljs.highlightBlock(Edit_form_code);
}



function writeanddownloadzip() {
    var res = $.get('writAndDownloadZip?' + $('#tableForm0').serialize(), function(data) {
        window.location = 'download';
    });
    let response = res;
    // document.getElementById("zpiresponce").innerHTML = code.zipes;
}

function aj() {

    // var res = $.get('writAndDownloadZip?' + $('#tableForm').serialize(), function(data) {});
    // let response = res;
    // document.getElementById("zpiresponce").innerHTML = code.zipes;
    // var textn = "helllllllllllll";


    // $.post('saveFile', {name: textn});
    // console.log(textn+"==post");


    //        let student = [{ids:1, names:"amittttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttt"}];

    // console.log(JSON.stringify(student) +";;;;;;;;;;;;");
    // var dataa = '{"username":"ffffffffffffff","password":"fffffffff","fullname":"fffffffffffff Babu","age":33}';
    //     $.ajax
    //     ({
    //       type: "post",
    //       url: "saveFile",
    //       crossDomain:true, 
    //       dataType: "json",
    //       beforeSend: function (xhr) {
    //   if (xhr && xhr.overrideMimeType) {
    //     xhr.overrideMimeType('application/json;charset=utf-8');
    //   }
    // },
    //     data: student 
    //      }).done(function ( data ) {
    //       console.log(student);
    //       console.log(data);
    //           alert("ajax callback response:"+JSON.stringify(student));
    //     })

    // const generateObj = (obj, arr, val) => {
    //     if (arr.length === 1) {
    //         obj[arr[0]] = val;
    //         return;
    //     }

    //     if (!obj[arr[0]]) {
    //         obj[arr[0]] = {};
    //     }

    //     const restArr = arr.splice(1);
    //     generateObj(obj[arr[0]], restArr, val);
    // }

    // const getData = (id) => {
    //     const form = document.getElementById(id);
    //     const inputCollection = form.getElementsByTagName('input');
    //     const inputArray = [...inputCollection];
    //     console.log(inputArray['0'].value + "aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa");
    //     const data = {};
    //     inputArray.map(input => {
    //         const {
    //             name,
    //             value
    //         } = input;
    //         const splitName = name.split('.');
    //         console.log(value + "sssssssssssss");
    //         generateObj(data, splitName, value);
    //     })
    //     return data;
    // }
    // dataform = getData('json');
    // console.log(dataform);

    // var tabcols = "";
    // $('input').each(function(index) {
    //     tabcols = $(this).val();
    // });
    // console.log(tabcols);

    // var inputs = document.getElementById('allfields').getElementsByTagName('input');
    // console.log(inputs.tablename.value);

    // $.get('makecontroller?' + $('#tableForm').serialize())
    // $("#tableForm").ajaxSubmit({ url: 'makecontroller', type: 'get' })





    // var controllercode = document.getElementById('Controller').textContent;
    // console.log(controllercode.toString());
    // $.ajax({
    //     url: "savefile",
    //     type: "get",
    //     contentType: "application/json",
    //     dataType: 'JSON',
    //     data: { message: document.getElementById('Controller').textContent },
    //     success: function(data) {
    //         $(".writeinfo").append(data.msg);
    //     }
    // });

}

var y = 0;
var addtabletoarray = [];
addtabletoarray.push(0);

function addtable(e) {
    var max_fields = 10; //maximum input boxes allowed
    var tablewrapper = $(".table_wrap"); //Fields wrapper
    var tabwrapper = $(".tab_wrap");
    var add_button = $(".add_field_button"); //Add button ID

    e.preventDefault(); // Ensure it is only this code that runs

    // document.getElementById("titles").style.display="none";
    if (y < max_fields) { //max input box allowed
        y++; //text box increment
        // console.log(y.toString());

        // textbox.focus();
        // textbox.scrollIntoView();
        var dispon = document.getElementsByClassName("tablecontent");
        for (var i = 0; i < dispon.length; i++) {
            dispon[i].style.display = "none";
        }
        var tablelinks = document.getElementsByClassName("tablelinks");
        for (i = 0; i < tablelinks.length; i++) {
            tablelinks[i].className = tablelinks[i].className.replace(" active", "");
        }

        var code = `
                <form id ="tableForm` + y + `" action="makecontroller" method="GET">
                   
                    <input type="checkbox" checked="true" id="selectAll` + y + `" name="selectAll" onclick="selectAllCheckboxes()">
                    <input type="checkbox" checked="true" id="indexc` + y + `" name="indexc" onclick="fun_handle()"> <label for="indexc"> Index </label> &nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" checked="true" id="createc` + y + `" name="createc" onclick="fun_handle()"> <label for="createc"> create </label> &nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" checked="true" id="storec` + y + `" name="storec" onclick="fun_handle()"> <label for="storec"> store </label> &nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" checked="true" id="showc` + y + `" name="showc" onclick="fun_handle()"> <label for="showc"> show </label> &nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" checked="true" id="editc` + y + `" name="editc" onclick="fun_handle()"> <label for="editc"> edit </label> &nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" checked="true" id="updatec` + y + `" name="updatec" onclick="fun_handle()"> <label for="updatec"> update </label> &nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" checked="true" id="deletec` + y + `" name="deletec" onclick="fun_handle()"> <label for="deletec"> delete </label> &nbsp;&nbsp;&nbsp;&nbsp;
                    <br>
                   
                    <section id="section` + y + `" class="drag-sort-enable">
                        <ul id="ultableid` + y + `" class="input_fields_wrap drag-sort-enable" >
                        <li class="" id="gggg` + y + `"  >
                            <input type="text" placeholder="Table name" autofocus="" onkeypress="handle(event,this.id,` + y + `)" id="tablename` + y + `" name="tablename" oninput="myFunction()">
                            <input type="text" placeholder="Folder name" id="folder` + y + `" name="foldername" oninput="myFunction()">
                        </li>
                            <!-- <button class="add_field_button">Add col</button> -->
                           
                            
                        </ul>
                    </section>
                </form>
        `;
        $(tabwrapper).append('<div id="tabdivid' + y + '"><button id="tabbtn' + y + '" class="tablelinks active"  onclick="opentable(event, \'table' + y + '\',' + y + ')" style="font-size: 13px;">Table' + y + '</button><button id="removetab' + y + '" onclick="removetab(event, this.id,' + y + ')">x</button></div>'); //add input box
        $(tablewrapper).append('<div class="tablecontent" style="display:block;" id="table' + y + '">' + code + ' </div> ');
        document.getElementById("tablename" + y).focus();
        // document.getElementById(x.toString()).focus();
        addtabletoarray.push(y);
    }
}

var previoustab = [];


function opentable(evt, tabletab, formnumber) {
    var i, tabcontent, tablelinks;
    tabcontent = document.getElementsByClassName("tablecontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablelinks = document.getElementsByClassName("tablelinks");
    for (i = 0; i < tablelinks.length; i++) {
        tablelinks[i].className = tablelinks[i].className.replace(" active", "");
    }
    document.getElementById(tabletab).style.display = "block";
    evt.currentTarget.className += " active";
    var renderform = "#tableForm" + formnumber;
    // previoustab += formnumber;
    // console.log(formnumber);
    serverSideRendering(renderform);
    previoustab.push(formnumber);

}


function handleforms(e) {
    var max_fields = 50; //maximum input boxes allowed
    var wrapper = $(".input_fields_wrap"); //Fields wrapper
    var thisid = this.id;
    // console.log(thisid);
    var add_button = $(".add_field_button"); //Add button ID
    if (e.keyCode === 13) {
        e.preventDefault(); // Ensure it is only this code that runs


        var txt = document.getElementById(x.toString()).value;
        var len = txt.split(" ").length;
        // console.log(len < 1);
        if (len >= 2) {

            alert("column name cannot have space");
            // console.log("Invalid Text");
            return;
        }

        document.getElementById("pn").style.display = "none";
        document.getElementById("gettingstated").style.display = "none";

        // document.getElementById("titles").style.display="none";
        if (x < max_fields) { //max input box allowed
            x++; //text box increment
            // console.log(x.toString());

            // textbox.focus();
            // textbox.scrollIntoView();
            serverSideRendering();
            $(wrapper).append('<li id="hcol' + y + '" class="list-item dragdots" draggable="true" ondragstart="drag(event)"><input type="text" placeholder="column name" id="' + x + '" name="textfieldcolumn[' + x + ']" autofocus onkeypress="handle(event)" onkeypress="" oninput="myFunction()"/> <input type="checkbox" id="f' + x + '" name="checkboxfile[' + x + ']" onclick="myFunction()"><label for="f' + x + '">file</label>&nbsp&nbsp&nbsp&nbsp <input type="checkbox" id="r' + x + '" name="checkbioxrequired[' + x + ']" onclick="myFunction()"><label for="r' + x + '">required</label></li>'); //add input box
            document.getElementById(x.toString()).focus();

            myFunction();

        }
    }
}

function removecolumn(e, liid) {
    e.preventDefault();
    var parentid = "#" + document.getElementById(liid).parentElement.id;
    // console.log(parentid);
    $(parentid).remove();
    // parentid.parentNode.removeChild(parentid);

}

function removetab(e, liid, tableid) {
    e.preventDefault();
    var parentid = "#" + document.getElementById(liid).parentElement.id;
    // console.log(parentid);
    var tabid = "#tableForm" + tableid;
    // console.log(tabid + "aaaaaaaaaaaaaaaaa");
    $(parentid).remove();
    document.getElementById(tabid)
    $(tabid).remove();

    // previoustab.pop()
    // var toid = previoustab.pop()
    // document.getElementById("table" + toid).style.display = "block";
    // document.getElementById("tabbtn" + toid).className += " active";
    // serverSideRendering("#table" + toid);
}