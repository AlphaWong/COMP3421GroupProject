<?php
if (isset($_SESSION['user_id']))
{
?>
<div class="navbar-default navbar-static-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!--
            <a class="navbar-brand" href="#">Membership System</a>
            -->
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="./home.php">Home</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Activity Management<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Activity Setup</a></li>
                        <li><a href="#">......</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Reports<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Report 1</a></li>
                        <li><a href="#">Report 2</a></li>
                    </ul>
                </li>
                <li><a href="usersetup.php">User Management</a></li>
                <li><a href="javascript:document.getElementById('frmLogout').submit();">Logout</a></li>
            </ul>
            <!--
            <ul class="nav navbar-nav navbar-right">
                    <li><a href="javascript:document.getElementById('frmLogout').submit();"><img src="img/logout.png" style="height:30px"/> Logout</a></li>
            </ul>
            -->
                    <form name="frmLogout" id="frmLogout" action="class/userControl.php" method="post">
                    <input type="hidden" name="action" id="action" value="logout"/>
                    </form>
        </div><!--/.nav-collapse -->
    </div>
</div>
<?php
}
?>
<!--

                <form class="navbar-form navbar-left">
                    <input type="text" class="form-control col-lg-8" placeholder="Search">
                </form>
-->              