// const { exec, spawn } = require('child_process');
/**
 * @module {function(new:lib/graph)} lib/graph
 * 
 * @signature `new Graph(graphData)`
 * @param {Object} graphData
 * @return {lib/graph}
 */


/**
 * TABLE_NAME conatains table name as it is in file r
 * table_n conatains table name in snamll letters
 */
// table name
var TABLE_NAME, table_n, app = "";


// columns
var cols = [];

// views and controller options
var selectViews, make, selectController = "";

// file paths
var viewPath, routesPath, controllerPath, controllerFile, migrationPath, migrationFile, newFolder, newFolderDot = "";

// count
var tableCount = 0;
var tableCounter = 0;
// var linecount = 0;

// file names
var viewName = ['index', 'create', 'edit', 'show'];
var ext = ".blade.php";
var layouts = "layout";

// codes
var indexCode, createCode, editCode, showCode, routesCode, controllerCode, migrationCode, up, down = "";
var storF = [];
var layoutCode = `<!DOCTYPE html>
              <html>
              <head>
                <title></title>
                <!-- Font Awesome -->
                <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
                <!-- Google Fonts -->
                <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
                <!-- Bootstrap core CSS -->
                <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
                <!-- Material Design Bootstrap -->
                <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.16.0/css/mdb.min.css" rel="stylesheet">
              </head>
              <body>
                @yield('content')
                <!-- JQuery -->
                <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
                <!-- Bootstrap tooltips -->
                <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
                <!-- Bootstrap core JavaScript -->
                <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js"></script>
                <!-- MDB core JavaScript -->
                <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.16.0/js/mdb.min.js"></script>
              </body>
              </html>`;
// commands
var makeControllerModel = "";

// Source File
var R = "r";

// Path to folders
viewPath = "resources/views/";
routesPath = "routes/web.php";
controllerPath = "app/Http/Controllers/";
migrationPath = "database/migrations/";

function getName(arr) {
    var val = "";
    arr.forEach(element => {
        if (element.includes("/")) {

        } else if (element.includes("@")) {
            var a = element.replace("@", "");
            a = a.toLowerCase();
            val = a + "_id";
            return val;
        } else if (element.includes("+")) {

        } else {
            val = element;
        }
    });
    return val;
}

function writeLayout() {
    var MkdirLayout = require('fs');
    if (!MkdirLayout.existsSync(viewPath + "layouts/")) {
        MkdirLayout.mkdirSync(viewPath + "layouts/");
        if (!MkdirLayout.existsSync(viewPath + "layouts/" + layouts + ext)) {
            WritetoFile(viewPath + "layouts/" + layouts + ext, layoutCode)
        } else {
            console.log("\x1b[31m%s\x1b[0m", "ERROR: " + viewPath + "layouts/" + layouts + ext + " already exist");
        }
    } else {
        console.log("\x1b[31m%s\x1b[0m", "ERROR: " + viewPath + "layouts/" + " already exist");
        if (!MkdirLayout.existsSync(viewPath + "layouts/" + layouts + ext)) {
            WritetoFile(viewPath + "layouts/" + layouts + ext, layoutCode)
        } else {
            console.log("\x1b[31m%s\x1b[0m", "ERROR: " + viewPath + "layouts/" + layouts + ext + " already exist");
        }
    }
}

