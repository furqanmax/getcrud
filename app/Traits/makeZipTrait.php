<?php

namespace App\Traits;
use Illuminate\Support\Str;

use Storage;
use File;
use ZipArchive;
 
trait makeZipTrait {

    function dirToArray($dir_path) {
        $result = array();
        
        $path = realpath($dir_path);
        
        $objects = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path), \RecursiveIteratorIterator::SELF_FIRST);
        // \RecursiveIteratorIterator::SELF_FIRST
        foreach($objects as $name => $object) {
            if( $object->getFilename() !== "." && $object->getFilename() !== "..") {
                // print_r($object);
                $result[] = $object;
            }
        }
        return $result;
    }

    /* creates a compressed zip file */
    function downloadZip($productPath = '', $dirName = '', $overwrite = false) {
        $productPath = storage_path('app/username/code/');
        $dirName = '';
        $fullProductPath = $productPath.$dirName;
        // print_r($fullProductPath);
        $a_filesFolders = $this->dirToArray( $fullProductPath );
        // var_dump($a_filesFolders);
        //if the zip file already exists and overwrite is false, return false
        $zip = new ZipArchive();
        $zipProductPath =  storage_path('app\\username\\res.zip');
        $fileshotpath = 'app\\username\\res.zip';
        // print_r($zipProductPath);
        // if($zip->open( $zipProductPath ) && !$overwrite){
        //     // $GLOBALS["errors"][] = "The directory {$zipProductPath} already exists and cannot be removed.";
        //     $GLOBALS = "The directory {$zipProductPath} already exists and cannot be removed.";
        //     return $GLOBALS;
        // }
        // print_r($zipProductPath);
        //if files were passed in...
        // print_r('files passed');
        if(is_array($a_filesFolders) && count($a_filesFolders)){
            $opened = $zip->open( $zipProductPath, ZipArchive::CREATE | ZipArchive::OVERWRITE );
            if( $opened !== true ){
                $GLOBALS["errors"][] = "Impossible to open {$zipProductPath} to edit it.";
                return false;
            }else{
                //cycle through each file
                foreach($a_filesFolders as $object) {
                    //make sure the file exists
                    $fileName = $object -> getFilename();
                    $pathName = $object -> getPathname();
                    
                    if(is_dir( $pathName )){ /*<-- I put on first position*/
                        // $pos = strpos($zipProductPath , "/tmp/") + 5;
                        // $fileDestination = substr($pathName, $pos);

                        
                        $pos = strstr($pathName ,"code");
                        $pos = substr($pos,5);
                        $fileDestination = $pos;
                        $zip->addEmptyDir($fileDestination);
                    }else if(file_exists($pathName)) {
                        // $pos = strpos($zipProductPath , "/tmp/") + 5;
                        $pos = strstr($pathName ,"code");
                        $pos = substr($pos,5);
                        $fileDestination = $pos;
                        
                        $zip->addFile($pathName,$fileDestination);
                    }
                    else{
                        $GLOBALS["errors"][] = "the file ".$fileName." does not exist !";
                    }
                }

                //close the zip -- done!
                $zip->close();
                // print_r('zip created');
                //check to make sure the file exists
                // print_r($zipProductPath);
                // return response()->json($fileurl);
                
                // $url = Storage::url($fileshotpath);
                // $url = 'localhost/crud'.$url;
                return ("success");

            }
        }else{
            return false;
        }
    }


}
