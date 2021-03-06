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

function copyCode(e, thise) {

    var range = document.createRange();
    range.selectNode(document.getElementById(e));
    document.getElementById(thise).innerHTML = "copied";

    console.log(thise);
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
    // console.log("-----------" + renderform);
    var renderform = "#" + document.getElementById(renderform).parentElement.id;
    // console.log(renderform + "----------");




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
        document.getElementById("tsave").style.display = "inline";
        document.getElementById("thistory").style.display = "inline";
        // document.getElementById("inserttab").style.display = "none";
        document.getElementById("all_code_tabs").style.display = "block";
        document.getElementById("gettingstated").style.color = "#d9d9d9";
        document.getElementById("inserttab").style.color = "#d9d9d9";


        // document.getElementById("titles").style.display="none";
        if (x < max_fields) { //max input box allowed
            x++; //text box increment
            // console.log(x.toString());

            // textbox.focus();
            // textbox.scrollIntoView();
            serverSideRendering(renderform);
            var parentid = "#" + parentid;
            console.log(parentid + "--------------------------");
            var cod = ` <li id="hcol` + x + `" class="list-item dragdots" draggable="true" ondragstart="drag(event)">
                        
                            <input class="m-0"  type="text" placeholder="column name" id="` + x + `" name="textfieldcolumn[` + x + `]" autofocus onkeypress="handle(event,this.id)" /> 
                            
                            <label id="lbf[` + x + `]" for="f` + x + `">
                                <input type="checkbox" id="f` + x + `" name="checkboxfile[` + x + `]" onclick="myFunction(this.id)" class="checkbox-custom">
                                <span  class="label tooltip-test"  title="File ">
                                <svg id="Capa_1" enable-background="new 0 0 512 512" height="18" viewBox="0 0 512 512" width="18" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <g>
                                        <path d="m446.605 124.392-119.997-119.997c-2.801-2.802-6.624-4.395-10.608-4.395h-210c-24.813 0-45 20.187-45 45v422c0 24.813 20.187 45 45 45h300c24.813 0 45-20.187 45-45v-332c0-4.09-1.717-7.931-4.395-10.608zm-115.605-73.179 68.787 68.787h-53.787c-8.271 0-15-6.729-15-15zm75 430.787h-300c-8.271 0-15-6.729-15-15v-422c0-8.271 6.729-15 15-15h195v75c0 24.813 20.187 45 45 45h75v317c0 8.271-6.729 15-15 15z"/>
                                        <path d="m346 212h-180c-8.284 0-15 6.716-15 15s6.716 15 15 15h180c8.284 0 15-6.716 15-15s-6.716-15-15-15z"/>
                                        <path d="m346 272h-180c-8.284 0-15 6.716-15 15s6.716 15 15 15h180c8.284 0 15-6.716 15-15s-6.716-15-15-15z"/>
                                        <path d="m346 332h-180c-8.284 0-15 6.716-15 15s6.716 15 15 15h180c8.284 0 15-6.716 15-15s-6.716-15-15-15z"/>
                                        <path d="m286 392h-120c-8.284 0-15 6.716-15 15s6.716 15 15 15h120c8.284 0 15-6.716 15-15s-6.716-15-15-15z"/>
                                    </g>
                                </svg>
                                    
                                </span>
                            </label>
                                
                            

                             <label id="lbr[` + x + `]" for="r` + x + `">
                             <input type="checkbox" id="r` + x + `" name="checkbioxrequired[` + x + `]" onclick="myFunction(this.id)">
                             <span  class="label tooltip-test"  title="Required">
                             <svg enable-background="new 0 0 24 24" height="18" viewBox="0 0 24 24" width="18" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="m13.5 23h-3c-.827 0-1.5-.673-1.5-1.5v-4.304l-3.73 2.156c-.357.2-.765.252-1.153.143-.382-.106-.698-.355-.893-.701l-1.496-2.594c-.416-.713-.175-1.635.54-2.052l3.722-2.148-3.72-2.147c-.717-.418-.958-1.34-.541-2.055l1.499-2.598c.19-.34.507-.589.889-.695.387-.109.796-.061 1.149.14l3.734 2.159v-4.304c0-.827.673-1.5 1.5-1.5h3c.827 0 1.5.673 1.5 1.5v4.304l3.73-2.156c.356-.202.763-.253 1.153-.143.382.106.698.355.893.701l1.496 2.594c.416.713.175 1.635-.54 2.052l-3.722 2.148 3.721 2.147c.717.418.958 1.34.541 2.055l-1.5 2.598c-.19.34-.507.589-.889.695-.389.109-.797.059-1.149-.14l-3.734-2.159v4.304c0 .827-.673 1.5-1.5 1.5zm-4-7.17c.086 0 .173.022.25.067.154.089.25.254.25.433v5.17c0 .275.225.5.5.5h3c.275 0 .5-.225.5-.5v-5.17c0-.179.096-.344.25-.433.154-.09.346-.09.5 0l4.48 2.59c.116.064.254.082.383.045.125-.035.228-.115.29-.227l1.504-2.605c.143-.245.063-.547-.179-.688l-4.469-2.579c-.154-.089-.25-.254-.25-.433s.096-.344.25-.433l4.471-2.58c.24-.141.319-.442.178-.686l-1.501-2.601c-.066-.117-.169-.197-.294-.232-.131-.038-.268-.02-.387.048l-4.476 2.587c-.154.09-.346.09-.5 0-.154-.089-.25-.254-.25-.433v-5.17c0-.275-.225-.5-.5-.5h-3c-.275 0-.5.225-.5.5v5.17c0 .179-.096.344-.25.433-.154.09-.346.09-.5 0l-4.48-2.59c-.116-.064-.253-.081-.383-.045-.125.035-.228.115-.29.227l-1.504 2.605c-.143.245-.064.547.178.688l4.469 2.579c.155.089.25.254.25.433s-.096.344-.25.433l-4.471 2.58c-.24.141-.319.442-.178.686l1.502 2.601c.066.117.169.197.294.232.129.036.268.019.387-.048l4.477-2.587c.076-.044.163-.067.249-.067z"/>
                             </svg>
                             </span>
                             </label>
                                
                               
                            

                            <button class="btn-danger " id="removeid` + x + `" onclick="removecolumn(event, this.id)">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                </svg>
                            </button>
                        </li>`;
            $(parentid).append(cod); //add input box
            document.getElementById(x.toString()).focus();

            // myFunction();

        }
    }
}



