<?php 
use SEI\DbAdapters\DBAdapter;

/**
 * 
 * @author arsenleontijevic
 *
 */
class Controller {

    protected $render;
    
    public $args = [];
    
    public function __construct(){
        $this->render = new Render();
    }
    
    /**
     * 
     * @param string $model
     * @return Model
     */
    public function load_model($model){
        $model_main = new Model();
        return $model_main->load_model($model);
    }
    
    /**
    *
    * @param string $layout
    * @return Controller
    */
    public function setLayout($layout){
        $this->render->setLayout($layout);
        return $this;
    }
    
    
    function redirect($url, $permanent = false)
    {
        if (headers_sent() === false)
        {
            header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
        }
        
        exit();
    }
    
    
    
    function redirectWith($url, array $session, $permanent = false)
    {
        $_SESSION["messages"] = $session;
        
        if (headers_sent() === false)
        {
            header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
        }
        
        exit();
    }
    
    /**
     * 
     * @param unknown $param
     * @return bool
     */
    function isPost():bool {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }
    
    /**
     *
     * @param unknown $param
     * @return bool
     */
    function isGet():bool {
        return $_SERVER['REQUEST_METHOD'] === 'GET';
    }
 
    
    function getDbAdapter() {
        if (file_exists(APP_ROUTE."config/dev.php")) {
            $config = include(APP_ROUTE."config/dev.php");
        }else{
            $config = include(APP_ROUTE."config/prod.php");
        }
        
        $db = new \Phlib\Db\Adapter($config);
        return new DBAdapter($db);
    }
    
    
    /**
     * 
     * @param unknown $url
     * @param unknown $page
     * @param unknown $count
     * @param number $perPage
     */
    public function getPagination($url, $count, $perPage = 10)
    {
        $page = isset($_GET["page"]) ? intval($_GET["page"]) : 1;
        $pages = ceil($count / $perPage);
        $html = '<ul class="pagination pagination-sm inline">';
        
        $start = max(1, $page - 3);
        $end = min($pages, $page + 3);
        
        // Adjust range if we're near the start
        if ($page <= 4) {
            $end = min(7, $pages);
        }
        
        // Adjust range if we're near the end
        if ($page > $pages - 4) {
            $start = max(1, $pages - 6);
        }
        
        // Determine the separator (? or &) based on whether the URL already has a query string
        $separator = strpos($url, '?') !== false ? '&' : '?';
        
        if ($page > 1) {
            $html .= '<li><a href="' . $url . $separator . 'page=' . ($page - 1) . '">«</a></li>';
        }
        
        for ($i = $start; $i <= $end; $i++) {
            if ($i == $page) {
                $html .= '<li class="active"><a href="' . $url . $separator . 'page=' . $i . '"><span>' . $i . '</span></a></li>';
            } else {
                $html .= '<li><a href="' . $url . $separator . 'page=' . $i . '">' . $i . '</a></li>';
            }
        }
        
        if ($page < $pages) {
            $html .= '<li><a href="' . $url . $separator . 'page=' . ($page + 1) . '">»</a></li>';
        }
        
        $html .= '</ul>';
        return $html;
    }
    
}