<?php
/*
 * INI SETUP
 */
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('max_execution_time', 0);
set_time_limit(0);
error_reporting(E_ALL);


/*
 * CONVERT ALL ERRORS TO EXCEPTIONs
 */
function exception_error_handler($severity, $message, $file, $line) {
    if (!(error_reporting() & $severity)) {
        // This error code is not included in error_reporting
        return;
    }
    throw new Exception($message);
    //throw new ErrorException($message, 0, $severity, $file, $line);
}
set_error_handler("exception_error_handler");

/*
 * DEFINE CONSTANTS
 */
defined('APP_ROUTE') || define('APP_ROUTE', __DIR__ . '/../');


try{
    /*
     * INCLUDES
     */
    include_once(APP_ROUTE.'config/config.php');
    include_once(APP_ROUTE.'incl/Routes.php');
    include_once(APP_ROUTE.'incl/Controller.php');
    include_once(APP_ROUTE.'incl/Render.php');
    include_once(APP_ROUTE.'incl/Model.php');
    require_once(APP_ROUTE.'lib/loader.php');
    
    /*
     * RUN THE APP
     */
    $route = $_GET['main_route'] ?? "";
    
    $app = new Routes($route);
    $app->run();
}catch (Throwable $e){
    //$data["message"] = preg_replace('{ [^ \w \s \' " ] }x', '', $e->getMessage() );
    
    //$msg = preg_replace('/\PL/u', '_', $e->getMessage());
    //$msg = substr($msg, 0, 300);
    $msg = $e->getMessage();
    $data["message"] = $msg;
    $data["file"] = $e->getFile();
    $data["line"] = $e->getLine();
    $data["stacktrace"] = nl2br($e->getTraceAsString());
    require_once(APP_ROUTE.'views/error.php');
}