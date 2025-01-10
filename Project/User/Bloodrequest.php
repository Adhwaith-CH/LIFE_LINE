<?php
include("../Assets/Connection/connection.php");
session_start();
ob_start();
include("Head.php");

if (isset($_POST["btn_submit"])) {
    $bloodgroup = $_POST["sel_bloodgroup"];
    $type = $_POST["sel_type"];
    $district = $_POST["sel_district"];
    $place = $_POST["sel_place"];
    $requireddate = $_POST["txt_requireddate"];
    $quantity = $_POST["txt_quantity"];
    
    $inQry = "insert into tbl_request(bloodgroup_id, type_id, place_id, request_requireddate, request_quantity, user_id, request_requestdate) values ('" . $bloodgroup . "','" . $type . "','" . $place . "','" . $requireddate . "','" . $quantity . "','" . $_SESSION['uid'] . "', curdate())";
    
    if ($Conn->query($inQry)) {
        echo '<script>alert("Request Sent Successfully"); window.location="MyRequest.php";</script>';
    } else {
        echo '<script>alert("Request Failed");</script>';
    }
}

$myprofile = "select * from tbl_user where user_id ='" . $_SESSION['uid'] . "'";
$resprofile = $Conn->query($myprofile);
$datauser = $resprofile->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Donation Request</title>
    <link rel="stylesheet" href="../Assets/CSS/bootstrap.min.css">
    <script src="../Assets/JQ/jQuery.js"></script>
    <script src="../Assets/JS/bootstrap.bundle.min.js"></script>
    <style>
        .btn-primary {
            color: #fff;
            background-color: #d26262;
            border-color: #007bff;
        }

        .image-box {
            max-width: 100%;
            height: auto;
        }

        .img-left {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .form-container {
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        @media (max-width: 768px) {
            .row {
                flex-direction: column;
            }

            .img-left {
                order: 2;
                margin-top: 20px;
            }

            .form-container {
                order: 1;
            }
        }
        .img-left {
    display: flex;
    align-items: normal;
    justify-content: center;
    padding-left: 32px;
    margin-left: -119px;
    margin-bottom: -7cm;
    width: 125cm;
    height: 13cm;
}
element.style {
    background: #900613;
}
.btn-primary {
    color: #fff;
    background-color: #900613;
    border-color: #900613;
}
.header_section {
    background-color: #605e5e !important;
}
.form-container {
    padding: 20px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 39cm;
    margin-left: -4cm;
}
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-12"> <!-- Change col-md-6 to col-12 for full width -->
            <div class="form-container">
                <h3 class="card-title mb-4 text-center">Blood Donation Request</h3>
                <form id="form1" name="form1" method="post" action="">
                    <div class="mb-3">
                        <label for="attendeeName" class="form-label">Attendee Name</label>
                        <input type="text" class="form-control" id="attendeeName" value="<?php echo htmlspecialchars($datauser['user_name']); ?>" disabled>
                    </div>
                    <div class="mb-3" id="bloodgroupContainer">
                        <label for="sel_bloodgroup" class="form-label">Blood Group</label><br>
                        <select name="sel_bloodgroup" id="sel_bloodgroup" class="form-select" style="width: 100%;" required>
                            <option value="">Select blood group</option>
                            <?php
                            $selqry = "SELECT * FROM tbl_bloodgroup";
                            $result = $Conn->query($selqry);
                            while ($data = $result->fetch_assoc()) {
                                ?>
                                <option value="<?php echo htmlspecialchars($data['blood_id']); ?>"><?php echo htmlspecialchars($data['blood_group']); ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="sel_type" class="form-label">Type</label><br>
                        <select name="sel_type" id="sel_type" class="form-select" style="width: 100%;" required>
                            <option value="">Select Type</option>
                            <?php
                            $selqry = "SELECT * FROM tbl_type";
                            $result = $Conn->query($selqry);
                            while ($data = $result->fetch_assoc()) {
                                ?>
                                <option value="<?php echo htmlspecialchars($data['type_id']); ?>"><?php echo htmlspecialchars($data['type_name']); ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="sel_district" class="form-label">District</label><br>
                        <select name="sel_district" id="sel_district" class="form-select" onChange="getPlace(this.value)" style="width: 100%;" required>
                            <option value="">Select District</option>
                            <?php
                            $selqry = "SELECT * FROM tbl_district";
                            $result = $Conn->query($selqry);
                            while ($data = $result->fetch_assoc()) {
                                ?>
                                <option value="<?php echo htmlspecialchars($data['district_id']); ?>"><?php echo htmlspecialchars($data['district_name']); ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="sel_place" class="form-label">Place</label><br>
                        <select name="sel_place" id="sel_place" class="form-select" style="width: 100%;" required>
                            <option value="">Select Place</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="txt_requireddate" class="form-label">Required Date</label>
                        <input type="date" class="form-control" name="txt_requireddate" id="txt_requireddate" style="width: 100%;" required min="<?php echo date('Y-m-d'); ?>" />
                    </div>
                    <div class="mb-3">
                        <label for="txt_quantity" class="form-label">Number of Persons</label>
                        <input type="number" class="form-control" name="txt_quantity" id="txt_quantity" style="width: 100%;" required />
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" name="btn_submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    function getPlace(did) {
        $.ajax({
            url: "../Assets/AjaxPages/AjaxPlace.php?did=" + did,
            success: function (result) {
                $("#sel_place").html(result);
            }
        });
    }

    // Disable or enable blood group based on the selected type
    document.getElementById('sel_type').addEventListener('change', function() {
        var bloodgroupContainer = document.getElementById('bloodgroupContainer');
        var bloodgroupSelect = document.getElementById('sel_bloodgroup');
        var selectedType = this.value;

        // Define the ID of the Platelets type
        var plateletsTypeId = 'plateletsTypeId'; // Replace with the actual ID for Platelets

        if (selectedType === plateletsTypeId) {
            bloodgroupContainer.style.display = 'none';
            bloodgroupSelect.value = ''; // Clear the selected value if Platelets is selected
        } else {
            bloodgroupContainer.style.display = 'block';
        }
    });
</script>
</body>
</html>
