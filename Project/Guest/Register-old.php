<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>


<?php
include("../Assets/Connection/connection.php");
if(isset($_POST["btn_signup"]))
{
	$Inname=$_POST["txt_name"];
	$Inaddress=$_POST["txt_address"];
	$Incontact=$_POST["txt_contact"];
	$Inemail=$_POST["txt_email"];
	$Indistrict=$_POST["sel_district"];
	$Inplace=$_POST["sel_place"];
	$Ingender=$_POST["radio"];
	$Inpassword=$_POST["txt_password"];
	$Inconpassword=$_POST["txt_confirmpassword"];
	$Indateofbirth=$_POST["txt_date"];
	
	$Photo=$_FILES['filephoto']['name'];     //ഇവിടെ store ചെയുന്നത് photo ൻെറ  name ഉം                   //Photo upload ചെയ്യാൻ use ചെയുന്ന code//
	$temp=$_FILES['filephoto']['tmp_name'];  //ഇവിടെ store ചെയുന്നത് photo ൻെറ  path ഉം ആണ്
	
	move_uploaded_file($temp,'../Assets/Files/UserDocs/'.$Photo);
	
	$userSelQry="select * from tbl_user where user_email='".$Inemail."'";
	$resuser=$Conn->query($userSelQry);

  $adminSelQry="select * from tbl_admin where admin_email='".$Inemail."'";
	$resadmin=$Conn->query($adminSelQry);
	if($resadmin->num_rows>0 || $resuser->num_rows>0){
	if($Inpassword==$Inconpassword)
	{
	
	$inqry="insert into tbl_user(user_name,user_address,user_email,place_id,gender,user_password,user_contact,user_dob,user_photo)
	values('".$Inname."','".$Inaddress."','".$Inemail."','".$Inplace."','".$Ingender."','".$Inpassword."','".$Incontact."','".$Indateofbirth."','".$Photo."')";
	if($Conn->query($inqry))
	{
		?>
		<script>
   alert('REGISTERATION SUCESSFULL')
   window.location="Register.php"
   </script>	
   <?php
	}
	else {
		?>
		<script>
   alert('REGISTERATION FAILED')
   window.location="Register.php"
   </script>	
   <?php
   }
	}
	else{
		?>
		<script>
   alert('MISS MATCH PASSWORD ')
   window.location="Register.php"
   </script>
   <?php
	}
}
else{
  ?>
  <script>
  alert("Email Already Exists")
  </script>
  <?php
}
}

?>


















<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <table width="467" height="534" border="1">
    <tr>
      <td width="162" align="center">Name</td>
      <td width="289"><label for="txt_name"></label>
      <input name="txt_name" required="required" type="text" id="txt_name" placeholder = "Enter Your Name" /></td>
    </tr>
    <tr>
      <td align="center">Address</td>
      <td><label for="txt_email"></label>
      <input name="txt_address" required="required" type="text" id="txt_address" placeholder="Enter Your Address" /></td>
    </tr>
    <tr>
      <td align="center">Contact</td>
      <td><label for="txt_contact"></label>
      <input name="txt_contact" required="required" type="text" id="txt_contact" placeholder="Enter Your Contact Number" size="30px" /></td>
    </tr>
    <tr>
      <td align="center">Email</td>
      <td><label for="txt_address"></label>
      <input name="txt_email" required="required" type="email" id="txt_email" placeholder="Enter Your Email" /></td>
    </tr>
    <tr>
      <td align="center">District</td>
      <td><label for="sel_district"></label>
        <select name="sel_district" id="sel_district" onchange="getPlace(this.value)" required>  
        
        
        
          <option value="">Select District</option>
           <?php                           
		                                                           /*മുൻപ് district insert ചെയ്താ table ൽ നിന്നു എല്ലാ values 
														           registeration page ലേക്ക് കൊണ്ട് വരാൻ ഉള്ള code*/
		$selqry="select *from tbl_district";            
		$result=$Conn->query($selqry); 
		while($data=$result->fetch_assoc()){
			?>
            <option value="<?php echo  $data['district_id'] ?>"><?php
			echo $data['district_name']?></option>
            <?php
		}
		?>
        
        
      </select></td>
    </tr>
    <tr>
      <td align="center">Place</td>
      <td><select name="sel_place" id="sel_place" required>
      
                                                                     <!--/*മുൻപ് place insert ചെയ്താ table ൽ നിന്നു എല്ലാ values 
														           registeration page ലേക്ക് കൊണ്ട് വരാൻ ഉള്ള code -->
        <option value=""> Select Place</option>
       
        
      </select></td>
    </tr>
    <tr>
      <td align="center">Photo</td>
      <td><input type="file" required="required" accept="image/jpeg," name="filephoto" id="filephoto" value="Choose File" /></td>
    </tr>
    <tr>
      <td align="center">Gender</td>
      <td><input type="radio" required="required" name="radio" id="rbtn_male" value="male" />
      <label for="rbtn_male">Male
        <input type="radio" name="radio" id="rbtn_female" value="female" />
      Female</label></td>
    </tr>
    <tr>
      <td align="center">Date of Birth</td>
      <td><label for="txt_date"></label>
      <input type="date" required="required" name="txt_date" id="txt_date" /></td>
    </tr>
    <tr>
      <td align="center">Password</td>
      <td><label for="txt_password"></label>
      <input name="txt_password" required="required" type="password" id="txt_password" placeholder="Enter Your Password" /></td>
    </tr>
    <tr>
      <td align="center">Confirm Password</td>
      <td><label for="txt_confirmpassword"></label>
      <input name="txt_confirmpassword" required="required" type="password" id="txt_confirmpassword" placeholder="Confirm Your Password"  /></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="btn_signup" id="btn_signup" value="sign up" /></td>
    </tr>
  </table>
</form>

</body>
 <script src="../Assets/JQ/jQuery.js"></script>
<script>
  function getPlace(did) {
    $.ajax({
      url: "../Assets/AjaxPages/AjaxPlace.php?did=" + did,
      success: function (result) {

        $("#sel_place").html(result);
      }
    });
  }
  
  document.addEventListener('DOMContentLoaded', function() {
            const today = new Date();
            const maxDate = new Date(today.getFullYear() - 18, today.getMonth(), today.getDate());
            const maxDateString = maxDate.toISOString().split('T')[0];
            
            document.getElementById('txt_date').setAttribute('max', maxDateString);
        });

</script>

</html>
