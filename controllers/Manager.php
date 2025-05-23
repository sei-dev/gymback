<?php
use MODELS\Users;
use SEI\Auth;
use MODELS\Gyms;
use MODELS\Trainings;
use MODELS\Measurements;
use MODELS\Cities;
use MODELS\Subscriptions;
use MODELS\Invoices;
use MODELS\Countries;

class Manager extends Controller
{

    const DIR_USERS = "users";
    const DIR_UPLOADS = __DIR__ . "/../../images/";
    //protected $domain = "https://phpstack-1301327-4919665.cloudwaysapps.com/";
    
    /**
     * On Construct call parent construct
     */
    public function __construct()
    {
        parent::__construct();

        $auth = new Auth($this->getDbAdapter());
        if (! $auth->isUserLoggedIn()) {
            $this->redirect('/log/in');
        }
    }

    /**
     *
     * @return string
     */
    public function index()
    {
        $model = new Users($this->getDbAdapter());

        $data["users"] = $model->getAllTrainers($_GET["page"] ?? 1);
        $count = $model->getTotalTrainersCount();
        $data["pagination"] = $this->getPagination("/manager/index", $count, 10);
        $data["count"] = $count;
        
        array_walk($data["users"], function (&$a) {
            if ($this->checkImageExists("https://phpstack-1301327-4919665.cloudwaysapps.com/images/users/" . $a["id"] . ".png?r=" . rand(0, 100000))) {
                $a['image'] = "https://phpstack-1301327-4919665.cloudwaysapps.com/images/users/" . $a["id"] . ".png?r=" . rand(0, 100000);
            } else {
                $a['image'] = "https://phpstack-1301327-4732761.cloudwaysapps.com/images/ikonica.ico";
            }
        });

        //die(var_dump($data["users"]));

        // Render and pass data to the view
        echo $this->render->view('manager/index', $data);
    }
    
    public function clients()
    {
        $model = new Users();
        
        $data["users"] = $model->getAllClients($_GET["page"] ?? 1);
        $count = $model->getTotalClientsCount();
        $data["pagination"] = $this->getPagination("/manager/clients", $count, 10);
        $data["count"] = $count;
        
        array_walk($data["users"], function (&$a) {
            if ($this->checkImageExists("https://phpstack-1301327-4919665.cloudwaysapps.com/images/users/" . $a["id"] . ".png?r=" . rand(0, 100000))) {
                $a['image'] = "https://phpstack-1301327-4919665.cloudwaysapps.com/images/users/" . $a["id"] . ".png?r=" . rand(0, 100000);
            } else {
                $a['image'] = "https://phpstack-1301327-4732761.cloudwaysapps.com/images/ikonica.ico";
            }
        });
        
        // die(var_dump($data["users"]));
        
        // Render and pass data to the view
        echo $this->render->view('manager/clients', $data);
    }

    /**
     *
     * @return string
     */
    public function edituser()
    {
        $id = intval($_GET["id"]);

        $model = new Users();
        $city_model = new Cities();

        $data["user"] = $model->getById($id);
        $data['cities'] = $city_model->getAll();

        if ($data["user"] == false) {
            $this->redirect("/manager/index");
            // throw new Exception("No such user");
        }

        // die(var_dump($data["users"]));

        // Render and pass data to the view
        echo $this->render->view('manager/edituser', $data);
    }

