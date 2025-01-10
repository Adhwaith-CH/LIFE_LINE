<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
if(isset($_POST["btn_submit"])){
$num1=$_POST["txt_num1"];
$num2=$_POST["txt_num2"];
$num3=$_POST["txt_num3"];
	if($num1>$num2){
		$result=$num2;
		if($num1>$num3){
		 $result=$num1;
		}else{
		$result=$num3;
		}
	}else{
		if($num2>$num3){
			$result=$num2;
		}else{
		$result=$num3;
		}
	}

	
}
?>
<form id="form1" name="form" method="post" action="">
  <table width="200" border="1">
    <tr>
      <td>Number1</td>
      <td><label for="txt_num1"></label>
      <input type="text" name="txt_num1" id="txt_num1" /></td>
    </tr>
    <tr>
      <td>Number2</td>
      <td><label for="txt_num2"></label>
      <input type="text" name="txt_num2" id="txt_num2" /></td>
    </tr>
    <tr>
      <td>Number3</td>
      <td><label for="txt_num3"></label>
      <input type="text" name="txt_num3" id="txt_num3" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="btn_submit" id="btn_submit" value="Submit" /></td>
    </tr>
    <tr>
      <td>Result</td>
      <td><?php echo $result ?> </td>
    </tr>
  </table>
</form>
</body>
</html>