function grammer(code, fun, linecount) {
    if (fun === "/tbn") {
        if (code.length == 1) {
            console.log("\x1b[31m%s\x1b[0m", "ERROR:  Must have a Table name        at line:" + linecount);
            process.exit();
        } else if (code.length > 2) {
            console.log("\x1b[31m%s\x1b[0m", "ERROR: Table name should be of one word only use _ instead of space        at line:" + linecount);
            process.exit();
        }
    } else if (fun === "/i") {
        if (code.length == 1) {
            console.log("\x1b[31m%s\x1b[0m", "ERROR:  Must have a column name        at line:" + linecount);
            process.exit();
        } else if (code.length > 2) {
            console.log("\x1b[31m%s\x1b[0m", "ERROR: Column name should be of one word only use _ instead of space        at line:" + linecount);
            process.exit();
        }
    } else if (fun === "@") {
        if (code.length == 1) {
            console.log("\x1b[31m%s\x1b[0m", "ERROR:  Must have a column name        at line:" + linecount);
            process.exit();
        } else if (code.length > 2) {
            console.log("\x1b[31m%s\x1b[0m", "ERROR: Column name should be of one word only use _ instead of space        at line:" + linecount);
            process.exit();
        }
    } else if (fun === "+") {
        if (code.length == 1) {
            console.log("\x1b[31m%s\x1b[0m", "ERROR:  Must have a Folder name        at line:" + linecount);
            process.exit();
        } else if (code.length > 2) {
            console.log("\x1b[31m%s\x1b[0m", "ERROR: Column name should be of one word only use _ instead of space        at line:" + linecount);
            process.exit();
        }
    } else if (code.includes("/u")) {
        if (code.length == 1) {
            console.log("\x1b[31m%s\x1b[0m", "ERROR:  Must have a Folder name        at line:" + linecount);
            process.exit();
        } else if (code.length > 2) {
            console.log("\x1b[31m%s\x1b[0m", "ERROR: Column name should be of one word only use _ instead of space        at line:" + linecount);
            process.exit();
        }
    } else {
        if (code.length >= 2) {
            console.log("\x1b[31m%s\x1b[0m", "ERROR: Column name should be of one word only use _ instead of space        at line:" + linecount);
            process.exit();
        }
    }
}

// Read source file
function getData(files) {
    var i = 0;
    var linecount = 0;
    var fs = require('fs');
    let rf = fs.readFileSync(files, "utf8");
    let arr = rf.split(/\r?\n/);
    up = "";
    arr.forEach((line, idx) => {

        linecount = linecount + 1;
        // console.log("aaaaaaaaaaaaaaaaa"+line);
        line = line.trim();
        // console.log("-----------------"+line);
        if (line.includes("/stop")) {
            // console.log("start write");
            if (cols.length == 0) {
                console.log("\x1b[31m%s\x1b[1m", "ERROR: Table:" + TABLE_NAME + " has no columns   at line:" + linecount);
                process.exit();
            }
            tableCounter = 0;
            startWrite();
            // console.log("clear all");
            TABLE_NAME, table_n = "";
            indexCode, createCode, editCode, showCode, routesCode, controllerCode, migrationCode, up, down = "";
            cols = [];
            app = false;
            selectViews, make = undefined;
            selectController = "";

            up = "";
            layouts = "layout";
            viewPath = "resources/views/";
            newFolder = "";

            // console.log("=================="+up);
        } else {
            if (line.includes("/tbn")) {
                var tline = line;
                var fun = "/tbn";
                var words = line.split(" ");
                grammer(words, fun, linecount);
                if (tableCounter == 0) {
                    tableCounter = 1;
                    tableCount = tableCount + 1;
                    var twords = line.split(" ");
                    TABLE_NAME = getName(twords);
                    table_n = TABLE_NAME.toLowerCase();
                } else {
                    console.log("\x1b[31m%s\x1b[1m", "ERROR: /stop needed for Table:" + TABLE_NAME + "    at line:" + linecount);
                    process.exit();
                }

            } else if (line.includes("@")) {
                cols.push(line);
                var sline = line;
                var fun = "@";
                var words = line.split(" ");
                app = true;
                grammer(words, fun, linecount);
                getcols(sline, getName(words));
            } else if (line.includes("/i")) {
                cols.push(line);
                var sline = line;
                var fun = "/i";
                var words = line.split(" ");
                grammer(words, fun, linecount);
                getcols(sline, getName(words));
            } else if (line === "") {
                //  console.log("lien is empty");
            } else if (line.includes("/v")) {

                var words = line.split(" ");
                if (words.length >= 2) {
                    selectViews = line;
                } else {
                    console.log("\x1b[31m%s\x1b[1m", `ERROR: /v needs parameters    line:` + linecount + `
            Eg: /v create index`);
                    process.exit();
                }
            } else if (line.includes("/c")) {

                var words = line.split(" ");
                if (words.length >= 2) {
                    selectController = line;
                } else {
                    console.log("\x1b[31m%s\x1b[1m", `ERROR: /c needs parameters    line:` + linecount + `
            Eg: /c index edit update`);
                    process.exit();
                }
            } else if (line.includes("+")) {
                var fun = "+";
                var words = line.split(" ");
                grammer(words, fun, linecount);
                if (tableCounter == 0) {} else {
                    console.log("\x1b[31m%s\x1b[0m", "ERROR: /stop needed for Table:" + TABLE_NAME + "    at line:" + linecount);
                    process.exit();
                }
                var words = line.split(" ");
                newFolder = getName(words);
                newFolderDot = newFolder + ".";
                viewPath = "resources/views/" + newFolder + "/";
                var MkdirView = require('fs');
                if (!MkdirView.existsSync(viewPath)) {
                    MkdirView.mkdirSync(viewPath);
                }
            } else if (line.includes("/layout")) {
                var words = line.split(" ");
                if (words[0].includes("/layout")) {
                    layouts = "layout";
                } else {
                    layouts = getName(words);
                }
                writeLayout();
            } else if (line.includes("/make")) {
                make = line;
                var words = line.split(" ");
                if (words.length >= 2) {
                    make = line;
                } else {
                    console.log("\x1b[31m%s\x1b[1m", `ERROR: /make needs parameters    line:` + linecount + `
            Eg: /make view controller migration`);
                    process.exit();
                }
            } else {
                var sline = line;
                var fun = "";
                var words = line.split(" ");
                grammer(words, fun, linecount);
                cols.push(getName(words));
                // console.log("=================="+up);
                getcols(sline, getName(words));
            }
        }
        // if (i == 0) {
        //   TABLE_NAME = line.replace(/ /g, "_");
        //   table_n = TABLE_NAME.toLowerCase();
        //   i = i + 1;
        // } 
        // else {
        //   var sline = line;
        //   var words = line.split(" ");
        //   cols.push(words[0]);
        //   getcols(sline, words);
        // }

    });

}

