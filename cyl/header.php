<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>CYL Activity System</title>
<link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
<!--<link rel="stylesheet" type="text/css" href="./css/bootstrap.css">-->
<link rel="stylesheet" type="text/css" href="./css/style.css">
<script src="./js/jquery-1.10.2.min.js"></script>
<script src="./js/bootstrap.js"></script>
<link rel="stylesheet" href="css/jquery-ui.css" />
<script src="./js/jquery-ui.js"></script>

<link rel="stylesheet" href="./css/jqx.base.css" type="text/css" />
<link rel="stylesheet" href="./css/jqx.energyblue.css" type="text/css" />
<script type="text/javascript" src="./jqxjs/jqxcore.js"></script>
<script type="text/javascript" src="./jqxjs/jqxdatetimeinput.js"></script> 
<script type="text/javascript" src="./jqxjs/jqxcalendar.js"></script> 
<script type="text/javascript" src="./jqxjs/globalization/globalize.js"></script> 
<script type="text/javascript" src="./jqxjs/jqxdata.js"></script> 
<script type="text/javascript" src="./jqxjs/jqxbuttons.js"></script>
<script type="text/javascript" src="./jqxjs/jqxscrollbar.js"></script>
<script type="text/javascript" src="./jqxjs/jqxmenu.js"></script>
<script type="text/javascript" src="./jqxjs/jqxcheckbox.js"></script>
<script type="text/javascript" src="./jqxjs/jqxlistbox.js"></script>
<script type="text/javascript" src="./jqxjs/jqxdropdownlist.js"></script>
<script type="text/javascript" src="./jqxjs/jqxgrid.js"></script>
<script type="text/javascript" src="./jqxjs/jqxgrid.sort.js"></script> 
<script type="text/javascript" src="./jqxjs/jqxgrid.filter.js"></script> 
<script type="text/javascript" src="./jqxjs/jqxgrid.storage.js"></script> 
<script type="text/javascript" src="./jqxjs/jqxgrid.pager.js"></script> 
<script type="text/javascript" src="./jqxjs/jqxgrid.selection.js"></script> 
<script type="text/javascript" src="./jqxjs/jqxgrid.columnsresize.js"></script> 
<script type="text/javascript" src="./jqxjs/jqxgrid.columnsreorder.js"></script> 
<script type="text/javascript" src="./jqxjs/jqxpanel.js"></script> 
<script type="text/javascript" src="./jqxjs/jqxdata.export.js"></script> 
<script type="text/javascript" src="./jqxjs/jqxdatatable.js"></script> 
<script type="text/javascript" src="./jqxjs/jqxgrid.edit.js"></script> 

</head>
<?php
    session_start();
    include_once "class/dbfactory.php";
    dbfactory::init();
    // $user_id = $this->session->userdata('session_user_id');
    // $user_name = $this->session->userdata('session_user_name');
?>
<body>
<?php include_once "navbar.php";?>