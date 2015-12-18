<?php

function mainPluginAutoloader($className){

//======================================================================
// IMPORTANT:
// please notice that this autoloader is based on the namespacing and naming of your plugin.
//======================================================================

    /* replace underscore to dash */
    $classFile = str_replace('_','-',$className);

    /* replace '\\' to a directory separator (base on the OS) */
    $classFile = str_replace('\\',DIRECTORY_SEPARATOR,$classFile);

    /*continue only if the class has the 'MainPlugin' namespace.*/
    if(!preg_match("/MainPlugin/i",$classFile))
        return false;


    $classFilePath =  WPMU_PLUGIN_DIR.DIRECTORY_SEPARATOR.$classFile.".php";

    /*check if the file exist. */
    file_exists($classFilePath) ? require_once $classFilePath : die("Class $className was not declared and the class file is not exist. filePath = $classFilePath");

}

spl_autoload_register('mainPluginAutoloader');

