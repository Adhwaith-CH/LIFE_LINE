<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php 
$fn="";
$ln="";
$name="";
$gender="";
$dep="";
$marital="";
$ta="";
$da="";
$hra="";
$lic="";
$pf="";
$ded="";
$net="";
$bs="";



if(isset($_POST["btn_submit"]))
{
$fn=$_POST["txt_fname"];
$ln=$_POST["txt_lname"];
$name = $fn.''.$ln;
$gender=$_POST["rad_gender"];
$marital=$_POST["rad_mar"];
$dep = $_POST['ckbox_dep'];
$bs =$_POST["txt_basicsalary"];




if($gender=="Male")
{
	$name="Mr.".$fn.' '.$ln;
}
else
{
	$name="Mrs.".$fn.' '.$ln;
}

if($bs>=10000)
{
	$ta=$bs*(0.4);
	$da=$bs*(0.35);
	$hra=$bs*(0.3);
	$lic=$bs*(0.25);
	$pf=$bs*(0.2);
}
else if($bs>=5000&&$bs<10000)
{
	
    $ta=$bs*(0.35);
	$da=$bs*(0.3);
	$hra=$bs*(0.25);
	$lic=$bs*(0.2);
	$pf=$bs*(0.15);
}
else if($bs<5000)
{
	$ta=$bs*(0.3);
	$da=$bs*(0.25);
	$hra=$bs*(0.20);
	$lic=$bs*(0.15);
	$pf=$bs*(0.10);
}

$ded= $lic+$pf;
$net=($bs+$ta+$da+$hra)-($ded);
	
}

?>
<form id="form1" name="form1" method="post" action="">
  <table width="633" border="1">
    <tr>
      <td width="245">Firstname</td>
      <td width="372"><label for="txt_fname"></label>
      <input type="text" name="txt_fname" id="txt_fname" /></td>
    </tr>
    <tr>
      <td>Lastname</td>
      <td><label for="txt_lname"></label>
      <input type="text" name="txt_lname" id="txt_lname" /></td>
    </tr>
    <tr>
      <td>Gender</td>
      <td><input type="radio" name="rad_gender" id="gender" value="Male" />
        Male 
          <input type="radio" name="rad_gender" id="gender" value="Female" />
        <label for="btn_female">Female</label></td>
    </tr>
    <tr>
      <td>Martial</td>
      <td><input type="radio" name="rad_mar" id="btn_single" value="single" />
        Single 
          <input type="radio" name="rad_mar" id="btn_married" value="married" />
        <label for="btn_married">Married</label></td>
    </tr>
    <tr>
      <td height="47">Department</td>
      <td><label for="ckbox_dep"></label>
        <select name="ckbox_dep" size="1" id="ckbox_dep">
          <option>--Select--</option>
          <option value="BCA">BCA</option>
          <option value="B.COM">B.COM</option>
          <option value="BBA">BBA</option>
      </select></td>
    </tr>
    <tr>
      <td height="60">Basic Salary</td>
      <td><label for="txt_basicsalary"></label>
      <input type="text" name="txt_basicsalary" id="txt_basicsalary" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
      <input type="submit" name="btn_cancel" id="btn_cancel" value="Cancel" /></td>
    </tr>
    <tr>
      <td>Name</td>
      <td><?php echo $name ?></td>
    </tr>
    <tr>
      <td>Gender</td>
      <td><?php echo $gender ?></td>
    </tr>
    <tr>
      <td>Martial</td>
      <td><?php echo $marital ?></td>
    </tr>
    <tr>
      <td>Department</td>
      <td><?php echo $dep ?></td>
    </tr>
    <tr>
      <td>Basic Salary</td>
      <td><?php echo $bs ?></td>
    </tr>
    <tr>
      <td>T.A</td>
      <td><?php echo $ta ?></td>
    </tr>
    <tr>
      <td height="29">D.A</td>
      <td><?php echo $da ?></td>
    </tr>
    <tr>
      <td>HRA</td>
      <td><?php echo $hra ?></td>
    </tr>
    <tr>
      <td>LIC</td>
      <td><?php echo $lic ?></td>
    </tr>
    <tr>
      <td>P.F</td>
      <td><?php echo $pf ?></td>
    </tr>
    <tr>
      <td>DEDUCTION</td>
      <td><?php echo $ded ?></td>
    </tr>
    <tr>
      <td>NET</td>
      <td><?php echo $net ?></td>
    </tr>
  </table>
</form>
</body>
</html>
