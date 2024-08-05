<?php
namespace APISDK;

/**
 * APISDK Loader
 * @author arsenleontijevic
 *
 */
class SEILoader {
	
	protected static $prefixes = ["Phlib\\Db\\", "SEI", "Firebase\\JWT\\", "MODELS"];
	/**
	 * 
	 * @param stirng $name
	 * @throws \Exception
	 */
	static public function load($name) {
		
		
		$class = "";
		foreach (self::$prefixes as $prefix)
		{
			$len = strlen($prefix);
			if (strncmp($prefix, $name, $len) !== 0) {
				continue;
			}
			$relative_class = substr($name, $len);
			
			//var_dump($name);
			
			if (strpos($name, "Phlib\\Db\\") !== false) {
				$class = __DIR__ . '/db/src/' . $relative_class . '.php';
			}elseif(strpos($name, "SEI") !== false){
				$class = __DIR__ . '/SEI/' . $relative_class . '.php';
			}elseif(strpos($name, "MODELS") !== false){
			    $class = __DIR__  . '/../models/' . $relative_class . '.php';
			}
		}
		
		$class = str_replace('\\', '/', $class);
		
		
		if (!file_exists($class))
		{
			throw new \Exception("Unable to load $relative_class.");
		}
		require_once($class);
	}
}

spl_autoload_register(__NAMESPACE__ .'\SEILoader::load'); // As of PHP 5.3.0

//require_once(__DIR__ . '/../firebase/php-jwt/src/JWT.php');
