<?php
include("../Assets/Connection/connection.php");
session_start();

if(isset($_POST['btn_submit'])){
    if($_SESSION['otp']==$_POST['txt_otp']){
        
       ?>
       <script>
        alert('OTP Validated')
        window.location="ResetPassword.php"
        </script>
       <?php
    }
    else{
        ?>
        <script>
            alert('OTP Incorrect')
            </script>
        <?php
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validate OTP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .container {
            background: #fff;
            border-radius: 5px;
            padding: 20px;
            max-width: 400px;
            margin: auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .message {
            text-align: center;
            margin-top: 15px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Enter Your OTP</h1>
        <form id="" method="POST" action="">
            <div class="form-group">
                <label for="otp">OTP Code:</label>
                <input type="text" id="otp" name="txt_otp" required>
            </div>
            <button type="submit" name="btn_submit">Validate OTP</button>
        </form>
        <div class="message" id="message"></div>
    </div>
</body>
</html>