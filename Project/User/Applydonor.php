<?php
include('../Assets/Connection/connection.php');
session_start();
ob_start();
include("Head.php");

if(isset($_POST["btn_submit"]))
{
	$height=$_POST["txt_height"];
	$weight=$_POST["txt_weight"];
	$bloodgroup=$_POST["txt_bloodgroup"];
	
  $inQry="insert into tbl_userinfo(user_height,user_weight,user_bloodgroup,user_id)values('".$height."','".$weight."','".$bloodgroup."' ,'". $_SESSION['uid']."')";
  if($Conn->query($inQry))
	{
		echo"INSERTED";
	}
	else {
		echo"FAILURE";
	}
}
	




?>













<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card p-4">
                <h3 class="card-title mb-4 text-center">Health Details</h3>
                <form id="form1" name="form1" method="post" action="">
                    <div class="mb-3">
                        <label for="txt_height" class="form-label">Height</label>
                        <input type="text" class="form-control" name="txt_height" id="txt_height" placeholder="Enter height">
                    </div>
                    <div class="mb-3">
                        <label for="txt_weight" class="form-label">Weight</label>
                        <input type="text" class="form-control" name="txt_weight" id="txt_weight" placeholder="Enter weight">
                    </div>
                    <div class="mb-3">
                        <label for="txt_bloodgroup" class="form-label">Blood Group</label>
                        <input type="text" class="form-control" name="txt_bloodgroup" id="txt_bloodgroup" placeholder="Enter blood group">
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