function getcols(sl, wd) {
    if (sl.includes("/u")) {

        up = up + "   $table->string('" + wd + "')->unique();\n";
        // cols = cols + wd;
    } else {
        up = up + "   $table->string('" + wd + "');\n";
    }

}




function Makes(opt) {
    if (opt.includes("mig")) {

        cmd = "php artisan make:model " + TABLE_NAME + " -m";

    } else if (opt.includes("con")) {

        cmd = "php artisan make:controller " + TABLE_NAME + " -r";

    } else if (opt.includes("crm")) {

        cmd = "php artisan make:model " + TABLE_NAME + " -crm";

    } else if (opt.includes("ver")) {

        cmd = "php artisan -v";

    }

    if (cmd === "php artisan -v") {} else {
        console.log("\x1b[32m%s\x1b[0m", cmd);
    }

    var exec = require("child_process").execSync;
    var result = exec(cmd);
    if (cmd === "php artisan -v") {} else {
        console.log(result.toString("utf8"));
    }
    return result;
}

function WritetoFile(path, data) {
    var filessystem = require('fs');
    try {
        filessystem.writeFileSync(path, data);
        console.log("writing " + path);
    } catch (e) {
        console.log(e);
    }
}

function appendToFile(path, data) {
    var filessystem = require('fs');
    filessystem.appendFile(path, data, function(err) {
        if (err) throw err;
        console.log("\x1b[33m%s\x1b[0m", path + ' Routes added successfully.');
    });
}

