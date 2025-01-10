<?php
include("../Assets/Connection/connection.php");
session_start(); 
if(isset($_POST["btn_submit"]))
{
    $height=$_POST["txt_height"];
    $weight=$_POST["txt_weight"];
    $bloodgroup=$_POST["txt_bloodgroup"];

    $upqry="update tbl_user set user_height='".$height."',user_weight='".$weight."' ,blood_id='".$bloodgroup."', user_status=1 where user_id=".$_SESSION['uid'];
    if($Conn->query($upqry))
    {
        ?>
        <script>
        alert('SUBMISSION SUCCESSFUL');
        window.location="HomePage.php";
        </script>    
        <?php
    }
    else {
        ?>
        <script>
        alert('REGISTRATION FAILED');
        window.location="userinfo.php";
        </script>
        <?php
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
    <link rel="stylesheet" href="../Assets/Templates/Login/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Assets/Templates/Login/css/style.css">

    <title>FILL YOUR DETAILS</title>
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
                            <h3>FILL YOUR DETAILS</h3>
                        </div>
                        <form method="post">
                            <div class="form-group">
                                <label for="txt_height">Height (cm)</label>
                                <input type="number" name="txt_height" id="txt_height" class="form-control" placeholder="Enter your height in cm" min="1" max="300" required>
                            </div>
                            <div class="form-group">
                                <label for="txt_weight">Weight (kg)</label>
                                <input type="number" name="txt_weight" id="txt_weight" class="form-control" placeholder="Enter your weight in kg" min="1" max="300" required>
                            </div>
                            <div class="form-group">
                                <label for="txt_bloodgroup">Blood Group</label>
                                <select name="txt_bloodgroup" id="txt_bloodgroup" class="form-control" required>
                                    <option value="">Select Blood Type</option>
                                    <?php
                                    $selqry="select * from tbl_bloodgroup order by(blood_group)";            
                                    $result=$Conn->query($selqry); 
                                    while($data=$result->fetch_assoc()){
                                        ?>
                                        <option value="<?php echo  $data['blood_id'] ?>"><?php echo $data['blood_group']?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="text-center">
                                <input type="submit" name="btn_submit" id="btn_submit" value="Submit" class="btn btn-block btn-primary">
                            </div>
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
