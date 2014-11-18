<?php 
include_once "header.php";
$userDBControl = dbfactory::load('userDBControl');

extract($_POST);
$usridfrm = (isset($usridfrm)) ? $usridfrm : "";
$usridto = (isset($usridto)) ? $usridto : "";
$searchstatus = (isset($searchstatus)) ? $searchstatus : "";

$users = $userDBControl->getUsersByKeys($usridfrm,$usridto,$searchstatus);
//$usersJ = $userDBControl->getUsersByKeysJ($usridfrm,$usridto,$searchstatus);

        //$fileSize = 200000;
        $per = 5;  //Number of item display per page
        $pages = ceil(sizeof($users)/$per);  //Total pages
        if(!isset($_GET["page"])){ 
            $page=1; //Setup the start pages
        } else { 
            $page = intval($_GET["page"]); //Identify whether the $page variable is integer
            $page = ($page > 0) ? $page : 1; //Identify whether the $page variable is greater than 0 
            $page = ($pages > $page) ? $page : $pages; //Make sure the user haven't input some strange numbers  
        }
        $start = ($page-1)*$per; //The first item in page
        $data = (count($users)>0) ? array_slice($users,$start,$per) : $users;
?>

<script>
$(function() {
    $("#dialog").dialog({
        autoOpen: false,
        height: 500,
        width: 800,
        modal: true,
        resizable: false
        //resizable: false,
        //buttons: {
        //    Cancel: function() {
        //      $(this).dialog("close");
        //    },
        //    "Confirm": function() {
        //      $("#editStoreForm").submit();
        //    }
        //}
    });
});

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#userphoto').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
<script>
     $(document).ready(function(){
            var data = '<?=json_encode($users)?>';

            var imagerenderer = function (row, datafield, value) {
                return '<img style="margin-left:8px;width:75px;height:75px;" src="' + value + '" />';
            }
            
            // prepare the data
            var source =
            {
                datatype: "json",
                datafields: [
                    { name: 'usr_id', type: 'string' },
                    { name: 'usr_loginname', type: 'string' },
                    { name: 'usr_nname', type: 'string' },
                    { name: 'usr_fname', type: 'string' },
                    { name: 'usr_lname', type: 'string' },
                    { name: 'usr_pwd', type: 'string' },
                    { name: 'usr_email', type: 'string' },
                    { name: 'usr_status', type: 'string' },
                    { name: 'usr_cdate', type: 'string' },
                    { name: 'usr_cuser', type: 'string' },
                    { name: 'usp_path', type: 'string' }
                ],
                pagesize: 5,
                localdata: data
            };
            var dataAdapter = new $.jqx.dataAdapter(source);

            $("#jqxgrid").jqxGrid(
            {
                width: 838,
                source: dataAdapter,
                columnsresize: true,
                rowsheight: 75,
                height: 430,
                //autoheight: true,
                pageable: true,
                sortable: true,
                altrows: true,
                //enabletooltips: true,
                editable: false,
                showfilterrow: true,
                filterable: true,
                //selectionmode: 'multiplecellsadvanced',
                theme: 'energyblue',
                columns: [
                    { text: 'Picture', datafield: 'usp_path', width: 88, cellsalign: 'center', align: 'center', cellsrenderer: imagerenderer },
                    { text: 'User ID', datafield: 'usr_id', width: 100, cellsalign: 'center', align: 'center' },
                    { text: 'Login Name', datafield: 'usr_loginname', width: 100, cellsalign: 'center', align: 'center' },
                    { text: 'Email', datafield: 'usr_email', width: 190, cellsalign: 'center', align: 'center' },
                    { text: 'Last Name', datafield: 'usr_lname', width: 100, cellsalign: 'center', align: 'center' },
                    { text: 'First Name', datafield: 'usr_fname', width: 100, cellsalign: 'center', align: 'center' },
                    { text: 'Edit', columntype: 'button', width: 80, cellsrenderer: function () {
                        return "Edit";
                    }, buttonclick: function (row) {
                        editrow = row;
                        var dataRecord = $("#jqxgrid").jqxGrid('getrowdata', editrow);
                        $('#purpose').val("edit");
                        $('#userphoto').attr("src",dataRecord.usp_path)
                        //var status = dataRecord.usr_status;
                        //$("#status").filter(function() {
                        //    return $("#status").text() == status; 
                        //}).attr('selected', true);
                        $("#id").val(dataRecord.usr_id);
                        $("#loginname").val(dataRecord.usr_loginname);
                        $("#nname").val(dataRecord.usr_nname);
                        $("#fname").val(dataRecord.usr_fname);
                        $("#lname").val(dataRecord.usr_lname);
                        $("#pwd").val(dataRecord.usr_pwd);
                        $("#email").val(dataRecord.usr_email);
                        $("#status").val(dataRecord.usr_status);
                        $("#cdate").val(dataRecord.usr_cdate);
                        $("#cuser").val(dataRecord.usr_cuser);
                        $("#userphotopath").replaceWith($("#userphotopath").val("").clone(true));
                        $("#userphotopath").val("");
                        $("#btnCancel").click(function(){
                            $("#dialog").dialog("close");
                        });
                        $("#userphotopath").change(function(){
                            readURL(this);
                        });
                        $("#dialog").dialog("open");
                        }
                    },
                    { text: 'Delete', columntype: 'button', width: 80, cellsrenderer: function () {
                        return "Delete";
                    }, buttonclick: function (row) {
                        delrow = row;
                        var dataRecord = $("#jqxgrid").jqxGrid('getrowdata', delrow);
                        $('<div></div>').appendTo('body')
                            .html('<div align="center"><h4>Do you sure delete the user?</h4><br /><h4 align="center"><b>'+dataRecord.usr_nname+'</b></h4></div>')
                            .dialog({
                                modal: true,
                                title: 'Delete User',
                                zIndex: 10000,
                                autoOpen: true,
                                width: 'auto',
                                resizable: false,
                                buttons: {
                                    Yes: function () {
                                        $("#del_id").val(dataRecord.usr_id);
                                        $("#delForm").submit();
                                    },
                                    No: function () {
                                        $(this).dialog("close");
                                    }
                                },
                                close: function (event, ui) {
                                    $(this).remove();
                                }
                            });
                        }
                    }
                ]
            });
            
            // initialize jqxDataTable
            $("#dataTable").jqxDataTable(
            {
                width: 0,
                height: 0,
                source: dataAdapter,
                columns: [
                    { text: 'Picture', datafield: 'usp_path', width: 88, cellsalign: 'center', align: 'center', cellsrenderer: imagerenderer },
                    { text: 'User ID', datafield: 'usr_id', width: 100, cellsalign: 'center', align: 'center' },
                    { text: 'Login Name', datafield: 'usr_loginname', width: 100, cellsalign: 'center', align: 'center' },
                    { text: 'Email', datafield: 'usr_email', width: 190, cellsalign: 'center', align: 'center' },
                    { text: 'Last Name', datafield: 'usr_lname', width: 100, cellsalign: 'center', align: 'center' },
                    { text: 'First Name', datafield: 'usr_fname', width: 100, cellsalign: 'center', align: 'center' },
                ]
            });
            $("#excelExport").jqxButton();
            $("#excelExport").click(function () {
                    $("#dataTable").jqxDataTable('exportData', 'xls');
            });

         
         $("#addUser").click(function(){
            $("#dialog").dialog("open");
            $('#purpose').val("add");
            $('#pagenum').val("<?=$pages?>");
            $('#userphoto').attr("src","upload/userphoto/nouser.png");
            $("#id").val("(System Gen.)");
            $("#loginname").val("");
            $("#nname").val("");
            $("#fname").val("");
            $("#lname").val("");
            $("#pwd").val("");
            $("#email").val("");
            $("#status").val("");
            $("#cdate").val("<?=date("Y-m-d H:i:s")?>");
            $("#cuser").val("<?=$_SESSION['user_id']?>");
            $("#userphotopath").replaceWith($("#userphotopath").val("").clone(true));
            $("#userphotopath").val("");
            $("#btnCancel").click(function(){
                $("#dialog").dialog("close");
            });
            $("#userphotopath").change(function(){
                readURL(this);
            });
         });
<?php
    for ($i=0; $i<count($data); $i++) {
?>          
         $("#edit_<?=$data[$i]['usr_id']?>").click(function(){
            $("#dialog").dialog("open");
            $('#purpose').val("edit");
            $('#userphoto').attr("src","<?=($data[$i]['usp_path'] <> '') ? $data[$i]['usp_path'] : "upload/userphoto/nouser.png"?>")
            var status = "<?=$data[$i]['usr_status']?>";
            $("#status").filter(function() {
                return $("#status").text() == status; 
            }).attr('selected', true);
            $("#id").val("<?=$data[$i]['usr_id']?>");
            $("#loginname").val("<?=$data[$i]['usr_loginname']?>");
            $("#nname").val("<?=$data[$i]['usr_nname']?>");
            $("#fname").val("<?=$data[$i]['usr_fname']?>");
            $("#lname").val("<?=$data[$i]['usr_lname']?>");
            $("#pwd").val("<?=$data[$i]['usr_pwd']?>");
            $("#email").val("<?=$data[$i]['usr_email']?>");
            $("#status").val("<?=$data[$i]['usr_status']?>");
            $("#cdate").val("<?=$data[$i]['usr_cdate']?>");
            $("#cuser").val("<?=$data[$i]['usr_cuser']?>");
            $("#userphotopath").replaceWith($("#userphotopath").val("").clone(true));
            $("#userphotopath").val("");
            $("#btnCancel").click(function(){
                $("#dialog").dialog("close");
            });
            $("#userphotopath").change(function(){
                readURL(this);
            });
         });
<?php
    }
?>
    });
