<?php
/**
 * 
 * @author arsenleontijevic
 *
 */
class Render {
    
    protected $content = null;
    protected $data =[];
    protected $layout = null;
    
    /**
     * 
     * @param string $view_filename
     * @param array $data
     * @throws Exception
     * @return string
     */
    public function view($view_filename, $data = []){
        
        /*
         * CONVERT PARAMS TO ROUTE OBJECT PROPERTIES
         */
        foreach($data as $key => $value){
            $this->data[$key] = $value;
        }
        
        /*
         * GET CONFIG
         */
        $config = include(APP_ROUTE."config/config.php");
        
        /*
         * CHECK LAYOUT EXISTS
         */
        if($this->layout){
            $layout_filename = APP_ROUTE."views/layout/{$this->layout}.php";
        }else{
            $layout_filename = APP_ROUTE."views/layout/{$config["layout"]}.php";
        }
        if (is_readable($layout_filename)) {
            
            /*
             * CHECK VIEW EXISTS
             */
            $view_filename = APP_ROUTE."views/{$view_filename}.php";
            if (is_readable($view_filename)) {
                
                /*
                 * OPEN OUTPUT BUFFER, COLLECT ALL ECHOED OUTPUT OF VIEW TO ONE PLACE
                 */
               
                ob_start();
                try{
                    include_once $view_filename;
                    //Set view output to layout content variable
                    $this->content = ob_get_contents();
                    ob_end_clean();
                }catch (Throwable $t){
                    ob_end_clean();
                    throw new Exception($t->getMessage() . ". View file {$view_filename}");
                }
                
                
                /*
                 * OPEN OUTPUT BUFFER, COLLECT ALL ECHOED OUTPUT OF LAYOUT
                 */
                ob_start();
                try{
                    include_once $layout_filename;
                    $sLayoutContent = ob_get_contents();
                    ob_end_clean();
                }catch (Throwable $t){
                    ob_end_clean();
                    throw new Exception($t->getMessage());
                }
                ob_start();
                
                /*
                 * CLOSE OUTPUT BUFFER AND REUTRN COUGHT OUTPUT
                 */
                return $sLayoutContent;
                
                
            } else {
                throw new Exception('View ' . $view_filename . ' not found');
            }
        }else{
            throw new Exception('Layout ' . $layout_filename . ' not found');
        }
    }
    
    /**
     * 
     * @param String $view_filename
     * @param array $data
     * @throws Exception
     * @return string
     */
    public function partial($view_filename, $data = []){
        $data = (object) $data;
         
        /*
         * CHECK VIEW EXISTS
         */
        $view_filename = APP_ROUTE."views/layout/partials/{$view_filename}.php";
        if (is_readable($view_filename)) {
            /*
             * OPEN OUTPUT BUFFER, COLLECT ALL ECHOED OUTPUT TO ONE PLACE
             */
            ob_start();
            include_once $view_filename;
            $sContent = ob_get_contents();
            ob_end_clean();
            
            /*
             * CLOSE OUTPUT BUFFER AND REUTRN COUGHT OUTPUT
             */
            return $sContent;
        } else {
            throw new Exception('View ' . $view_filename . ' not found');
        }
    }
    
    /**
     *
     * @param string $layout
     * @return Controller
     */
    public function setLayout($layout){
        $this->layout = $layout;
        return $this;
    }
    
    
    /**
     *
     * @param string $name
     * @return mixed|NULL
     */
    public function __get(string $name)
    {
        if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        }
        
        $trace = debug_backtrace();
        trigger_error(
            'Undefined view property: ' . $name .
            ' in ' . $trace[0]['file'] .
            ' on line ' . $trace[0]['line'],
            E_USER_NOTICE);
        return null;
    }
    
    
    
    public function humanReadable($dateString){
        $date=date_create($dateString);
        return date_format($date,"d. m. Y");
    }
    
    
    
    public function translate($string){
        return $string;
    }
    
}