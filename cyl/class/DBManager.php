<?php
class DBManager{
	public $CONN = "";
	
	public function DBManager($host,$user,$pwd,$db){
		$this->db_connect($host,$user,$pwd,$db);
	}
	
	public function db_connect($host,$user,$pwd,$db){
		$conn = mysql_connect($host,$user,$pwd);
		if(!$conn){
			$this->db_error("Connection failed");
		}
		if(!mysql_select_db($db,$conn)){
			$this->db_error("DataBase select failed");	
		}
		mysql_query("set names 'utf8'");
		$this->CONN = $conn;
		return 1;
	}
	
	public function db_error($text=""){
		$no = mysql_errno();
		$msg = mysql_error();
		echo "[$text] ($no:$msg)<br/>\n";
		exit;
	}
	
	public function db_close(){
		mysql_close($this->CONN);	
	}
}
?>