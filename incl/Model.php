<?php
/**
 * 
 * @author arsenleontijevic
 *
 */
class Model {
    
    
    function __construct(){
        //create connection
    }
    
    /**
     * 
     * @param string $model
     * @throws Exception
     * @return Model
     */
    public function load_model($model){
        $model = ucwords($model);
        if(is_file(APP_ROUTE."models/{$model}.php")){
            require_once APP_ROUTE."models/{$model}.php";
            if(class_exists($model)){
                return new $model();
            }else{
                throw new Exception("Undefined {$model} Model");
            }
        }
    }
    
    /**
     * @param array $config
     * @return \PDO
     */
    public function createConnection(array $config)
    {
        return new \PDO(
            $config["dsn"],
            $config["username"],
            $config["passsword"],
            $config["options"]
            );
    }
}