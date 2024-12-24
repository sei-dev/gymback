<?php
namespace MODELS;
use SEI\DbAdapters\DbAdapterInterface;
use SEI\DbAbstracts\ModelAbstract;
use SEI\DbAbstracts\ModelInterface;

class Users extends ModelAbstract implements ModelInterface
{
    
    
    private  $table = "users";
    
	
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
		$sQuery = "SELECT users.*, cities.city as location
				FROM ".self::getTablePrefix()."users
                LEFT JOIN cities ON users.city_id = cities.id
				WHERE users.id = '{$id}'
				LIMIT 1";
		return $this->getDbAdapter()->query($sQuery)->fetch();
	}
	
	/**
	 * 
	 * @param string $email
	 * @return array
	 */
	public function getAllTrainers(int $page = 1, int $perPage = 10) {
	    
	    $start = ($page-1) * $perPage;
		
		$sQuery = "SELECT users.*, cities.city as location FROM users LEFT JOIN cities ON users.city_id = cities.id
				   WHERE is_trainer = 1
                   LIMIT {$start}, {$perPage}
				";
		return $this->fetchAll($sQuery);
	}
	
	public function getAllClients(int $page = 1, int $perPage = 10) {
	    
	    $start = ($page-1) * $perPage;
	    
	    $sQuery = "SELECT users.*, cities.city as location FROM users LEFT JOIN cities ON users.city_id = cities.id
				   WHERE is_trainer = 0
                   LIMIT {$start}, {$perPage}
				";
	    return $this->fetchAll($sQuery);
	}
	
	public function upadateUser(string $id, string $first_name, string $last_name, string $email,
	                           string $phone, string $location, string $deadline) {
	   
	    $sQuery = "UPDATE users
				SET first_name = '{$first_name}', last_name = '{$last_name}', email = '{$email}',
                phone = '{$phone}', location = '{$location}', deadline = '{$deadline}'
                WHERE id = '{$id}'
				";
	    return $this->fetchAll($sQuery);
	}
	
	public function searchTrainer(string $param, int $page = 1, int $perPage = 10) {
	    
	    $start = ($page-1) * $perPage;
	    
	    $sQuery = "SELECT users.*, cities.city as location
				FROM users LEFT JOIN cities ON users.city_id = cities.id WHERE is_trainer = 1 AND (first_name LIKE '%{$param}%' OR last_name LIKE '%{$param}%') LIMIT {$start}, {$perPage};
				";
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