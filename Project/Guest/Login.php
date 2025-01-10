<?php
include('../Assets/Connection/connection.php'); //Login page ഉം  connection page ഉം ആയിട്ട് connect ചെയ്യാൻ ആണ് ഈ code use ചെയുന്നത്
session_start();         //Session use ചെയുന്നത് user signup ചെയുമ്പോൾ id temporary ആയി save ചെയ്യും ആ id consider ചെയ്തു കൊണ്ടാണ് 
                         //user റും password ടും sort ചെയ്‌തു എടുക്കുന്നത്
$invalid="";
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
		if($datauser['user_status']==0){
		header('location:../User/userinfo.php');  //Login ആയി കഴിഞ്ഞാൽ Home page ലേക്ക് പോകാൻ ആണ് ഈ code
		}
		else{
			header('location:../User/Homepage.php');
		}
		
	}

	else if($dataadmin=$resadmin->fetch_assoc())
	{
		$_SESSION['aid']=$dataadmin['admin_id'];  
		header('location:../Admin/HomePage.php');  
		
	}
  else{
    $invalid="Invalid User Name Or Password";
  }
}


?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../Assets/Templates/Login/fonts/icomoon/style.css">

    <link rel="stylesheet" href="../Assets/Templates/Login/css/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../Assets/Templates/Login/css/bootstrap.min.css">
    
    <!-- Style -->
    <link rel="stylesheet" href="../Assets/Templates/Login/css/style.css">

    <title>Login</title>
    <style>
    .form-block {
    max-width: 900px !important;
  }
  .btn-primary {
    color: #fff;
    background-color: #900613; /* Original color */
    border-color: #726e6b;
    transition: background-color 0.3s ease;
  }
  .btn-primary:hover {
    background-color:#4f4e49; /* Grey color on hover */
    border-color: #6c757d; /* Optional: change border color to match */
  }
  .control input:checked ~ .control__indicator {
    background: #900613;
}
.btn-primary:not(:disabled):not(.disabled).active, .btn-primary:not(:disabled):not(.disabled):active, .show>.btn-primary.dropdown-toggle {
    color: #fff;
    background-color: #605e5e;
    border-color: #605e5e;
}
.control:hover input:not([disabled]):checked ~ .control__indicator, .control input:checked:focus ~ .control__indicator {
    background: #605e5e;
}
  </style>
  </head>
  <body>
  

  <div class="d-md-flex half">
    <div class="bg" style="background-image: url('../Assets/Templates/Login/images/istockphoto-2154964150-612x612-transformed-removebg-preview (1).png');"></div>
    <div class="contents">

      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-12">
            <div class="form-block mx-auto">
              <div class="text-center mb-5">
              <h3>Login to <b>LIFE-LINE</b></h3>
              
              <!-- <p class="mb-4">Lorem ipsum dolor sit amet elit. Sapiente sit aut eos consectetur adipisicing.</p> -->
              </div>
              <span style="color:#d26262;margin-top:50px;">
              <?php
              echo $invalid
              ?>
              </span>
              <form method="post">
                <div class="form-group first">
                  <label for="username">Username</label>
                  <input type="text" required="required" name="txt_email" class="form-control" placeholder="your-email@gmail.com" id="username">
                </div>
                <div class="form-group last mb-3">
                  <label for="password">Password</label>
                  <input type="password" required="required" name="txt_password" class="form-control" placeholder="Your Password" id="password">
                </div>
                
                <div class="d-sm-flex mb-5 align-items-center">
                  <label class="control control--checkbox mb-3 mb-sm-0"><span class="caption">Remember me</span>
                    <input type="checkbox" checked="checked"/>
                    <div class="control__indicator"></div>
                  </label>
                  <span class="ml-auto"><a href="ForgetPassword.php" class="forgot-pass">Forgot Password</a></span> 
                </div>

                <input type="submit" value="Log In" name="btn_login" class="btn btn-block btn-primary">

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    
  </div>
    
    

    <script src="../Assets/Templates/Login/js/jquery-3.3.1.min.js"></script>
    <script src="../Assets/Templates/Login/js/popper.min.js"></script>
    <script src="../Assets/Templates/Login/js/bootstrap.min.js"></script>
    <script src="../Assets/Templates/Login/js/main.js"></script>
  </body>
</html>