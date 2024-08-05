<?php
namespace SEI\DbAdapters;


class DBAdapter extends DbAdapterAbstract implements DbAdapterInterface
{
	
	/**
	 * DB Driver
	 * 
	 * @var \Phlib\Db\Adapter
	 */
	private $db = null;
	
	/**
	 *
	 * @var string
	 */
	private $dbTable = null;
	
	/**
	 *
	 * @param  $db
	 */
	public function __construct(\Phlib\Db\Adapter $db)
	{
		$this->db = $db;
	}
	
	/**
	 * Set Db Table
	 *
	 * @param DbAdapterInterface $db
	 */
	public function setDbTable(string $dbTable)
	{
		$this->dbTable = $dbTable;
		return $this;
	}
	
	/**
	 * Query
	 *
	 * @param string $sql
	 * @return array
	 */
	public function escape(string $sql)
	{
		return $this->db->escape($sql);
	}
	
	/**
	 * Quote
	 *
	 * @param $value
	 * @return mixed
	 */
	public function quote($value)
	{
		return $this->db->quote($value);
	}
		
	/**
	* Query
	*
	* @param string $sql
	* @return array
	*/
	public function query(string $sql)
	{
		return $this->db->query($sql);
	}
	
	/**
	 * Query
	 *
	 * @param string $sql
	 * @return \PDOStatement
	 */
	public function prepare(string $sql)
	{
	    return $this->db->prepare($sql);
	}
	
	/**
	 * Query
	 *
	 * @param string $sql
	 * @return array
	 */
	public function count()
	{
	    $sql = "SELECT COUNT(*) cnt FROM {$this->dbTable}";
	    return $this->db->query($sql)->fetchColumn(); 
	}
	
	
	/**
	 * 
	 * @param string $table
	 * @param array $data
	 * @see DbAdapterInterface::insert()
	 */
	public function insert(array $data)
	{
		$res = $this->db->insert($this->dbTable, $data);
		if($res)
		{
			return $this->db->insert_id();
		}else{
			return false;
		}
	}
	
	/**
	 *
	 * @param string $table
	 * @param array $data
	 * @see DbAdapterInterface::insert()
	 */
	public function update(array $data)
	{
		if(!isset($data['id']) || intval($data['id']) < 1)
		{
			throw new \Exception("Update function requires id key in provided data array");
		}
		$this->db->where('id', $data['id']);
		unset($data['id']);
		$this->db->update($this->dbTable, $data);
		return $this->db->affected_rows();  
	}
}