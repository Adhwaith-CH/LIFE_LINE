<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
$num1 = $_POST["txt_num1"];
$num2 = $_POST["txt_num2"];
if(isset($_POST["$num1>$num2"]))
{
	$result = $num1;
}
else
{
	$result = $num2;
}
	
?>
<form id="form" name="form" method="post" action="">
<table width="338" border="1">
  <tr>
    <td width="167">Number1</td>
    <td width="155">
      <label for="txt_num1"></label>
      <input type="text" name="txt_num1" id="txt_num1" />
    </form></td>
  </tr>
  <tr>
    <td>Number2</td>
      <label for="txt_num2"></label>
      <input type="text" name="txt_num2" id="txt_num2" />
    </form></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><form id="form1" name="form1" method="post" action="">
      <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
    </form></td>
  </tr>
  <tr>
    <td>Result</td>
    <td><?php echo $result ?></td>
  </tr> 
</table>
</body>
</html>
