<?php
include('../Assets/Connection/connection.php');
session_start();
ob_start();
include("Head.php");

if(isset($_POST["btn_changepassword"])) {
    $oldpassword = $_POST["txt_oldpassword"];
    $newpassword = $_POST["txt_newpassword"];
    $retypepassword = $_POST["txt_retypepassword"];

    $selOneUser = "SELECT * FROM tbl_user WHERE user_id='".$_SESSION['uid']."'";
    $resprofile = $Conn->query($selOneUser);
    $resOldpas = $resprofile->fetch_assoc();
    $oldDbPassword = $resOldpas['user_password'];

    if($oldpassword == $oldDbPassword) {
        if($newpassword == $retypepassword) {
            $updQry = "UPDATE tbl_user SET user_password = '".$newpassword."' WHERE user_id='".$_SESSION['uid']."'";
            if($Conn->query($updQry)) {
                echo "<script>
                    alert('Password updated successfully');
                    window.location = 'Myprofile.php';
                </script>";
            } else {
                echo "Update failed";
            }
        } else {
            echo "New password and Re-typed password do not match";
        }
    } else {
        echo "Incorrect current password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../Assets/Templates/Main/css/style.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            background-color: #ffffff;
            border-radius: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 50px;
        }
        .card-title {
            color: #900613;
            font-size: 2rem;
            font-weight: 600;
        }
        .form-label {
            color: #584f4f;
            font-weight: 500;
        }
        .btn-primary {
            background-color: #900613;
            border: none;
            padding: 10px 20px;
            border-radius: 25px;
            transition: background-color 0.3s;
        }
        .btn-primary:hover {
            background-color: #b23b3b;
        }
		.header_section {
    background-color: #605e5e !important;
}
.card-title {
    color: #605e5e;
    font-size: 2rem;
    font-weight: 600;
}
.card {
    background-color: #ffffff;
    border-radius: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 20px;
    margin-top: -32px;
    width: 40cm;
    margin-left: -11cm;
    height: 17cm;
}
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card p-4">
                <h3 class="card-title text-center">Change Password</h3>
                <form method="post" action="">
                    <div class="mb-3">
                        <label for="txt_oldpassword" class="form-label">Old Password</label>
                        <input type="password" class="form-control" name="txt_oldpassword" id="txt_oldpassword" placeholder="Enter Old Password" required>
                    </div>
                    <div class="mb-3">
                        <label for="txt_newpassword" class="form-label">New Password</label>
                        <input type="password" class="form-control" name="txt_newpassword" id="txt_newpassword" placeholder="Enter New Password" required>
                    </div>
                    <div class="mb-3">
                        <label for="txt_retypepassword" class="form-label">Re-type Password</label>
                        <input type="password" class="form-control" name="txt_retypepassword" id="txt_retypepassword" placeholder="Re-type New Password" required>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary" name="btn_changepassword" id="btn_changepassword">Change Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
