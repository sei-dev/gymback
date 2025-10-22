<?php
namespace MODELS;
use SEI\DbAdapters\DbAdapterInterface;
use SEI\DbAbstracts\ModelAbstract;
use SEI\DbAbstracts\ModelInterface;

class Countries extends ModelAbstract implements ModelInterface
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
				FROM ".self::getTablePrefix()."countries
				WHERE id = '{$id}'
				LIMIT 1";
		return $this->getDbAdapter()->query($sQuery)->fetch();
	}
	
	/**
	 * 
	 * @param string $email
	 * @return array
	 */
	public function getAll(int $page = 1, int $perPage = 10, , bool $fetchAll = false) {
	    
	    $start = ($page-1) * $perPage;
		
		$sQuery = "SELECT *
				FROM countries
				WHERE 1
                LIMIT {$start}, {$perPage}
				";
		
		if (!$fetchAll) {
		    $start = ($page - 1) * $perPage;
		    $sQuery .= " LIMIT {$start}, {$perPage}";
		}
		return $this->fetchAll($sQuery);
	}
	
	public function addCity(string $name) {
	    
	    $sQuery = "INSERT INTO countries (country)
                   VALUES ('{$name}');
				";
	    return $this->fetchAll($sQuery);
	}
	
	public function removeCountry(string $id){
	    
	    $sQuery = "DELETE FROM countries WHERE id='{$id}'";
	    
	    return $this->fetchAll($sQuery);
	}
	
	public function getTotalCount() {
	    $sQuery = "SELECT COUNT(*) as total FROM countries";
	    return $this->fetchAll($sQuery)['0']["total"];
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