<?php 
include_once "header.php";
?>

    <div class="container" align="center" style="margin-top:5px">
  
        <div class="panel panel-primary" style="width:100%" align="left">
            <div class="panel-heading">
                <h3 class="panel-title"><b>Changing Yooung Lives Foundation Activity System</b></h3>
            </div>

            <div class="panel-body">

                <div style="padding-left:10px;padding-right:10px;">
                    <form class="form-signin" action="class/userControl.php" method="post">
                        <input type="hidden" name="action" id="action" value="login"/>
                        <img src="img/coverimage.jpg" style="width:100%" />
                        
                        <h2>System Login</h2>
                        <input name="user_id" id="user_id" type="text" placeholder="User Name" required="" autofocus="" style="width:40%;">
                        <input name="pwd" id="pwd" type="password" placeholder="Password" required="" style="width:40%;">
                        <button class="btn btn-lg btn-primary" type="submit">Login</button>
                        <!--
                        <label class="checkbox" style="padding-left:20px">
                            <input type="checkbox" value="remember-me"> Remember me
                        </label>
                        -->
                    </form>
                    &nbsp;<br />
                    <?php
                        if(isset($_GET['errorMsg'])&&$_GET['errorMsg']!=""){
                    ?>
                    <div class="alert alert-dismissable alert-danger" style="padding:25px;">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <?=$_GET['errorMsg']?>
                    </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>        
    </div>
<?php include_once "footer.php";?>