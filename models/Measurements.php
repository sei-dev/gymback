<?php
namespace MODELS;
use SEI\DbAdapters\DbAdapterInterface;
use SEI\DbAbstracts\ModelAbstract;
use SEI\DbAbstracts\ModelInterface;

class Measurements extends ModelAbstract implements ModelInterface
{
    
    
    private  $table = "measurements";
    
	
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
				FROM ".self::getTablePrefix()."measurements
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
		
		$sQuery = "SELECT *
				FROM ".self::getTablePrefix().$this->table."
				WHERE 1
                LIMIT {$start}, {$perPage}
				";
		return $this->fetchAll($sQuery);
	}
	
	public function getUserMeasurements(string $id, int $page = 1, int $perPage = 10) {
	    
	    $start = ($page-1) * $perPage;
	    
	    $sQuery = "SELECT *
				FROM ".self::getTablePrefix().$this->table."
				WHERE trainer_id = {'$id'}
                LIMIT {$start}, {$perPage}
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