<?php
namespace MODELS;
use SEI\DbAdapters\DbAdapterInterface;
use SEI\DbAbstracts\ModelAbstract;
use SEI\DbAbstracts\ModelInterface;

class Gyms extends ModelAbstract implements ModelInterface
{
    
    
    private  $table = "gyms";
    
	
	/**
	 * 
	 * @param DbAdapterInterface $db
	 */
	public function __construct()
	{
	    parent::__construct();
		$this->getDbAdapter()->setDbTable(self::getTablePrefix().$this->table);
	}
	/**
	 *
	 * @param string $email
	 * @return array
	 */
	public function getById(string $id) {
		//$id = $this->getDbAdapter()->
		$sQuery = "SELECT *
				FROM ".self::getTablePrefix()."gyms
				WHERE id = '{$id}'
				LIMIT 1";
		return $this->getDbAdapter()->query($sQuery)->fetch();
	}
	
	/**
	 * 
	 * @param string $email
	 * @return array
	 */
	public function getAll(int $page = 1, int $perPage = 10) {
	    
	    $start = ($page-1) * $perPage;
		
		$sQuery = "SELECT gyms.*, cities.city
				FROM gyms LEFT JOIN cities ON gyms.city_id = cities.id
				WHERE 1
                LIMIT {$start}, {$perPage}
				";
		return $this->fetchAll($sQuery);
	}
	
	public function getUserGyms(string $id, int $page = 1, int $perPage = 10) {
	    
	    $start = ($page-1) * $perPage;
	    
	    $sQuery = "SELECT gyms.*, cities.city FROM gyms 
                    LEFT JOIN cities ON cities.id = gyms.city_id 
                    LEFT JOIN trainer_gyms ON trainer_gyms.gym_id = gyms.id
                    WHERE trainer_gyms.user_id = '{$id}'
                    LIMIT {$start}, {$perPage}
				";
	    return $this->fetchAll($sQuery);
	}
	
	public function upadateGym(string $id, string $name, string $address, string $city, string $phone) {
	    
	    $sQuery = "UPDATE gyms
				SET name = '{$name}', address = '{$address}', city_id='{$city}', phone='{$phone}'
                WHERE id = '{$id}';
				";
	    return $this->fetchAll($sQuery);
	}
	
	public function addGym(string $name, string $address, string $city_id, string $phone) {
	    
	    $sQuery = "INSERT INTO gyms (name, address, city_id, phone)
				VALUES ('{$name}','{$address}','{$city_id}','{$phone}');
				";
	    return $this->fetchAll($sQuery);
	}
	
	public function searchGym(string $param, int $page = 1, int $perPage = 10) {
	    
	    $start = ($page-1) * $perPage;
	    
	    $sQuery = "SELECT gyms.*, cities.city
				FROM gyms LEFT JOIN cities ON gyms.city_id = cities.id WHERE name LIKE '%{$param}%' LIMIT {$start}, {$perPage};
				";
	    return $this->fetchAll($sQuery);
	}
	
	public function removeGym(string $id){
	    
	    $sQuery = "DELETE FROM gyms WHERE id='{$id}'";
	    
	    return $this->fetchAll($sQuery);
	}
	
	/**
	 *
	 * @param string $email
	 * @param string $password
	 * @return array
	 */
	public function signup(string $firstName, string $password) {
		
		
		$data = [
				"first_name"=>$firstName,
				"password"=>$password
		];
		
		return $this->getDbAdapter()->insert($data);
	}
	
	
	
	/**
	 *
	 * @param array $data
	 * @return array
	 */
	public function update(array $data) {
		return $this->getDbAdapter()->update($data);
	}
	
}