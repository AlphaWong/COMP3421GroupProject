<?php
class dbfactory{
	public static $db;
	public static $domain;
					
	public static function init(){
		if(!is_object(self::$db)){
			include_once "config/dbConf.php";
			include_once "class/DBManager.php";
                        self::$db = new DBManager($DBHOST,$DBUSER,$DBPWD,$DBNAME);
			self::$domain = $DOMAIN;
		}
	}
	
	public static function destory(){
		if(is_object(self::$db)){
			self::$db->db_close();
			self::$db = null;	
		}
	}
	
	public static function load($className){		
		include_once "class/".$className.".php";
                //include_once $className.".php";
		eval("\$object=".$className."::getInstance(self::\$db);");
		return $object;		
	}
	
	public static function generalFunction(){
		include_once "class/generalFunctions.php";
                //include_once "generalFunctions.php";
		return generalFunctions::getInstance(self::$db);	
	}
}
?>