function indexBlade() {
    var TBvalue = [];
    var TBtitle = [];
    cols.forEach(element => {
        // console.log(element); 
        if (element.includes("/i")) {

            var selement = element;
            var words = element.split(" ");

            var tbvalue = `<td>\n<img src="{{asset('uploads/'.$` + table_n + `->` + words[0] + `) }}" width="50" height="50">\n</td>\n`;
            var tbtitle = `<th>` + words[0] + `</th>\n`;

        } else if (element.includes("@")) {

            var col, tn, name = "";
            var words = element.split(" ");

            words.forEach(element => {
                if (element.includes("@")) {
                    tn = element.replace("@", "");
                    tn = tn.toLowerCase();
                    col = tn + "_id";
                }
            });

            var selement = element;
            var words = element.split(" ");
            var tbvalue = `<td>{{ $` + table_n + `->` + col + ` }}</td>\n`;
            var tbtitle = `<th>` + col + `</th>\n`;
        } else {
            var tbvalue = `<td>{{ $` + table_n + `->` + element + ` }}</td>\n`;
            var tbtitle = `<th>` + element + `</th>\n`;
        }

        // console.log(updates); 
        TBvalue.push(tbvalue);
        TBtitle.push(tbtitle);
    });

    indexCode = `@extends('` + newFolderDot + `layouts.` + layouts + `')
@section('title','` + TABLE_NAME + `s Index')
@section('content')
  <div class="row">
    <div class="col-sm-12">
      <div class="table-responsive">
        <table class="table table-striped table-bordered zero-configuration">
        <tr>
          <th>ID</th>
          ` + TBtitle.join("") + `
        </tr>
        @foreach($` + table_n + `s as $` + table_n + `)
          <tr class = "text-center">
            <td>{{ $` + table_n + `->id }}</td>
            ` + TBvalue.join("") + `
            <td>
              <a href="{{route('` + table_n + `s.edit',['id'=>$` + table_n + `->id])}}" class = "btn btn-info">
                <i class="fa fa-edit pl-3 text-primary" style="font-size: 20px;">
              </a>
            </td>
            <td>
              <a href="{{route('` + table_n + `.delete',$` + table_n + `->id)}}" class = "btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');">
                <i class="fa fa-trash text-danger" style="font-size: 20px;"></i>
              </a>
            </td>
          </tr>
        @endforeach
      </table>
    </div>
  </div>
@endsection`;
    WritetoFile(makeViews + "index" + ext, indexCode);
}


function createBlade() {
    var formField = [];
    cols.forEach(element => {
        // console.log(element); 
        var field = "";
        if (element.includes("/i")) {
            var selement = element;
            var words = element.split(" ");
            field = `<div class="input-group mb-3">
                        <div class="input-group-prepend"><span class="input-group-text">Upload</span></div>
                        <div class="custom-file">
                          <input type="file" name="` + words[0] + `" id="` + words[0] + `" class="custom-file-input">
                          <label class="custom-file-label">Select Image</label>
                        </div>
                      </div>
                     `;
        } else if (element.includes("password")) {
            var selement = element;
            var words = element.split(" ");
            field = `<div class="form-group">
                    <input type="password" name="` + element + `" id="` + element + `" class="form-control" placeholder="Enter ` + element + ` " >
                  </div>
                     `;
        } else if (element.includes("email")) {
            var selement = element;
            var words = element.split(" ");
            field = `<div class="form-group">
                    <input type="email" name="` + element + `" id="` + element + `" class="form-control" placeholder="Enter ` + element + ` " >
                  </div>
                     `;
        } else if (element.includes("@")) {
            var col, tn, name = "";
            var selement = element;
            var words = element.split(" ");

            words.forEach(element => {
                if (element.includes("@")) {
                    tn = element.replace("@", "");
                    tn = tn.toLowerCase();
                    col = tn + "_id";
                } else {
                    name = element;
                }
            });

            field = `<select name="` + col + `" id="` + col + `">
                          @foreach($` + tn + `s as $` + tn + `)
                              <option value="{{ $` + tn + `->id }}">{{ $` + tn + `->` + name + ` }}</option>
                          @endforeach
                      </select>`;
        } else {
            field = `<div class="form-group">
                      <input type="text" name="` + element + `" id="` + element + `" class="form-control" placeholder="Enter ` + element + ` " >
                    </div>
                    `;
        }

        formField.push(field);

    });

    createCode = `@extends('` + newFolderDot + `layouts.` + layouts + `')
    @section('title','Create ` + TABLE_NAME + `')
    @section('content')  
    <div class="card">
      <div class="card-body">
        <div class="basic-form">
          <form action="{{route('` + table_n + `s.store')}}" enctype="multipart/form-data" method = "POST">
            @csrf
            ` + formField.join("") + `
            <button type = "submit" class = "btn btn-success">Submit</button>
          </form>
        </div>
      </div>
    </div>
    @endsection`;
    WritetoFile(makeViews + "create" + ext, createCode);
}




