<?php 
#[\AllowDynamicProperties]
/**
 * 
 * @author arsenleontijevic
 *
 */
class Routes {
    
    private $controller = null;
    private $action = null;
    private $args = null;

    /**
     * 
     * @param array $parameters
     */
    public function __construct($parameters){
        $params = explode("/", trim($parameters, "/"),3);
        //Get route
        $this->controller = isset($params[0]) && !empty($params[0]) ? $params[0] : 'Log';
        $this->action =  isset($params[1]) && !empty($params[1]) ? $params[1] : 'index';
        $this->args = isset($params[2]) ? explode("/", trim($params[2], "/")) : []; 
    }
    
    /**
     * 
     * @throws Exception
     */
    public function run()
    {
        $controller = ucwords($this->controller);
        $action = $this->action;
        if(!file_exists(APP_ROUTE . "controllers/{$controller}.php")){
            throw new Exception("There is no such controller as {$controller}");
        }
        
        require_once APP_ROUTE . "controllers/{$controller}.php";
        if(class_exists($controller)){
            $controller_class = new $controller();
            $controller_class->args = $this->args;
            if(method_exists($controller_class, $this->action)){
                $controller_class->$action($this->args);
            }else{
                throw new Exception("Undefined {$this->action} Method in {$controller} Controller");
            }
        }else{
            throw new Exception("Undefined {$controller} Controller");
        }
    }
}