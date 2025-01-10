<?php
ob_start();
include('Head.php');
?>
<?php
include("../Assets/Connection/connection.php");
if(isset($_POST['btn_submit'])){
  $qry="UPDATE tbl_complaint SET complaint_reply='".$_POST['txt_reply']."' WHERE complaint_id=".$_GET['cid'];
  if ($Conn->query($qry)) {
    ?>
    <script>
    alert('Reply Send Sucessfully')
    window.location="Complaint.php"
    </script>
    <?php
  } else {
    echo "Failure";
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
<form id="form1" name="form1" method="post" action="">
  <table width="452" height="211" border="1">
    <tr>
      <td width="95" height="144" align="center">Reply</td>
      <td width="341" align="center" valign="middle"><label for="txt_reply"></label>
      <textarea name="txt_reply" id="txt_reply" cols="45" rows="5"></textarea></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="btn_submit" id="btn_submit" value="Submit" /></td>
    </tr>
  </table>
</form>
</body>
</html>
<?php
include('Foot.php');
ob_flush();
?>