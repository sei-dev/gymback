<?php
namespace MODELS;
use SEI\DbAdapters\DbAdapterInterface;
use SEI\DbAbstracts\ModelAbstract;
use SEI\DbAbstracts\ModelInterface;

class Invoices extends ModelAbstract implements ModelInterface
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
				FROM ".self::getTablePrefix()."invoices
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
		
		$sQuery = "SELECT invoices.*, users.first_name, users.last_name
				FROM invoices
                LEFT JOIN users ON invoices.trainer_id = users.id
				WHERE 1
                LIMIT {$start}, {$perPage}
				";
		return $this->fetchAll($sQuery);
	}
	
	public function getUserInvoices(string $id, int $page = 1, int $perPage = 10) {
	    
	    $start = ($page-1) * $perPage;
	    
	    $sQuery = "SELECT invoices.*, users.first_name, users.last_name
				FROM invoices
                LEFT JOIN users ON invoices.trainer_id = users.id
				WHERE invoices.trainer_id = '{$id}'
                LIMIT {$start}, {$perPage}
				";
	    return $this->fetchAll($sQuery);
	}
	
	public function updateSubscription(string $price, string $id) {
	    
	    $sQuery = "UPDATE invoices
				SET price = '{$price}'
                WHERE id = '{$id}'
				";
	    return $this->fetchAll($sQuery);
	}
	
	/* public function addCity(string $name) {
	    
	    $sQuery = "INSERT INTO cities (city)
                   VALUES ('{$name}');
				";
	    return $this->fetchAll($sQuery);
	} */
	
	
	/**
	 *
	 * @param array $data
	 * @return array
	 */
	public function update(array $data) {
		return $this->getDbAdapter()->update($data);
	}
	
}