function editBlade() {
    var formeditField = [];
    cols.forEach(element => {
        // console.log(element); 
        var field = "";
        if (element.includes("/i")) {
            var selement = element;
            var words = element.split(" ");
            field = `
                    <img src="{{asset('uploads/'.$` + table_n + `->` + words[0] + `)}}" width="50" height="50" class="mb-1">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend"><span class="input-group-text">Upload</span></div>
                        <div class="custom-file">
                          <input type="file" name="` + words[0] + `" id="` + words[0] + `" class="custom-file-input">
                          <label class="custom-file-label">Select Image</label>
                        </div>
                      </div>
                     `;
        }
        if (element.includes("password")) {
            var selement = element;
            var words = element.split(" ");
            field = `<div class="form-group">
                    <input type="password" name="` + element + `" id="` + element + `" class="form-control" placeholder="Enter ` + element + ` " value = "{{$` + table_n + `->` + element + `}}">
                  </div>
                     `;
        } else if (element.includes("email")) {
            var selement = element;
            var words = element.split(" ");
            field = `<div class="form-group">
                    <input type="email" name="` + element + `" id="` + element + `" class="form-control" placeholder="Enter ` + element + ` " value = "{{$` + table_n + `->` + element + `}}">
                  </div>
                     `;
        } else if (element.includes("@")) {
            var col, tn, name = "";
            var selement = element;
            var words = element.split(" ");

            words.forEach(element => {
                if (element.includes("@")) {
                    tn = element.replace("@", "");
                    tn = tn.toLowerCase();
                    col = tn + "_id";
                } else {
                    name = element;
                }
            });

            field = `<select name="` + col + `" id="` + col + `">
                          @foreach($` + tn + `s as $` + tn + `)
                              <option value="{{ $` + tn + `->id }}" @if($course->id==$` + table_n + `->` + col + ` ) selected @endif>{{ $` + tn + `->` + name + ` }}</option>
                          @endforeach
                      </select>`;
        } else {
            field = `<div class="form-group">
                      <input type="text" name = "` + element + `" id = "` + element + `" class="form-control" placeholder="Enter ` + element + ` "  value = "{{$` + table_n + `->` + element + `}}">
                  </div>`;
        }

        formeditField.push(field);
    });

    editCode = `@extends('` + newFolderDot + `layouts.` + layouts + `')
    @section('title','Edit ` + TABLE_NAME + `')
    @section('content')
    <div class="card">
      <div class="card-body">
        <div class="basic-form">
          <form action="{{route('` + table_n + `s.update',$` + table_n + `->id)}}" enctype="multipart/form-data" method = "POST">
            @csrf
            @method('PATCH')
            ` + formeditField.join("") + `
            <button type = "submit" class = "btn btn-success">Submit</button>
          </form>
        </div>
      </div>
    </div>
    @endsection`;
    WritetoFile(makeViews + "edit" + ext, editCode);
}

function showBlade() {
    showCode = "show code";
    WritetoFile(makeViews + "show" + ext, showCode);
}


function makeRoutes() {
    routesCode = "\nRoute::resource('" + table_n + "s', '" + TABLE_NAME + "Controller');\n";
    routesCode = routesCode + "\nRoute::get('" + table_n + "-delete/{id}','" + TABLE_NAME + "Controller@delete')->name('" + table_n + ".delete');\n";
    appendToFile(routesPath, routesCode);
}



function writeMigration() {
    var i = 0;
    var readMigrate = require('fs');
    console.log("Finding migrations files...");
    var files = readMigrate.readdirSync(migrationPath);

    files.forEach((file) => {
        // console.log(file);
        if (file.includes(table_n)) {
            migrationFile = file;
            // console.log("\nfile found");    
            i = i + 1;
        }
    });
    if (i != 1) {
        console.log("\x1b[31m%s\x1b[1m", "ERROR: " + table_n + " Migration not found");
    } else {
        console.log("\x1b[34m%s\x1b[0m", migrationFile);
    }
    // console.log(migrationFile);
    migrationFile = migrationPath + migrationFile;
    var fsm = require('fs');
    var filemigration = fsm.readFileSync(migrationFile, "utf8");
    migrationCode = filemigration;
    var status = migrationup();
    if (status) {
        WritetoFile(migrationFile, migrationCode);
    }
    // migrationdown();

}




function migrationup() {
    var toFind = "";
    var version = Makes("ver");
    version.toString();
    // console.log(version.toString());
    if (version.includes("5.8")) {
        toFind = `$table->bigIncrements('id');`;
    } else {
        toFind = `$table->increments('id');`;
    }
    console.log(toFind);
    // console.log(up);
    // up = up + " $table->timestamps();\n });";
    up = "\n" + up;

    code = up;
    up = "";
    var status = findAndWriteToMigration(migrationCode, toFind, code);
    return status;
}