</script>

    <div class="container" align="center" style="margin-top:5px;">

        <div class="panel panel-primary" style="width:100%" align="left">
            <div class="panel-heading">
                <!--    <h3 class="panel-title"><a href="./login"><span class="glyphicon glyphicon-chevron-left"></span></a> Warehouse Management System</h3>   -->
                <h3 class="panel-title"><img src="img/user.png" style="height:30px;margin-right:5px;"/><b>User Management</b></h3>
            </div>

            <div class="panel-body" style="margin-left: 15px;margin-top: 10px;margin-bottom: 10px;margin-right: 15px;">
                <form id="searchform" name="searchform" method="post" action="usersetup.php">
                <div>
                    <div class="left">
                        User ID:&nbsp;&nbsp;
                        <input type="text" name="usridfrm" id="usridfrm" placeholder="" value="<?=$usridfrm?>" style="width:150px;"/>
                        &nbsp;&nbsp;to&nbsp;&nbsp;
                        <input type="text" name="usridto" id="usridfrm" placeholder="" value="<?=$usridto?>" style="width:150px;"/>
                        &nbsp;&nbsp;Status:&nbsp;&nbsp;
                        <select id="searchstatus" name="searchstatus" style="width:150px;">
                            <option value=""<?=($searchstatus == "") ? " selected=\"selected\"": ""?>></option>
                            <option value="active"<?=($searchstatus == "active") ? " selected=\"selected\"": ""?>>active</option>
                            <option value="inactive"<?=($searchstatus == "inactive") ? " selected=\"selected\"": ""?>>inactive</option>
                        </select>
                        &nbsp;&nbsp;<button onclick="javascript:document.getElementById('searchform').submit();">Search</button>
                    </div>
                    <div class="right" style="margin-top: 4px">
                        <a id="addUser" href="javascript:void(0)" class="add-button"><span>Add User</span></a>
                    </div>
                </div>
                </form>
            </div>
            
            <div class="panel-body">
                <!--
                <div class="table">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                        <th style="width:20px;text-align:center;"><input type="checkbox" class="checkbox" /></th>
                        <th>Photo</th>
                        <th>User ID</th>
                        <th>User Name</th>
                        <th>User Email</th>
                        <th>&nbsp;</th>
                        </tr>
                        <?php
                            for ($i=0; $i<count($data); $i++) {
                        ?>
                        <tr>
                        <td><input type="checkbox" class="checkbox" /></td>
                            <td class="ac" style="width:75px"><img src="<?=($data[$i]['usp_path'] <> '') ? $data[$i]['usp_path'] : "upload/userphoto/nouser.png"?>" style="width:75px;"/></td>
                        <td><?=$data[$i]['usr_id']?></td>
                        <td><?=$data[$i]['usr_lname'].' '.$data[$i]['usr_fname']?></td>
                        <td><?=$data[$i]['usr_email']?></td>
                        <td class="ac">
                            <form id="del_<?=$data[$i]['usr_id']?>" name="del_<?=$data[$i]['usr_id']?>" method="post" action="class/userControl.php">
                            <input type="hidden" id="action" name="action" value="userManagement"/>
                            <input type="hidden" id="del_purpose" name="del_purpose" value="del"/>
                            <input type="hidden" id="source" name="source" value="usersetup.php" />
                            <input type="hidden" id="pagenum" name="pagenum" value="<?=$page?>" />
                            <input type="hidden" id="del_id" name="del_id" value="<?=$data[$i]['usr_id']?>" />
                            <a href="javascript:void(0)" id="edit_<?=$data[$i]['usr_id']?>" class="ico edit">Edit</a>
                            <a href="javascript:document.getElementById('del_<?=$data[$i]['usr_id']?>').submit();" onclick="return confirm('Do you sure delete the user?')" class="ico del">Delete</a>
                            </form>
                        </td>
                        </tr>
                        <?php } ?>
                    </table>
                    
		    <div class="pagging">
                        <div class="left">Showing <?=$start+1?> - <?=$start+count($data)?> of <?=" total: ".count($users)." records"?></div>
			<div class="right">
                        <?php   //These codes are page selection list
                        if(count($data)>0){
                            if ($page > 1){
                                echo '<a href="?page='.($page-1).'">Previous</a>';
                            }

                            for($i=1;$i<=$pages;$i++) { 
                                if($i == $page){
                                    echo '<a href="?page='.$i.'">' . $i . '</a>';
                                } else{
                                    echo '<a href="?page='.$i.'">' . $i . '</a>'; 
                                }
                            }

                            if($page < $pages){
                                echo '<a href="?page='.($page+1).'">Next</a>';
                            }
                        }
                        ?>
			</div>
                    </div>
                </div>
                -->
                <div id='jqxWidget' style="font-size: 13px; font-family: Verdana;">
                    <div id="jqxgrid">
                    </div>
                </div>
                <div id="dataTable" style="visibility: hidden;"></div>
                <div>
                    <div class="left">
                            <form id="delForm" name="delForm" method="post" action="class/userControl.php">
                            <input type="hidden" id="action" name="action" value="userManagement"/>
                            <input type="hidden" id="del_purpose" name="del_purpose" value="del"/>
                            <input type="hidden" id="source" name="source" value="usersetup.php" />
                            <input type="hidden" id="pagenum" name="pagenum" value="<?=$page?>" />
                            <input type="hidden" id="del_id" name="del_id" value="" />
                            </form>
                    </div>
                    <div class="right">
                        <input type="button" value="Export to Excel" id='excelExport' />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="dialog" title="User Modification">
        <div class="table" align="center">
        <form id="editUser" method="post" action="class/userControl.php" runat="server" enctype="multipart/form-data">
        <input type="hidden" id="action" name="action" value="userManagement"/>
        <input type="hidden" id="purpose" name="purpose" value=""/>
        <input type="hidden" id="source" name="source" value="usersetup.php" />
        <input type="hidden" id="pagenum" name="pagenum" value="<?=$page?>" />
            <table style="width:100%;">
                <tr>
                    <td rowspan="8" style="width:25%;" align="center">
                        <img id="userphoto" name="userphoto" style="width:100%"/><br />
                        <input type="file" id="userphotopath" name="userphotopath" style="width: 100%" />
                    </td>
                    <td><label>User ID</label></td>
                    <td><input type="text" id="id" name="id" style="width: 125px" readonly="readonly"></td>
                    <td><label class="col-lg-2 control-label">Status</label></td>
                    <td>
                        <select id="status" name="status" style="width: 125px">
                            <option value="active">active</option>
                            <option value="inactive">inactive</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label>Login Name</label></td>
                    <td colspan="3"><input type="text" id="loginname" name="loginname" style="width: 400px"/></td>                  
                </tr>  
                <tr>
                    <td><label>Nick Name</label></td>
                    <td colspan="3"><input type="text" id="nname" name="nname" style="width: 400px"/></td>   
                </tr>  
                <tr>
                    <td><label>Last Name</label></td>
                    <td><input type="text" id="lname" name="lname" style="width: 125px"/></td>
                    <td><label>First Name</label></td>
                    <td><input type="text" id="fname" name="fname" style="width: 125px"/></td>
                </tr>  
                <tr>
                    <td><label>Login Password</label></td>
                    <td colspan="3"><input type="password" id="pwd" name="pwd" style="width: 400px"/></td>                  
                </tr>  
                <tr>
                    <td><label>Email Address</label></td>
                    <td colspan="3"><input type="text" id="email" name="email" style="width: 400px"/></td> 
                </tr>
                <tr>
                    <td><label>Creation Date</label></td>
                    <td colspan="3"><input type="text" id="cdate" name="cdate" style="width: 400px" readonly="readonly"/></td> 
                </tr>
                <tr>
                    <td><label>Creation User</label></td>
                    <td colspan="3"><input type="text" id="cuser" name="cuser" style="width: 400px" readonly="readonly"/></td> 
                </tr>
                <tr>
                    <td colspan="2">&nbsp;</td>
                    <td colspan="3">
                        <a href="javascript:void(0)" id="btnCancel" class="btn btn-default">Cancel</a>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </td>
                </tr>
            </table>  
        </form>
        </div>
    </div>
<?php include_once "footer.php";?>