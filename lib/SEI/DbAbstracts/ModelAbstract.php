<?php
namespace SEI\DbAbstracts;


use SEI\DbAdapters\DBAdapter;

/**
 * Model abstract class with some base methods
 * @author arsenleontijevic
 * @since 29.09.2019
 *
 */
abstract class ModelAbstract {


	/**
	 * 
	 * @var \SEI\DbAdapters\DbAdapterInterface
	 */
	private $dbAdapter = null;
	
	
	
	
	
	
	public function __construct(){
	    
	    if (file_exists(APP_ROUTE."config/dev.php")) {
	        $config = include(APP_ROUTE."config/dev.php");
	    }else{
	        $config = include(APP_ROUTE."config/prod.php");
	    }
	    
	    $db = new \Phlib\Db\Adapter($config);
	    $dbAdapter = new DBAdapter($db);
	    $this->setDbAdapter($dbAdapter);
	    
	}


/**
 * Set Db Adapter
 * 
 * @param \SEI\DbAdapters\DbAdapterInterface $db
 */
protected function setDbAdapter(\SEI\DbAdapters\DbAdapterInterface $dbAdapter)
{
    
    if (is_null($this->dbAdapter)) {
        $this->dbAdapter = $dbAdapter;
    }
	return $this;
}

/**
 * Get Db Adapter
 * 
 * @param \SEI\DbAdapters\DbAdapterInterface $dbAdapter
 * @return \SEI\DbAdapters\DbAdapterInterface
 */
protected function getDbAdapter()
{
	return $this->dbAdapter;
}
	

public function fetchAll($sQuery){
    return $this->getDbAdapter()->query($sQuery)->fetchAll(\PDO::FETCH_ASSOC);
}




public function count(){
    return $this->getDbAdapter()->count();
}


/**
 * 
 * @return string
 */
public static function getTablePrefix()
{
	return "";
}
	
}