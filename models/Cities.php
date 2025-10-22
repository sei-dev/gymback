<?php
namespace MODELS;
use SEI\DbAdapters\DbAdapterInterface;
use SEI\DbAbstracts\ModelAbstract;
use SEI\DbAbstracts\ModelInterface;

class Cities extends ModelAbstract implements ModelInterface
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
				FROM ".self::getTablePrefix()."cities
				WHERE id = '{$id}'
				LIMIT 1";
		return $this->getDbAdapter()->query($sQuery)->fetch();
	}
	
	/**
	 * 
	 * @param string $email
	 * @return array
	 */
	public function getAll(int $page = 1, int $perPage = 10, bool $fetchAll = false) {
	    
	    $start = ($page-1) * $perPage;
		
		$sQuery = "SELECT cities.*, countries.country
				FROM cities LEFT JOIN countries ON countries.id = cities.country_id
				WHERE 1
				";
		
		if (!$fetchAll) {
		    $start = ($page - 1) * $perPage;
		    $sQuery .= " LIMIT {$start}, {$perPage}";
		}
		return $this->fetchAll($sQuery);
	}
	
	public function addCity(string $name, string $country_id) {
	    
	    $sQuery = "INSERT INTO cities (city, country_id)
                   VALUES ('{$name}', '{$country_id}');
				";
	    return $this->fetchAll($sQuery);
	}
	
	public function removeCity(string $id){
	    
	    $sQuery = "DELETE FROM cities WHERE id='{$id}'";
	    
	    return $this->fetchAll($sQuery);
	}
	
	public function getCitiesByCountryId(string $id){
	    $sQuery = "SELECT * FROM cities WHERE country_id={$id}
				";
	    
	    return $this->getDbAdapter()->query($sQuery)->fetchAll(\PDO::FETCH_ASSOC);
	}
	
	public function getTotalCount() {
	    $sQuery = "SELECT COUNT(*) as total FROM cities";
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