function migrationdown() {
    var toFind = "";

    toFind = `down()
  {
    `;
    down = "Schema::dropIfExists('" + TABLE_NAME + "');";
    code = down;

    findAndWriteToMigration(migrationCode, toFind, code);
}

function findAndWriteToMigration(string, find, replace) {
    var s, f, c, n, len, st = "";
    s = string;
    f = find;
    c = replace;
    var status;
    len = f.length;
    n = s.indexOf(f, 0);
    if (s.includes(f)) {
        st = s.substr(0, n + len) + c + s.substr(n + len);
        status = true;
    } else {
        console.log("\x1b[31m%s\x1b[0m", "ERROR: Migration:" + TABLE_NAME + " Writing Unsuccessfull");
        status = false;
    }

    migrationCode = st;
    // console.log("8888888888888888888888888"+st);
    up = "";
    down = "";
    return status;
}



function writeController() {
    controllerFile = "";
    var i = 0;
    console.log("Finding Controller files...");
    var fsa = require('fs');
    // Controlertext = index + create + store + edit + update + destroy ;
    var files = fsa.readdirSync(controllerPath);
    // console.log(files);

    files.forEach((file) => {
        // console.log(file);
        if (file.includes(TABLE_NAME)) {
            controllerFile = file;
            i = i + 1;
        }

    });
    if (i != 1) {
        console.log("\x1b[31m%s\x1b[1m", "ERROR: " + TABLE_NAME + " Controller not found");
    } else {
        console.log("\x1b[34m%s\x1b[0m", controllerFile);
    }
    // console.log("\x1b[34m%s\x1b[0m" ,controllerFile);
    controllerFile = controllerPath + controllerFile;
    var fsb = require('fs');
    var filecontroller = fsb.readFileSync(controllerFile, "utf8");
    controllerCode = filecontroller;
    var status = "";

    if (app) {
        var TN = "";
        cols.forEach(element => {
            if (element.includes("@")) {
                var words = element;
                words = words.split(" ");

                words.forEach(element => {
                    if (element.includes("@")) {
                        TN = element.replace("@", "");
                    }
                });

            }
        });
        var toFind = "use App\\" + TABLE_NAME + ";";
        var code = "\nuse App\\" + TN + ";\n";

        status = findAndWriteToController(controllerCode, toFind, code);
    }

    if (selectController != "") {
        var controllerList = selectController.split(" ");
        selectController = "";
        controllerList.forEach(element => {
            if (element.includes("index")) {
                status = index();
            } else if (element.includes("create")) {
                status = create();
            } else if (element.includes("store")) {
                status = store();
            } else if (element.includes("show")) {
                status = show();
            } else if (element.includes("edit")) {
                status = edit();
            } else if (element.includes("update")) {
                status = update();
            } else if (element.includes("destroy")) {
                status = destroy();
            }
        });
    } else {
        status = index();
        status = create();
        status = store();
        status = show();
        status = edit();
        status = update();
        status = destroy();
    }
    if (status) {
        WritetoFile(controllerFile, controllerCode);
    }

}



function index() {
    var toFind = "";

    toFind = `index()
    {
      `;
    code = `//Show all ` + table_n + `s from the database and return to view
      $` + table_n + `s = ` + TABLE_NAME + `::all();
      return view('` + newFolderDot + table_n + `.index',['` + table_n + `s'=>$` + table_n + `s]);\n`;

    var status = findAndWriteToController(controllerCode, toFind, code);
    return status;
}

function create() {
    var toFind = "";

    toFind = `create()
    {
      `;
    if (app) {
        var TN, tn = "";
        cols.forEach(element => {
            if (element.includes("@")) {
                var words = element;
                words = words.split(" ");

                words.forEach(element => {
                    if (element.includes("@")) {
                        TN = element.replace("@", "");
                        tn = TN.toLowerCase();

                    }
                });

            }
        });

        code = `//Return view to create ` + table_n + `
          $` + tn + `s=` + TN + `::all();
          return view('` + newFolderDot + table_n + `.create',compact('` + tn + `s'));`;
    } else {
        code = `//Return view to create ` + table_n + `
          return view('` + newFolderDot + table_n + `.create');\n`;
    }


    var status = findAndWriteToController(controllerCode, toFind, code);
    return status;
}

