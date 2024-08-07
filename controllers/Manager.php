<?php


use MODELS\Users;
use SEI\Auth;
use MODELS\Gyms;
use MODELS\Trainings;
use MODELS\Measurements;

class Manager extends Controller {
    
    /**
     * On Construct call parent construct
     */
    public function __construct(){
        parent::__construct();
        
        $auth = new Auth($this->getDbAdapter());
        if (!$auth->isUserLoggedIn()) {
            $this->redirect('/log/in');
        }
    }
    
    /**
     * 
     * @return string
     */
    public function index(){
        
        
        $model = new Users();
        
        $data["users"] =  $model->getAllUsers($_GET["page"]??1);
        $count = $model->count();
        $data["pagination"] = $this->getPagination("/manager/index", $count, 10);
        $data["count"] = $count;
        
        //die(var_dump($data["users"]));
        
        //Render and pass data to the view
        echo $this->render->view('manager/index', $data);
     }
     
     /**
      *
      * @return string
      */
     public function edituser(){
         
         $id = intval($_GET["id"]);
         
         $model = new Users();
         
         $data["user"] = $model->getById($id);
         
         if ($data["user"] == false) {
             $this->redirect("/manager/index");
             //throw new Exception("No such user");
         }
         
         //die(var_dump($data["users"]));
         
         //Render and pass data to the view
         echo $this->render->view('manager/edituser', $data);
     }
    
     public function updateuser(){
         
         $model = new Users();
         
         
         if ($this->isPost()) {
             
             
             $id = $_POST["id"];
             $first_name = $_POST["first_name"];
             $last_name = $_POST["last_name"];
             $email = $_POST["email"];
             $phone = $_POST["phone"];
             $location = $_POST["location"];
             $deadline = $_POST["deadline"];
             
             $model->upadateUser($id, $first_name, $last_name, $email, $phone, $location, $deadline);
             
             $this->redirect("/manager/index");
             
         }else if ($this->isGet()) {
             $data["messages"] = @$_SESSION["messages"];
         }
         
         
         echo $this->render->view('manager/edituser', $data);
     }
     
     
     /**
      * GYMS
      */
     
     
     /**
      *
      * @return string
      */
     public function gyms(){
         
         
         $model = new Gyms();
         
         $data["items"] =  $model->getAll($_GET["page"]??1);
         $count = $model->count();
         $data["pagination"] = $this->getPagination("/manager/index", $count, 10);
         $data["count"] = $count;
         
         //die(var_dump($data["users"]));
         
         //Render and pass data to the view
         echo $this->render->view('manager/gyms', $data);
     }
     
     /**
      *
      * @return string
      */
     public function editgym(){
         
         $id = intval($_GET["id"]);
         
         $model = new Gyms();
         
         $data["gym"] = $model->getById($id);
         
         if ($data["gym"] == false) {
             $this->redirect("/manager/index");
             //throw new Exception("No such user");
         }
         
         //die(var_dump($data["users"]));
         
         //Render and pass data to the view
         echo $this->render->view('manager/editgym', $data);
     }
     
     public function updategym(){
         
         $model = new Gyms();
         
         
         if ($this->isPost()) {
             
             
             $id = $_POST["id"];
             $name = $_POST["name"];
             $address = $_POST["address"];
             $city = $_POST["city"];
             
             $model->upadateGym($id, $name, $address, $city);
             
             $this->redirect("/manager/gyms");
             
         }else if ($this->isGet()) {
             $data["messages"] = @$_SESSION["messages"];
         }
         
         
         echo $this->render->view('manager/editgym', $data);
     }
     
     /**
      * TRAININGS
      */
     
     
     /**
      *
      * @return string
      */
     public function trainings(){
         
         
         $model = new Trainings();
         
         $user_model = new Users();
         
         $gym_model = new Gyms();
         
         $users = $user_model->getAllUsers();
         $gyms = $gym_model->getAll();
         
         
         $data["items"] =  $model->getAll($_GET["page"]??1);
         
         $i=0;
         $e=0;
         
         foreach ($data["items"] as $training){
             foreach ($users as $user){
                 if($training["trainer_id"]==$user["id"]){
                     $data["items"][$i]["name"] = $user["first_name"] ." ". $user["last_name"];
                 }
             }
             $i++;
         }
         
         foreach ($data["items"] as $training){
             foreach ($gyms as $gym){
                 if($training["gym_id"]==$gym["id"]){
                     $data["items"][$e]["gym"] = $gym["name"];
                 }
             }
             $e++;
         }
         
         $count = $model->count();
         $data["pagination"] = $this->getPagination("/manager/index", $count, 10);
         $data["count"] = $count;
         
         //die(var_dump($data["items"]));
         
         //Render and pass data to the view
         echo $this->render->view('manager/trainings', $data);
     }
     
     /**
      *
      * @return string
      */
     public function edittraining(){
         
         $id = intval($_GET["id"]);
         
         $model = new Trainings();
         
         $data["training"] = $model->getById($id);
         
         if ($data["training"] == false) {
             $this->redirect("/manager/index");
             //throw new Exception("No such user");
         }
         
         //die(var_dump($data["users"]));
         
         //Render and pass data to the view
         echo $this->render->view('manager/edittraining', $data);
     }
     
     /**
      * MEASUREMENTS
      */
     
     
     /**
      *
      * @return string
      */
     public function measurements(){
         
         
         $model = new Measurements();
         
         $user_model = new Users();
         
         $users = $user_model->getAllUsers(); 
         
         
         $data["items"] =  $model->getAll($_GET["page"]??1);
         
         $i=0;
         $e=0;
         
         foreach ($data["items"] as $measurement){
             foreach ($users as $user){
                 if($measurement["trainer_id"]==$user["id"]){
                     $data["items"][$i]["trainer_name"] = $user["first_name"] ." ". $user["last_name"];
                 }
             }
             $i++;
         }
         
         foreach ($data["items"] as $measurement){
             foreach ($users as $user){
                 if($measurement["client_id"]==$user["id"]){
                     $data["items"][$e]["client_name"] = $user["first_name"] ." ". $user["last_name"];
                 }
             }
             $e++;
         }
         
         
         $count = $model->count();
         $data["pagination"] = $this->getPagination("/manager/index", $count, 10);
         $data["count"] = $count;
         
         //die(var_dump($data["users"]));
         
         //Render and pass data to the view
         echo $this->render->view('manager/measurements', $data);
     }
     
     /**
      *
      * @return string
      */
     public function editmeasurements(){
         
         $id = intval($_GET["id"]);
         
         $model = new Measurements();
         
         $data["training"] = $model->getById($id);
         
         if ($data["training"] == false) {
             $this->redirect("/manager/index");
             //throw new Exception("No such user");
         }
         
         //die(var_dump($data["users"]));
         
         //Render and pass data to the view
         echo $this->render->view('manager/editmeasurements', $data);
     }
    
    /**
     * On destruct
     */
    public function __destruct(){
        
    }

}