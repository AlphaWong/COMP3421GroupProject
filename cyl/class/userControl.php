<?php include_once "controlSetting.php";?>

<?php
	session_start();
	$userDBControl = controlfactory::load('userDBControl');
	
        extract($_POST);
        switch($action){
                case "login":
                        $user = $userDBControl->getUserByUserName($user_id);
                        if (count($user) == 0) 
                        {
                            header("location:../index.php"."?errorMsg=User Name is not exist.");
                        }
                        else
                        {
                            //if ($user[0]['usr_pwd'] <> md5($pwd))
                            if ($user[0]['usr_pwd'] <> $pwd)
                            {
                                header("location:../index.php"."?errorMsg=Password is wrong.");
                            }
                            else
                            {
				$_SESSION['user_id']=$user_id;
				//$_SESSION['user_name']=$loginFunctions->getUserName($user_id);
				header("location:../home.php");
                            }
                        }
			break;
            case "logout":
                     session_destroy();
	header("location:../index.php");
                     break;
/*      Sample case
                 case "userManagement":
                        $purpose = isset($del_purpose) ? $del_purpose : $purpose;
                        if ($purpose == "add" || $purpose == "edit") 
                        {
                                $maxNum = $userDBControl->getUserNum();
                                $genNum = $maxNum[0]['usernum'];
                                $id = ($purpose == "add") ? $genNum : $id;
                            
                                //if(!isset($_FILES["largepicpath"]) || $_FILES["largepicpath"]["name"]==""){
                                //	$largepic = $ori_largepic;
                                //}else
                                if(!isset($_FILES["userphotopath"]) || $_FILES["userphotopath"]["name"]==""){
                                    $storagepath = "upload/userphoto/nouser.png";
                                } else {
                                    if($_FILES["userphotopath"]["error"] > 0){
                                        $errormsg = $_FILES["userphotopath"]["error"];
                                        $storagepath = "upload/userphoto/nouser.png";
                                    } else {
                                        $storagepath = "upload/userphoto/$id.jpg";
                                    }
                                }

                                    //if($_FILES["largepicpath"]["size"] > $MAX_FILE_SIZE){
                                        //echo "File must be smaller than ".$MAX_FILE_SIZE." Bytes";
                                        //die();
                                    //}

                                    move_uploaded_file($_FILES["userphotopath"]["tmp_name"],"../".$storagepath);
                                    sleep(1);
                        }
                        
                        switch($purpose){
                                case "add" :
                                        $result = $userDBControl->addUser($id, 
                                                $loginname, 
                                                $nname, 
                                                $fname, 
                                                $lname, 
                                                $pwd, 
                                                $email, 
                                                $status, 
                                                $cdate, 
                                                $cuser, 
                                                $storagepath);
                                        echo "add:".$result;
                                        header("Location:"."../".$source."?page=".$pagenum);
                                        //header("refresh:1;url="."../".$source);
                                        //header("refresh:5;url=".$redirect);
                                        break;
                                case "edit" :
                                        $result = $userDBControl->editUser($id, 
                                                $loginname, 
                                                $nname, 
                                                $fname, 
                                                $lname, 
                                                $pwd, 
                                                $email, 
                                                $status, 
                                                $cdate, 
                                                $cuser, 
                                                $storagepath);
                                        //echo "edit:".$result;
                                        header("Location:"."../".$source."?page=".$pagenum);
                                        //header("refresh:1;url="."../".$source);
                                        //header("refresh:5;url=".$redirect);
                                        break;
                                case "del" :
                                        $result = $userDBControl->delUser($del_id);
                                        //echo "delete:".$result;
                                        header("Location:"."../".$source."?page=".$pagenum);
                                        //header("refresh:1;url="."../".$source);
                                        //header("refresh:5;url=".$redirect);
                                        break;
                        }
                        break;
 */
	}
?>