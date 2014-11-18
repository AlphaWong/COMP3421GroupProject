<?php
class generalFunctions{
	private static $instance;
	private $CONN = "";
	
	public function __construct($db=""){
		$this->CONN = $db->CONN;
	}
	
	public static function getInstance($db) {
        if (!is_object(self::$instance)) {
            self::$instance = new self($db);
        }
        return self::$instance;
    }
	
    public function select($sql,$selectType=MYSQL_ASSOC){
		if(empty($this->CONN)){
			return;	
		}
		$res = mysql_query($sql,$this->CONN);
		if((!$res)or(empty($res))){
			return;	
		}
		$count = 0;
		$data = array();
		while($row = mysql_fetch_array($res,$selectType)){
			$data[$count] = $row;
			$count++;	
		}
		mysql_free_result($res);
		if($count==0){
			return;
		}
		else{
			$lastData = $this->unquoteSlashes($data);	
			return $lastData;
		}
	}
	
	public function unquoteSlashes($ary) {
        foreach ($ary as $c => $b) {
            if (is_array($b))
                $ary[$c] = self::unquoteSlashes($b);
            else
                $ary[$c] = stripslashes($b);
        }
        return $ary;
    }
	
	public function execute($sql) {
        //$sql = $this->replaceTableName($sql);
        if (empty($sql))
            return;
        if (empty($this->CONN))
            return;
        $res = mysql_query($sql, $this->CONN);
        if (!$res)
            return;
        return 1;
    }
}
?>