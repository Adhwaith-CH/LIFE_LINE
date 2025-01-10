<?php
include('../Assets/Connection/connection.php'); //Login page ഉം  connection page ഉം ആയിട്ട് connect ചെയ്യാൻ ആണ് ഈ code use ചെയുന്നത്
session_start();         //Session use ചെയുന്നത് user signup ചെയുമ്പോൾ id temporary ആയി save ചെയ്യും ആ id consider ചെയ്തു കൊണ്ടാണ് 
                         //user റും password ടും sort ചെയ്‌തു എടുക്കുന്നത്
if(isset($_POST['btn_login']))
{
	$email=$_POST['txt_email'];
	$password=$_POST['txt_password'];
	$userSelQry="select * from tbl_user where user_email='".$email."' and user_password='".$password."'";
	$resuser=$Conn->query($userSelQry);
  $adminSelQry="select * from tbl_admin where admin_email='".$email."' and admin_password='".$password."'";
	$resadmin=$Conn->query($adminSelQry);
	
	if($datauser=$resuser->fetch_assoc())
	{
		$_SESSION['uid']=$datauser['user_id'];  //User ന്റെ id temporary ആയി store ചെയ്യാൻ ആണ് ഈ code
		header('location:../User/HomePage.php');  //Login ആയി കഴിഞ്ഞാൽ Home page ലേക്ക് പോകാൻ ആണ് ഈ code
		
	}

	else if($dataadmin=$resadmin->fetch_assoc())
	{
		$_SESSION['aid']=$dataadmin['admin_id'];  
		header('location:../Admin/HomePage.php');  
		
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
<form id="form1" name="form1" method="post" action=""><table width="429" height="231" border="1">
  <tr>
    <td width="127" align="center">Email</td>
    <td width="286"><label for="txt_email"></label>
      <input type="text" required="required" name="txt_email" id="txt_email" /></td>
  </tr>
  <tr>
    <td align="center">Password</td>
    <td><label for="txt_password"></label>
      <input type="text"  required="required" name="txt_password" id="txt_password" /></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input type="submit" name="btn_login" id="btn_login" value="Login" /></td>
    </tr>
</table>

</form>
</body>
</html>
