<?php


const CUSTOM_PLUGINS_NAMES = [
    'MainPlugin',
    'ContactFormPlugin',
    'WPModules',
    'SearchPlugin'
];

function autoloadCustomizePlugins($className){

//======================================================================
// IMPORTANT:
// please notice that this autoloader is based on the namespacing and naming of your plugin.
//======================================================================

    /* replace underscore to dash */
    $classFile = str_replace('_','-',$className);

    /* replace '\\' to a directory separator (base on the OS) */
    $classFile = str_replace('\\',DIRECTORY_SEPARATOR,$classFile);

    $customPluginsNames  = implode('|',CUSTOM_PLUGINS_NAMES);

    /*continue only if the class belongs to the specified custom plugins namespace.*/
    if(!preg_match("/($customPluginsNames)/i",$classFile,$matches)){
        return false;
    }

    $classFilePath =  WPMU_PLUGIN_DIR.DIRECTORY_SEPARATOR.$classFile.".php";

    /*check if the file exist. */
    file_exists($classFilePath) ? require_once $classFilePath : die("Class $className was not declared and the class file is not exist. filePath = $classFilePath");

}

spl_autoload_register('autoloadCustomizePlugins');

