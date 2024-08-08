<?php
namespace MODELS;
use SEI\DbAdapters\DbAdapterInterface;
use SEI\DbAbstracts\ModelAbstract;
use SEI\DbAbstracts\ModelInterface;

class Invoices extends ModelAbstract implements ModelInterface
{
    
    
    private  $table = "invoices";
    
	
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
		$sQuery = "SELECT invoices.id, invoices.created_on, invoices.paid_on, invoices.item_id, invoices.client_id,
                    invoices.trainer_id, A.first_name as trainer_first_name, A.last_name as trainer_last_name,
                    invoice_items.name, invoice_items.price, B.first_name as client_first_name,
                    B.last_name as client_last_name
                    FROM invoices
                    LEFT JOIN users A
                    ON invoices.trainer_id = A.id
                    LEFT JOIN invoice_items
                    ON invoices.item_id = invoice_items.id
                    LEFT JOIN users B
                    ON invoices.client_id = B.id
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
		
		$sQuery = "SELECT invoices.id, invoices.created_on, invoices.paid_on, invoices.item_id, invoices.client_id,
                    invoices.trainer_id, A.first_name as trainer_first_name, A.last_name as trainer_last_name,
                    invoice_items.name, invoice_items.price, B.first_name as client_first_name,
                    B.last_name as client_last_name
                    FROM invoices
                    LEFT JOIN users A
                    ON invoices.trainer_id = A.id
                    LEFT JOIN invoice_items
                    ON invoices.item_id = invoice_items.id
                    LEFT JOIN users B
                    ON invoices.client_id = B.id
                LIMIT {$start}, {$perPage}
				";
		return $this->fetchAll($sQuery);
	}
	
	public function upadateGym(string $id, string $name, string $address, string $city) {
	    
	    $sQuery = "UPDATE gyms
				SET name = '{$name}', address = '{$address}', city='{$city}'
                WHERE id = '{$id}'
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