    public function updateuser()
    {
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
        } else if ($this->isGet()) {
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
    public function gyms()
    {
        $model = new Gyms();

        $data["items"] = $model->getAll($_GET["page"] ?? 1);
        $count = $model->count();
        $data["pagination"] = $this->getPagination("/manager/gyms", $count, 10);
        $data["count"] = $count;

        // die(var_dump($data["users"]));

        // Render and pass data to the view
        echo $this->render->view('manager/gyms', $data);
    }
    
    public function usergyms()
    {
        $id = intval($_GET["id"]);
        
        $model = new Gyms();
        
        $data["items"] = $model->getUserGyms($id, $_GET["page"] ?? 1);
        $count = count($data["items"]);
        $data["pagination"] = $this->getPagination("/manager/gyms", $count, 10);
        $data["count"] = $count;
        
        // die(var_dump($data["users"]));
        
        // Render and pass data to the view
        echo $this->render->view('manager/gyms', $data);
    }
    
    public function userinvoices()
    {
        $id = intval($_GET["id"]);
        
        $model = new Invoices();
        
        $data["items"] = $model->getUserInvoices($id, $_GET["page"] ?? 1);
        $count = count($data["items"]);
        $data["pagination"] = $this->getPagination("/manager/invoices", $count, 10);
        $data["count"] = $count;
        
        // die(var_dump($data["users"]));
        
        // Render and pass data to the view
        echo $this->render->view('manager/invoices', $data);
    }
    
    public function usermeasurements()
    {
        $id = intval($_GET["id"]);
        
        $model = new Measurements();
        
        $user_model = new Users();
        
        $users = $user_model->getAllUsers();
        
        $data["items"] = $model->getUserMeasurements($id, $_GET["page"] ?? 1);
        
        $i = 0;
        $e = 0;
        
        foreach ($data["items"] as $measurement) {
            foreach ($users as $user) {
                if ($measurement["trainer_id"] == $user["id"]) {
                    $data["items"][$i]["trainer_name"] = $user["first_name"] . " " . $user["last_name"];
                }
            }
            $i ++;
        }
        
        foreach ($data["items"] as $measurement) {
            foreach ($users as $user) {
                if ($measurement["client_id"] == $user["id"]) {
                    $data["items"][$e]["client_name"] = $user["first_name"] . " " . $user["last_name"];
                }
            }
            $e ++;
        }
        
        $count = count($data["items"]);
        $data["pagination"] = $this->getPagination("/manager/measurements", $count, 10);
        $data["count"] = $count;
        
        // die(var_dump($data["users"]));
        
        // Render and pass data to the view
        echo $this->render->view('manager/measurements', $data);
    }

    public function cities()
    {
        $model = new Cities();

        $data["items"] = $model->getAll($_GET["page"] ?? 1);
        $count = $model->count();
        $data["pagination"] = $this->getPagination("/manager/cities", $count, 10);
        $data["count"] = $count;

        // die(var_dump($data["users"]));

        // Render and pass data to the view
        echo $this->render->view('manager/cities', $data);
    }
    
    public function countries()
    {
        $model = new Countries();
        
        $data["items"] = $model->getAll($_GET["page"] ?? 1);
        $count = $model->count();
        $data["pagination"] = $this->getPagination("/manager/countries", $count, 10);
        $data["count"] = $count;
        
        // die(var_dump($data["users"]));
        
        // Render and pass data to the view
        echo $this->render->view('manager/countries', $data);
    }

    /**
     *
     * @return string
     */
    public function editgym()
    {
        $id = intval($_GET["id"]);

        $model = new Gyms();
        $city_model = new Cities();

        $data["gym"] = $model->getById($id);
        $data['cities'] = $city_model->getAll();

        if ($data["gym"] == false) {
            $this->redirect("/manager/index");
            // throw new Exception("No such user");
        }

        // die(var_dump($data["users"]));

        // Render and pass data to the view
        echo $this->render->view('manager/editgym', $data);
    }

    public function searchGym()
    {
        $param = $_POST["param"];

        $model = new Gyms();

        $data["items"] = $model->searchGym($param, $_GET["page"] ?? 1);
        $count = sizeof($data["items"]);
        $data["pagination"] = $this->getPagination("/manager/gyms", $count, 10);
        $data["count"] = sizeof($data["items"]);

        echo $this->render->view('manager/gyms', $data);
    }
    
    public function subscriptions()
    {
        
        $model = new Subscriptions();
        
        $data["items"] = $model->getAll();
        $count = sizeof($data["items"]);
        $data["pagination"] = $this->getPagination("/manager/subscriptions", $count, 10);
        $data["count"] = sizeof($data["items"]);
        
        echo $this->render->view('manager/subscriptions', $data);
    }
    
    public function editsubscription()
    {
        
        $id = intval($_GET["id"]);
        
        $model = new Subscriptions();
        
        $data["subscription"] = $model->getById($id);
        
        if ($data["subscription"] == false) {
            $this->redirect("/manager/index");
            // throw new Exception("No such user");
        }
        
        //die(var_dump($data["subscription"]));
        
        echo $this->render->view('manager/editsubscription', $data);
    }
    
    public function invoices()
    {
        
        $model = new Invoices();
        
        $data["items"] = $model->getAll($_GET["page"] ?? 1);
        $count = $model->getTotalCount();
        $data["pagination"] = $this->getPagination("/manager/invoices", $count, 10);
        $data["count"] = $count;
        
        echo $this->render->view('manager/invoices', $data);
    }

    public function searchtrainer()
    {
        $param = $_POST["param"];

        $model = new Users();
        

        $data["users"] = $model->searchTrainer($param, $_GET["page"] ?? 1);
        $count = $model->countSearchedTrainers($param);
        $data["pagination"] = $this->getPagination("/manager/searchtrainer", $count, 10);
        $data["count"] = $count;

        array_walk($data["users"], function (&$a) {
            if ($this->checkImageExists("https://phpstack-1301327-4919665.cloudwaysapps.com/images/users/" . $a["id"] . ".png?r=" . rand(0, 100000))) {
                $a['image'] = "https://phpstack-1301327-4919665.cloudwaysapps.com/images/users/" . $a["id"] . ".png?r=" . rand(0, 100000);
            } else {
                $a['image'] = "https://phpstack-1301327-4732761.cloudwaysapps.com/images/ikonica.ico";
            }
        });

        echo $this->render->view('manager/index', $data);
    }
    
    public function searchclient()
    {
        $param = $_POST["param"];
        
        $model = new Users();
        
        
        $data["users"] = $model->searchClient($param, $_GET["page"] ?? 1);
        $count = $model->countSearchedClients($param);
        $data["pagination"] = $this->getPagination("/manager/clients", $count, 10);
        $data["count"] = $count;
        
        /* array_walk($data["users"], function (&$a) {
         if ($this->isFileExists(self::DIR_USERS, $a["id"])) {
         $a['image'] = $this->domain . "/images/users/" . $a["id"] . ".png?r=" . rand(0, 100000);
         } else {
         $a['image'] = $this->domain . "/images/users/logo.png";
         }
         }); */
        
        /*
         * $data["items"] = $model->searchGym($param, $_GET["page"] ?? 1);
         * $count = sizeof($data["items"]);
         * $data["pagination"] = $this->getPagination("/manager/gyms", $count, 10);
         * $data["count"] = sizeof($data["items"]);
         */
        
        echo $this->render->view('manager/clients', $data);
    }
    
    public function disableclient()
    {
        $id = intval($_GET["id"]);
        
        $model = new Users();
        
        $model->disableUser($id, $_GET["page"] ?? 1);
        $count = $model->count();
        $data["pagination"] = $this->getPagination("/manager/clients", $count, 10);
        $data["count"] = $count;
        

        $this->redirect("/manager/clients");
    }
    
    public function disabletrainer()
    {
        $id = intval($_GET["id"]);
        
        $model = new Users();
        
        $model->disableUser($id, $_GET["page"] ?? 1);
        $count = $model->count();
        $data["pagination"] = $this->getPagination("/manager/clients", $count, 10);
        $data["count"] = $count;
        
        
        $this->redirect("/manager/index");
    }

    public function addcity()
    {
        $country_model = new Countries();
        
        $data['countries'] = $country_model->getAll();
        
        echo $this->render->view('manager/addcity', $data);
    }
    
    public function addcountry()
    {
        echo $this->render->view('manager/addcountry');
    }

    public function insertcity()
    {
        $model = new Cities();

        if ($this->isPost()) {

            $name = $_POST["city"];
            $country_id = $_POST["country"];

            $model->addCity($name, $country_id);

            $this->redirect("/manager/cities");
        } else if ($this->isGet()) {
            $data["messages"] = @$_SESSION["messages"];
        }

        echo $this->render->view('manager/addcity', $data);
    }

    public function insertcountry()
    {
        $model = new Countries();
        
        if ($this->isPost()) {
            
            $name = $_POST["country"];
            
            $model->addCity($name);
            
            $this->redirect("/manager/countries");
        } else if ($this->isGet()) {
            $data["messages"] = @$_SESSION["messages"];
        }
        
        echo $this->render->view('manager/addcountry', $data);
    }
    
    public function addGym()
    {
        $model = new Cities();

        $data['cities'] = $model->getAll();

        echo $this->render->view('manager/addgym', $data);
    }

    public function insertgym()
    {
        $model = new Gyms();

        if ($this->isPost()) {

            $city_id = $_POST["city"];
            $name = $_POST["name"];
            $address = $_POST["address"];
            $phone = $_POST["phone"];

            $model->addGym($name, $address, $city_id, $phone);

            $this->redirect("/manager/gyms");
        } else if ($this->isGet()) {
            $data["messages"] = @$_SESSION["messages"];
        }

        echo $this->render->view('manager/addgym', $data);
    }

    public function updategym()
    {
        $model = new Gyms();

        if ($this->isPost()) {

            $id = $_POST["id"];
            $name = $_POST["name"];
            $address = $_POST["address"];
            $city = $_POST["city"];
            $phone = $_POST["phone"];

            $model->upadateGym($id, $name, $address, $city,$phone);

            $this->redirect("/manager/gyms");
        } else if ($this->isGet()) {
            $data["messages"] = @$_SESSION["messages"];
        }

        echo $this->render->view('manager/editgym', $data);
    }
    
    public function updatesubscription()
    {
        $model = new Subscriptions();
        
        if ($this->isPost()) {
            
            $id = $_POST["id"];
            $price = $_POST["price"];
            
            $model->updateSubscription($price, $id);
            
            $this->redirect("/manager/subscriptions");
        } else if ($this->isGet()) {
            $data["messages"] = @$_SESSION["messages"];
        }
        
        echo $this->render->view('manager/editsubscription', $data);
    }

    /**
     * TRAININGS
     */

    /**
     *
     * @return string
     */
    public function trainings()
    {
        $model = new Trainings();

        $user_model = new Users();

        $gym_model = new Gyms();

        $users = $user_model->getAllUsers();
        $gyms = $gym_model->getAll();

        $data["items"] = $model->getAll($_GET["page"] ?? 1);

        $i = 0;
        $e = 0;

        foreach ($data["items"] as $training) {
            foreach ($users as $user) {
                if ($training["trainer_id"] == $user["id"]) {
                    $data["items"][$i]["name"] = $user["first_name"] . " " . $user["last_name"];
                }
            }
            $i ++;
        }

        foreach ($data["items"] as $training) {
            foreach ($gyms as $gym) {
                if ($training["gym_id"] == $gym["id"]) {
                    $data["items"][$e]["gym"] = $gym["name"];
                }
            }
            $e ++;
        }

        $count = $model->count();
        $data["pagination"] = $this->getPagination("/manager/trainings", $count, 10);
        $data["count"] = $count;

        // die(var_dump($data["items"]));

        // Render and pass data to the view
        echo $this->render->view('manager/trainings', $data);
    }

    /**
     *
     * @return string
     */
    public function edittraining()
    {
        $id = intval($_GET["id"]);

        $model = new Trainings();

        $data["training"] = $model->getById($id);

        if ($data["training"] == false) {
            $this->redirect("/manager/index");
            // throw new Exception("No such user");
        }

        // die(var_dump($data["users"]));

        // Render and pass data to the view
        echo $this->render->view('manager/edittraining', $data);
    }

    /**
     * MEASUREMENTS
     */

    /**
     *
     * @return string
     */
    public function measurements()
    {
        $model = new Measurements();

        $user_model = new Users();

        $users = $user_model->getAllUsers();

        $data["items"] = $model->getAll($_GET["page"] ?? 1);

        $i = 0;
        $e = 0;

        foreach ($data["items"] as $measurement) {
            foreach ($users as $user) {
                if ($measurement["trainer_id"] == $user["id"]) {
                    $data["items"][$i]["trainer_name"] = $user["first_name"] . " " . $user["last_name"];
                }
            }
            $i ++;
        }

        foreach ($data["items"] as $measurement) {
            foreach ($users as $user) {
                if ($measurement["client_id"] == $user["id"]) {
                    $data["items"][$e]["client_name"] = $user["first_name"] . " " . $user["last_name"];
                }
            }
            $e ++;
        }

        $count = $model->count();
        $data["pagination"] = $this->getPagination("/manager/measurements", $count, 10);
        $data["count"] = $count;

        // die(var_dump($data["users"]));

        // Render and pass data to the view
        echo $this->render->view('manager/measurements', $data);
    }

    public function tof()
    {

        // $model = new Measurements();

        // $user_model = new Users();

        // $users = $user_model->getAllUsers();

        // $data["items"] = $model->getAll($_GET["page"]??1);

        /*
         * $i=0;
         * $e=0;
         *
         * foreach ($data["items"] as $measurement){
         * foreach ($users as $user){
         * if($measurement["trainer_id"]==$user["id"]){
         * $data["items"][$i]["trainer_name"] = $user["first_name"] ." ". $user["last_name"];
         * }
         * }
         * $i++;
         * }
         *
         * foreach ($data["items"] as $measurement){
         * foreach ($users as $user){
         * if($measurement["client_id"]==$user["id"]){
         * $data["items"][$e]["client_name"] = $user["first_name"] ." ". $user["last_name"];
         * }
         * }
         * $e++;
         * }
         */

        // $count = $model->count();
        // $data["pagination"] = $this->getPagination("/manager/index", $count, 10);
        // $data["count"] = $count;

        // die(var_dump($data["users"]));

        // Render and pass data to the view
        echo $this->render->view('manager/termsofservice');
    }

    /**
     *
     * @return string
     */
    public function editmeasurements()
    {
        $id = intval($_GET["id"]);

        $model = new Measurements();

        $data["training"] = $model->getById($id);

        if ($data["training"] == false) {
            $this->redirect("/manager/index");
            // throw new Exception("No such user");
        }

        // die(var_dump($data["users"]));

        // Render and pass data to the view
        echo $this->render->view('manager/editmeasurements', $data);
    }
    
    public function removegym()
    {
        $id = intval($_GET["id"]);
        
        $model = new Gyms();
        
        $model->removeGym($id);
        $count = $model->count();
        $data["pagination"] = $this->getPagination("/manager/gyms", $count, 10);
        $data["count"] = $count;
        
        
        $this->redirect("/manager/gyms");
    }
    
    public function removetraining()
    {
        $id = intval($_GET["id"]);
        
        $model = new Trainings();
        
        $model->removeTraining($id);
        $count = $model->count();
        $data["pagination"] = $this->getPagination("/manager/gyms", $count, 10);
        $data["count"] = $count;
        
        
        $this->redirect("/manager/trainings");
    }
    
    public function removemeas()
    {
        $id = intval($_GET["id"]);
        
        $model = new Measurements();
        
        $model->removeMeasurement($id);
        $count = $model->count();
        $data["pagination"] = $this->getPagination("/manager/gyms", $count, 10);
        $data["count"] = $count;
        
        
        $this->redirect("/manager/measurements");
    }
    
    public function removecity()
    {
        $id = intval($_GET["id"]);
        
        $model = new Cities();
        
        $model->removeCity($id);
        $count = $model->count();
        $data["pagination"] = $this->getPagination("/manager/cities", $count, 10);
        $data["count"] = $count;
        
        
        $this->redirect("/manager/cities");
    }
    
    public function removecountry()
    {
        $id = intval($_GET["id"]);
        
        $model = new Countries();
        
        $model->removeCountry($id);
        $count = $model->count();
        $data["pagination"] = $this->getPagination("/manager/countries", $count, 10);
        $data["count"] = $count;
        
        
        $this->redirect("/manager/countries");
    }

    private function isFileExists($dir, $id)
    {
        return file_exists(self::DIR_UPLOADS . DIRECTORY_SEPARATOR . $dir . DIRECTORY_SEPARATOR . $id . ".png");
    }
    
    function checkImageExists($url) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return ($httpCode == 200);
    }
    
    /**
     * On destruct
     */
    public function __destruct()
    {}
}