function makesavedform(savedcolumns) {
    console.log(x);
    var renderform = "#" + document.getElementById("section0").parentElement.id;


    document.getElementById("pn").style.display = "none";
    document.getElementById("tsave").style.display = "inline";
    document.getElementById("thistory").style.display = "inline";
    // document.getElementById("inserttab").style.display = "none";
    document.getElementById("all_code_tabs").style.display = "block";
    document.getElementById("gettingstated").style.color = "#d9d9d9";
    document.getElementById("inserttab").style.color = "#d9d9d9";

    // serverSideRendering(renderform);
    $.each(savedcolumns, function(index, value) {
        // serverSideRendering(renderform);
        x++;
        var cod = ` <li id="hcol` + index + `" class="list-item dragdots" draggable="true" ondragstart="drag(event)">
                        
                        <input class="m-0"  type="text" placeholder="column name" id="` + index + `" name="textfieldcolumn[` + index + `]" autofocus onkeypress="handle(event,this.id)" value = "` + value.column + `"/> 
                        
                        <label id="lbf[` + index + `]" for="f` + index + `">
                            <input type="checkbox" id="f` + index + `" name="checkboxfile[` + index + `]" onclick="myFunction(this.id)" class="checkbox-custom">
                            <span  class="label tooltip-test"  title="File ">
                            <svg id="Capa_1" enable-background="new 0 0 512 512" height="18" viewBox="0 0 512 512" width="18" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <g>
                                    <path d="m446.605 124.392-119.997-119.997c-2.801-2.802-6.624-4.395-10.608-4.395h-210c-24.813 0-45 20.187-45 45v422c0 24.813 20.187 45 45 45h300c24.813 0 45-20.187 45-45v-332c0-4.09-1.717-7.931-4.395-10.608zm-115.605-73.179 68.787 68.787h-53.787c-8.271 0-15-6.729-15-15zm75 430.787h-300c-8.271 0-15-6.729-15-15v-422c0-8.271 6.729-15 15-15h195v75c0 24.813 20.187 45 45 45h75v317c0 8.271-6.729 15-15 15z"/>
                                    <path d="m346 212h-180c-8.284 0-15 6.716-15 15s6.716 15 15 15h180c8.284 0 15-6.716 15-15s-6.716-15-15-15z"/>
                                    <path d="m346 272h-180c-8.284 0-15 6.716-15 15s6.716 15 15 15h180c8.284 0 15-6.716 15-15s-6.716-15-15-15z"/>
                                    <path d="m346 332h-180c-8.284 0-15 6.716-15 15s6.716 15 15 15h180c8.284 0 15-6.716 15-15s-6.716-15-15-15z"/>
                                    <path d="m286 392h-120c-8.284 0-15 6.716-15 15s6.716 15 15 15h120c8.284 0 15-6.716 15-15s-6.716-15-15-15z"/>
                                </g>
                            </svg>
                                
                            </span>
                        </label>
                            
                        

                        <label id="lbr[` + index + `]" for="r` + index + `">
                        <input type="checkbox" id="r` + index + `" name="checkbioxrequired[` + index + `]" onclick="myFunction(this.id)">
                        <span  class="label tooltip-test"  title="Required">
                        <svg enable-background="new 0 0 24 24" height="18" viewBox="0 0 24 24" width="18" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="m13.5 23h-3c-.827 0-1.5-.673-1.5-1.5v-4.304l-3.73 2.156c-.357.2-.765.252-1.153.143-.382-.106-.698-.355-.893-.701l-1.496-2.594c-.416-.713-.175-1.635.54-2.052l3.722-2.148-3.72-2.147c-.717-.418-.958-1.34-.541-2.055l1.499-2.598c.19-.34.507-.589.889-.695.387-.109.796-.061 1.149.14l3.734 2.159v-4.304c0-.827.673-1.5 1.5-1.5h3c.827 0 1.5.673 1.5 1.5v4.304l3.73-2.156c.356-.202.763-.253 1.153-.143.382.106.698.355.893.701l1.496 2.594c.416.713.175 1.635-.54 2.052l-3.722 2.148 3.721 2.147c.717.418.958 1.34.541 2.055l-1.5 2.598c-.19.34-.507.589-.889.695-.389.109-.797.059-1.149-.14l-3.734-2.159v4.304c0 .827-.673 1.5-1.5 1.5zm-4-7.17c.086 0 .173.022.25.067.154.089.25.254.25.433v5.17c0 .275.225.5.5.5h3c.275 0 .5-.225.5-.5v-5.17c0-.179.096-.344.25-.433.154-.09.346-.09.5 0l4.48 2.59c.116.064.254.082.383.045.125-.035.228-.115.29-.227l1.504-2.605c.143-.245.063-.547-.179-.688l-4.469-2.579c-.154-.089-.25-.254-.25-.433s.096-.344.25-.433l4.471-2.58c.24-.141.319-.442.178-.686l-1.501-2.601c-.066-.117-.169-.197-.294-.232-.131-.038-.268-.02-.387.048l-4.476 2.587c-.154.09-.346.09-.5 0-.154-.089-.25-.254-.25-.433v-5.17c0-.275-.225-.5-.5-.5h-3c-.275 0-.5.225-.5.5v5.17c0 .179-.096.344-.25.433-.154.09-.346.09-.5 0l-4.48-2.59c-.116-.064-.253-.081-.383-.045-.125.035-.228.115-.29.227l-1.504 2.605c-.143.245-.064.547.178.688l4.469 2.579c.155.089.25.254.25.433s-.096.344-.25.433l-4.471 2.58c-.24.141-.319.442-.178.686l1.502 2.601c.066.117.169.197.294.232.129.036.268.019.387-.048l4.477-2.587c.076-.044.163-.067.249-.067z"/>
                        </svg>
                        </span>
                        </label>
                            
                        
                        

                        <button class="btn-danger " id="removeid` + index + `" onclick="removecolumn(event, this.id)">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                            </svg>
                        </button>
                    </li>`;
        $("#ultableid0").append(cod);
        document.getElementById(x.toString()).focus();


    });


    // respp()
    // async function respp() {
    //     console.log($(renderform).serialize());

    //     // console.log(res);
    //     try {
    //         var res = $.get('visitormakecontrollerserver?' + $(renderform).serialize(), function(data) {});
    //         var response = await res;
    //         console.log(response + "aaaaaaaaaaaaaaaaaaaaaaaaaaaaaa");
    //         var code = res.responseJSON;
    //         console.log(code);
    //         code = code.statresus;
    //         console.log(code);
    //     } catch (e) {
    //         console.log(e);
    //     }
    // }


    var renderform = "#" + document.getElementById("section0").parentElement.id;
    console.log(renderform);
    serverSideRendering(renderform);

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




function myFunction(id) {

    var renderform = document.getElementById(id).parentElement.id;
    var renderform = document.getElementById(renderform).parentElement.id;
    var renderform = document.getElementById(renderform).parentElement.id;
    var renderform = document.getElementById(renderform).parentElement.id;
    var renderform = "#" + document.getElementById(renderform).parentElement.id;
    console.log(renderform);


    serverSideRendering(renderform);
    // serverSideRendering();
}


function clientSideRendering() {
    var controllercode = document.getElementById('Controller').textContent;

    $.get('makecontrollerclient?message=' + controllercode)
}

async function tablesave() {

    // var parentid = document.getElementById(item).parentElement.id;
    // var parentid = document.getElementById(parentid).parentElement.id;
    // var renderform = document.getElementById(parentid).parentElement.id;
    var renderform = "#" + document.getElementById("section0").parentElement.id;


    var res = $.get('/tablesave?' + $(renderform).serialize(), function(data) {});
    // let response = await res;
    var code = "";
    try {
        let response = await res;
        code = res.responseJSON;
    } catch (e) {
        console.log(e);
    }

    // var code = response.responseJSON;
    console.log(code.status);
    // document.getElementById("phpservercode").innerHTML = code.controller_code;
}

async function serverSideRendering(renderform) {
    console.log(renderform);

    var res = $.get('/visitormakecontrollerserver?' + $(renderform).serialize(), function(data) {});
    try {
        let response = await res;
        code = res.responseJSON;
    } catch (e) {
        console.log(e);
    }
    // let response = await res;
    // console.log(res);
    var code = res.responseJSON;
    console.log(code);

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

    document.getElementById("Migration_code").innerHTML = code.Migration_code;

    // document.getElementById("Download_zip").href = code.Download_zip;


    hljs.highlightBlock(phpservercode);
    hljs.highlightBlock(table_code);
    hljs.highlightBlock(API_controller_code);
    hljs.highlightBlock(API_resource_code);
    hljs.highlightBlock(Create_form_code);
    hljs.highlightBlock(Edit_form_code);
    hljs.highlightBlock(Migration_code);
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
        document.getElementById("tsave").style.display = "none";
        document.getElementById("thistory").style.display = "none";
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

// window.onload = serverSideRendering("#tableForm0");