function store() {
    var toFind = "";
    fieldRequest(table_n, cols);
    toFind = `store(Request $request)
    {
      `;
    code = ` //Persist the ` + table_n + ` in the database
    //form data is available in the request object
    /**
      * $this->validate($request,[])  
    */
    $` + table_n + ` = new ` + TABLE_NAME + `();
    //input method is used to get the value of input with its
    //name specified\n` +
        storF.join("") + ` 
    if($` + table_n + `->save()){
        return redirect()->back()->with('success',' ` + table_n + ` Added successfully.');
    }
    else{
        return redirect()->back()->with('unsuccess','Failed try again.');
    }
    // return redirect()->route('` + table_n + `s.index')->with('info','` + TABLE_NAME + ` Added Successfully');
`;

    var status = findAndWriteToController(controllerCode, toFind, code);
    return status;
}

function show() {
    var toFind = "";

    toFind = `show(` + TABLE_NAME + ` $` + table_n + `)
    {
        `;
    code = `// your code here`;

    var status = findAndWriteToController(controllerCode, toFind, code);
    return status;
}

function edit() {
    var toFind = "";

    toFind = `edit(` + TABLE_NAME + ` $` + table_n + `)
    {
        `;

    if (app) {
        var TN, tn = "";
        cols.forEach(element => {
            if (element.includes("@")) {
                var words = element;
                words = words.split(" ");

                words.forEach(element => {
                    if (element.includes("@")) {
                        TN = element.replace("@", "");
                        tn = TN.toLowerCase();

                    }
                });

            }
        });

        code = `//Return view to create ` + table_n + `
            $` + table_n + `=` + TABLE_NAME + `::where('id',$id)->first();
            $` + tn + `s=` + TN + `::all();
            return view('` + newFolderDot + table_n + `.create',compact('` + table_n + `','` + tn + `s'));`;
    } else {
        code = `//Return view to create ` + table_n + `
            return view('` + newFolderDot + table_n + `.create');\n`;
    }


    code = ` //Find the ` + table_n + `
    $` + table_n + `=` + TABLE_NAME + `::where('id',$id)->first();
    return view('` + newFolderDot + table_n + `.edit',compact('` + table_n + `'));
`;

    var status = findAndWriteToController(controllerCode, toFind, code);
    controllerCode = controllerCode.replace(`edit(` + TABLE_NAME + ` $` + table_n + `)`, "edit($id)");
    return status;
}

function update() {
    var toFind = "";
    fieldRequest(table_n, cols);
    toFind = `update(Request $request, ` + TABLE_NAME + ` $` + table_n + `)
    {
        `;
    code = `//Retrieve the ` + table_n + ` and update
      $` + table_n + ` = ` + TABLE_NAME + `::find($request->input('id'));
      ` + storF.join("") + `
     
      if($` + table_n + `->save()){
        return redirect()->back()->with('success',' ` + table_n + ` Updated successfully.');
    }
    else{
        return redirect()->back()->with('unsuccess','Failed try again.');
    }
      // return redirect()->route('` + table_n + `s.index')->with('info','` + TABLE_NAME + ` Updated Successfully');
`;

    var status = findAndWriteToController(controllerCode, toFind, code);
    return status;
}

function destroy() {
    var toFind = "";

    toFind = `destroy(` + TABLE_NAME + ` $` + table_n + `)
    {
        `;
    code = ` //Retrieve the ` + table_n + `
  
    if(` + TABLE_NAME + `::where('id',$id)->delete()){
      return redirect()->back()->with('success',' ` + TABLE_NAME + ` Updated successfully.');
  }
  else{
      return redirect()->back()->with('unsuccess','Failed try again.');
  }
   
`;

    var status = findAndWriteToController(controllerCode, toFind, code);
    controllerCode.replace(`destroy(` + TABLE_NAME + ` $` + table_n + `)`, "delete($id)");
    return status;
}

