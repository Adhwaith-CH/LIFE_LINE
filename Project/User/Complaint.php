<?php
include('../Assets/Connection/connection.php');
session_start();
ob_start();
include("Head.php");

if(isset($_POST["btn_submit"]))
{
    $title = $_POST["txt_title"];
    $content = $_POST["txt_content"];
    
    $inQry = "INSERT INTO tbl_complaint(complaint_title, complaint_description, complaint_date, user_id)
              VALUES ('$title', '$content', CURDATE(), '" . $_SESSION['uid'] . "')";
    if($Conn->query($inQry)) {
        echo "<div class='alert alert-success text-center'>Complaint submitted successfully!</div>";
    } else {
        echo "<div class='alert alert-danger text-center'>Error: " . $Conn->error . "</div>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Complaint</title>
    <!-- Bootstrap CSS -->
    <!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> -->
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <!-- Custom Styles -->
    <link href="Assets/Templates/Main/css/style.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .containers {
            margin-top: 50px;
        }
        .card {
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
        }
        .full-width-card {
            width: 100%;
            max-width: none;
            margin: 0;
            padding: 40px;
        }
        .card-title {
            color: #d26262;
            font-weight: 700;
            font-size: 28px;
            text-align: center;
        }
        .form-control {
            border-radius: 5px;
            font-size: 16px;
            padding: 10px;
        }
        .btn-primary {
            background-color: #d26262;
            border-color: #d26262;
            font-size: 18px;
            padding: 10px 20px;
        }
        .btn-primary:hover {
            background-color: #a64545;
            border-color: #a64545;
        }
        .alert {
            margin-top: 20px;
        }
        .full-width-card {
    width: 39cm;
    max-width: none;
    margin: 0;
    padding: 37px;
    height: 15cm;
    margin-left: -115px;
    margin-top: 10px;
    margin-bottom: 10px;
}
.card-title {
    color: #900613;
    font-weight: 700;
    font-size: 28px;
    text-align: center;
}
.btn-primary {
    background-color: #900613;
    border-color: #900613;
    font-size: 18px;
    padding: 10px 20px;
}
.header_section {
    background-color: #605e5e !important;
}
.card-title {
    color: #605e5e;
    font-weight: 700;
    font-size: 28px;
    text-align: center;
}
.footer_section {
    background: #605e5e !important;
}
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card full-width-card">
                <h3 class="card-title">Submit Your Complaint</h3>
                <form method="post">
                    <div class="form-group mb-3">
                        <label for="txt_title">Title:</label>
                        <input type="text" class="form-control" id="txt_title" name="txt_title" placeholder="Enter title here" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="txt_content">Content:</label>
                        <textarea id="txt_content" name="txt_content" class="form-control" rows="5" placeholder="Enter content here" required></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="txt_content">email:</label>
                        <textarea id="txt_content" name="txt_content" class="form-control" rows="5" placeholder="Enter  <div class="form-group mb-3">
                       
    
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" name="btn_submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
</body>
</html>

<?php
include('Foot.php');
ob_flush();
?>
