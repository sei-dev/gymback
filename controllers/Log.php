<?php


use SEI\Auth;
use SEI\Validation;

class Log extends Controller {
    
    /**
     * On Construct call parent construct
     */
    public function __construct(){
        parent::__construct();
        $this->setLayout("log_layout");
    }
    
    /**
     * 
     * @return string
     */
    public function in(){
        
        $auth = new Auth($this->getDbAdapter());
        $v = new Validation();
        
        if ($auth->isUserLoggedIn()) {
            $this->redirect('/manager/index');
        }
        
        $inputs = [];
        $errors = [];
        
        if ($this->isPost()) {
            
            [$inputs, $errors] = $v->filter($_POST, [
                'email' => 'string | required',
                'password' => 'string | required',
                //'remember_me' => 'string'
            ]);
            
            
            if ($errors) {
                $this->redirectWith('/log/in', ['errors' => $errors, 'inputs' => $inputs]);
            }
            
            // if login fails
            //isset($inputs['remember_me'])
            if (!$auth->login($inputs['email'], $inputs['password'], true)) {
                
                $errors['login'] = 'Invalid username or password';
                
                $this->redirectWith('/log/in', [
                    'errors' => $errors,
                    'inputs' => $inputs
                ]);
            }
            
            // login successfully
            $this->redirect('/manager/index');
            
        } else if ($this->isGet()) {
            $data["messages"] = @$_SESSION["messages"];
        }
        
        
        //Render and pass data to the view
        echo $this->render->view('log/in', $data);
     }
     
     
     /**
      *
      * @return string
      */
     public function index(){
         
         $this->redirect("/log/in");
     }
     
     public function tof(){
         
         echo $this->render->view('manager/termsofservice');
     }
     
     public function success(){
         
         echo $this->render->view('manager/success');
     }
     
     public function out(){
         
         $auth = new Auth($this->getDbAdapter());
         
         if ($auth->logout()) {
             $this->redirect('/log/in');
         }
         //Render and pass data to the view
         echo $this->render->view('default', []);
     }
    
    
    /**
     * On destruct
     */
    public function __destruct(){
        
    }
    
}