function fieldRequest(Tname, labels) {
    storF = [];
    labels.forEach(element => {
        var updates = "";
        if (element.includes("/i")) {
            var selement = element;
            var words = element.split(" ");
            updates = `if($request->file('` + words[0] + `')) {
          $upload = $request->file('` + words[0] + `');
          $fileformat = time() . '.' . $upload->getClientOriginalName();
          if ($upload->move('uploads/', $fileformat)) {
              $` + Tname + `->` + words[0] + ` = $fileformat;
          }
      }
      `;
        } else if (element.includes("@")) {
            var col, tn, name = "";
            var selement = element;
            var words = element.split(" ");

            words.forEach(element => {
                if (element.includes("@")) {
                    tn = element.replace("@", "");
                    tn = tn.toLowerCase();
                    col = tn + "_id";
                }
            });
            updates = `$` + Tname + `->` + col + ` = $request->` + col + `;\n`;
        } else {
            updates = `$` + Tname + `->` + element + ` = $request->` + element + `;\n`;
        }
        storF.push(updates);
    });
}


function findAndWriteToController(string, find, replace) {
    var s, f, c, st = "";
    s = string;
    f = find;
    c = replace;
    var len = f.length;
    var n = s.indexOf(f, 0);
    if (s.includes(f)) {
        st = s.substr(0, n + len) + c + s.substr(n + len);
        status = true;
    } else {
        console.log("\x1b[31m%s\x1b[0m", "ERROR: Controller:" + TABLE_NAME + " Writing Unsuccessfull");
        status = false;
    }

    // st = s.substr(0, n + len) + c + s.substr(n + len);
    controllerCode = st;
    return status;
    // console.log(st);
}


function chkviews() {
    makeViews = viewPath + table_n + "/";
    var MkdirView = require('fs');
    if (!MkdirView.existsSync(makeViews)) {
        MkdirView.mkdirSync(makeViews);
        return true;
    } else {
        console.log("\x1b[31m%s\x1b[0m", "ERROR: " + makeViews + " already exist");
        return false;
    }
}


function viewMaker() {
    if (chkviews()) {
        // console.log("==================================after check"+selectViews);
        if (selectViews != undefined) {
            // console.log(selectViews);
            var viewlist = selectViews.split(" ");
            selectViews = "";
            viewlist.forEach(element => {
                if (element.includes("index")) {
                    indexBlade();
                } else if (element.includes("create")) {
                    createBlade();
                } else if (element.includes("edit")) {
                    editBlade();
                } else if (element.includes("show")) {
                    showBlade();
                }
            });
        } else {
            indexBlade();
            createBlade();
            editBlade();
            showBlade();
        }
    }
    // var viewMkLayout = require('fs');
    //         if (!viewMkLayout.existsSync(viewPath+"layouts/")){
    //           viewMkLayout.mkdirSync(viewPath+"layouts/");
    //         }
    //         WritetoFile(viewPath+"layouts/"+layouts+ext, layoutCode)

}


function startWrite() {
    console.log("\x1b[32m%s\x1b[0m", TABLE_NAME, table_n, cols);


    if (make != undefined) {
        // console.log(make);
        var makelist = make.split(" ");
        make = "";
        makelist.forEach(element => {
            if (element.includes("mig")) {
                var mcres = Makes(element);
                if (mcres.includes("exists")) {} else {
                    writeMigration();
                }
            } else if (element.includes("con")) {
                var mcres = Makes(element);
                if (mcres.includes("exists")) {} else {
                    writeController();
                }
            } else if (element.includes("vie")) {
                viewMaker();
            } else if (element.includes("crm")) {
                var mcres = Makes(element);
                // console.log("+++++++++++++++++"+mcres);
                if (mcres.includes("exists")) {} else {
                    // console.log("===================writing");
                    writeController();
                    writeMigration();
                    makeRoutes();
                }
                writeLayout();
                viewMaker();
            }
        });
    } else {
        var mcres = Makes("crm");
        console.log("+++++++++++++++++" + mcres);
        if (mcres.includes("exists")) {

        } else {
            // console.log("===================writing");
            writeController();
            writeMigration();
            makeRoutes();
        }
        writeLayout();
        viewMaker();
    }



}



getData("r");



// console.log('\x1b[36m%s', "Finished..." );
console.log("Finished...");
console.log("\x1b[32m%s\x1b[0m", `
Execute Command 
        
        php artisan migrate
`);