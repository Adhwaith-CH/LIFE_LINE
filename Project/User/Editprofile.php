<?php
include('../Assets/Connection/connection.php');
session_start();
ob_start();
include("Head.php");
$editprofile="select * from tbl_user where user_id='". $_SESSION['uid']."'";
$resprofile=$Conn->query($editprofile);
$datauser=$resprofile->fetch_assoc();  

if(isset($_POST["btn_update"])) {
    $name = $_POST["txt_editname"];
    $email = $_POST["txt_editemail"];
    $contact = $_POST["txt_editcontact"];
    $address = $_POST["txt_editaddress"];

    $updQry = "UPDATE tbl_user SET user_name = '".$name."', user_email = '".$email."', user_contact = '".$contact."', user_address = '".$address."' WHERE user_id = '".$_SESSION['uid']."'";
    
    if($Conn->query($updQry)) {
        echo "<script>
            alert('Profile updated successfully');
            window.location = 'Myprofile.php';
        </script>";
    } else {
        echo "Update failed";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
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
            position: relative;
            overflow: hidden;
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
.btn-primary {
    background-color: #900613;
    border: none;
    padding: 12px 20px;
    border-radius: 25px;
    transition: background-color 0.3s;
   
}
.card {
    background-color: #ffffff;
    border-radius: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 20px;
    margin-top: -34px;
    position: relative;
    overflow: hidden;
    width: 40cm;
    margin-left: -317px;
}
.btn-primary {
    background-color: #900613;
    border: none;
    padding: 12px 20px;
    border-radius: 25px;
    transition: background-color 0.3s;
   
    margin-bottom: 11px;
}
.card {
    background-color: #ffffff;
    border-radius: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 20px;
    margin-top: -34px;
    position: relative;
    overflow: hidden;
    width: 40cm;
    margin-left: -317px;
    height: 17cm;
}
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card p-4">
                <h3 class="card-title text-center">Edit Profile</h3>
                <form method="post" action="">
                    <div class="mb-3">
                        <label for="txt_editname" class="form-label">Name</label>
                        <input type="text" class="form-control" name="txt_editname" id="txt_editname" value="<?php echo $datauser['user_name'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="txt_editemail" class="form-label">Email</label>
                        <input type="email" class="form-control" name="txt_editemail" id="txt_editemail" value="<?php echo $datauser['user_email'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="txt_editcontact" class="form-label">Contact</label>
                        <input type="text" class="form-control" name="txt_editcontact" id="txt_editcontact" value="<?php echo $datauser['user_contact'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="txt_editaddress" class="form-label">Address</label>
                        <input type="text" class="form-control" name="txt_editaddress" id="txt_editaddress" value="<?php echo $datauser['user_address'] ?>" required>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary" name="btn_update" id="btn_update">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
