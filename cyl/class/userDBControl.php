<?php
include_once "generalFunctions.php";

class userDBControl extends generalFunctions{
	private static $instance;
	
	public static function getInstance($db) {
            if (!is_object(self::$instance)) {
                self::$instance = new self($db);
            }
            return self::$instance;
        }
	
	public function getUserByUserName($username){
                        $sql = "select usr_email, usr_pwd from backenduser where usr_email = '$username';";
                        $r = $this->select($sql);
                        return $r;	
	}
        
	public function getUsers(){
                        $sql = "select * from backenduser order by usr_id;";
                        $r = $this->select($sql);
                        return $r;	
	}
        
                /* Sample Functions
	public function getUsersByKeys($idfrm,$idto,$status){
                $sql = "select * from cl_usr left outer join cl_usrphoto on usr_id = usp_id "
                        ."where ( (usr_id >= '$idfrm' and usr_id <= '$idto') "
                        . "or ('$idfrm' = '' and '$idto' = '') ) "
                        . "and (usr_status = '$status' or '$status' = '') "
                        ."order by usr_id;";
                $r = $this->select($sql);
                return $r;
	}
        
	public function getUsersByKeysJ($idfrm,$idto,$status){
                $sql = "select * from cl_usr left outer join cl_usrphoto on usr_id = usp_id "
                        ."where ( (usr_id >= '$idfrm' and usr_id <= '$idto') "
                        . "or ('$idfrm' = '' and '$idto' = '') ) "
                        . "and (usr_status = '$status' or '$status' = '') "
                        ."order by usr_id;";
                $r = $this->select($sql);
                //$data = array();
                //$data['promotions'] = $r;
                //$json = json_encode($data);
                $json = json_encode($r);
                return $json;
	}
        
	public function getUserNum(){
                $sql = "select ifnull(max(usr_id),10000)+1 as usernum from cl_usr;";
                $r = $this->select($sql);
                return $r;
	}
        
	public function addUser($id, $loginname, $nname, $fname, $lname, $pwd, $email, $status, $cdate, $cuser, $path){
            $usr_id = isset($id) ? $id : "";
            $usr_loginname = isset($loginname) ? $loginname : "";
            $usr_nname = isset($nname) ? $nname : "";
            $usr_fname = isset($fname) ? $fname : "";
            $usr_lname = isset($lname) ? $lname : "";
            $usr_pwd = isset($pwd) ? $pwd : "";
            $usr_email = isset($email) ? $email : "";
            $usr_status = isset($status) ? $status : "active";
            $usr_cdate = isset($cdate) ? $cdate : "";
            $usr_cuser = isset($cuser) ? $cuser : "";
            $usp_path = isset($path) ? $path : "";
            
            $usr_loginname = mysql_real_escape_string($usr_loginname);
            $usr_nname = mysql_real_escape_string($usr_nname);
            $usr_fname = mysql_real_escape_string($usr_fname);
            $usr_lname = mysql_real_escape_string($usr_lname);
            $sql = "insert into cl_usr (usr_id, "
                    ."usr_loginname, "
                    ."usr_nname, "
                    ."usr_fname, "
                    ."usr_lname, "
                    ."usr_pwd, "
                    ."usr_email, "
                    ."usr_status, "
                    ."usr_cdate, "
                    ."usr_cuser) "
                    ."values (ifnull((select max(usr_id) from cl_usr as usr),10000)+1, "
                    ."'$usr_loginname', "
                    ."'$usr_nname', "
                    ."'$usr_fname', "
                    ."'$usr_lname', "
                    ."md5('$usr_pwd'), "
                    ."'$usr_email', "
                    ."'$usr_status', "
                    ."now(), "
                    ."'$usr_cuser');";
            $r = $this->execute($sql);
            if ($r = 1) {
                    $sql = "insert into cl_usrphoto (usp_id, usp_path) values ((select max(usr_id) from cl_usr as usr),'$usp_path') "
                            ."on duplicate key update usp_path = values(usp_path);";
                    $r = $this->execute($sql);
            }
            return $r;
	}
        
	public function editUser($id, $loginname, $nname, $fname, $lname, $pwd, $email, $status, $cdate, $cuser, $path){
            $usr_id = isset($id) ? $id : "";
            $usr_loginname = isset($loginname) ? $loginname : "";
            $usr_nname = isset($nname) ? $nname : "";
            $usr_fname = isset($fname) ? $fname : "";
            $usr_lname = isset($lname) ? $lname : "";
            $usr_pwd = isset($pwd) ? $pwd : "";
            $usr_email = isset($email) ? $email : "";
            $usr_status = isset($status) ? $status : "";
            $usr_cdate = isset($cdate) ? $cdate : "";
            $usr_cuser = isset($cuser) ? $cuser : "";
            $usp_path = isset($path) ? $path : "";
            
            $usr_loginname = mysql_real_escape_string($usr_loginname);
            $usr_nname = mysql_real_escape_string($usr_nname);
            $usr_fname = mysql_real_escape_string($usr_fname);
            $usr_lname = mysql_real_escape_string($usr_lname);
            $sql = "update cl_usr "
                    ."set usr_loginname = '$usr_loginname', "
                    ."usr_nname = '$usr_nname', "
                    ."usr_fname = '$usr_fname', "
                    ."usr_lname = '$usr_lname', "
                    ."usr_pwd = '$usr_pwd', "
                    ."usr_email = '$usr_email', "
                    ."usr_status = '$usr_status', "
                    ."usr_cdate = '$usr_cdate', "
                    ."usr_cuser = '$usr_cuser' "
                    ."where usr_id = '$usr_id';";
            $r = $this->execute($sql);
            if ($r = 1) {
                    $sql = "insert into cl_usrphoto (usp_id, usp_path) values ('$usr_id','$usp_path') "
                            ."on duplicate key update usp_path = values(usp_path);";
                    $r = $this->execute($sql);
            }
            return $r;
	}
        
	public function delUser($id){
            $usr_id = isset($id) ? $id : "";
            $sql = "delete from cl_usr where usr_id = '$usr_id';";
            $r = $this->execute($sql);
            if ($r = 1) {
                    $sql = "delete from cl_usrphoto where usp_id = '$usr_id';";
                    $r = $this->execute($sql);
            }
            return $r;
	}
            */
}
?>