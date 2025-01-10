<?php
include("../Assets/Connection/connection.php");
session_start();
ob_start();
include("Head.php");

$curDate = Date('Y-m-d');
$acceptrequest = "SELECT * FROM tbl_donorrequest d 
                  INNER JOIN tbl_user u ON u.user_id=d.user_id  
                  INNER JOIN tbl_request r ON r.request_id=d.request_id 
                  INNER JOIN tbl_bloodgroup b ON r.bloodgroup_id=b.blood_id 
                  INNER JOIN tbl_type t ON t.type_id = r.type_id 
                  INNER JOIN tbl_place p ON p.place_id=r.place_id 
                  INNER JOIN tbl_district s ON s.district_id=p.district_id  
                  WHERE d.request_id ='" . $_GET['rid'] . "'";

if (isset($_GET['drid'])) {
    $accept = "UPDATE tbl_donorrequest SET drequest_status = 1 WHERE donorrequest_id ='" . $_GET['drid'] . "'";
    if ($Conn->query($accept)) {
        $selDr = "SELECT count(*) as count FROM tbl_donorrequest WHERE request_id =" . $_GET['rid'] . " AND drequest_status = 1";
        $resDr = $Conn->query($selDr);
        $resCount = $resDr->fetch_assoc();
        $count = $resCount['count'];

        $selqu = "SELECT * FROM tbl_request WHERE request_id =" . $_GET['rid'];
        $resqu = $Conn->query($selqu);
        $dataqu = $resqu->fetch_assoc();
        $qty = $dataqu['request_quantity'];

        if ($count == $qty) {
            $updQry = "UPDATE tbl_request SET request_status=2 WHERE request_id ='" . $_GET['rid'] . "'";
            if ($Conn->query($updQry)) {
                $upddrQry = "UPDATE tbl_donorrequest SET drequest_status=2 WHERE drequest_status=0 AND request_id=" . $_GET['rid'];
                if ($Conn->query($upddrQry)) {
                    ?>
                    <script>
                    alert('Request Accepted');
                    window.location = "donorrequest.php?rid=<?php echo $_GET['rid'] ?>";
                    </script>
                    <?php
                }
            }
        } else {
            ?>
            <script>
            alert('Request Accepted');
            window.location = "donorrequest.php?rid=<?php echo $_GET['rid'] ?>";
            </script>
            <?php
        }
    } else {
        echo "Failure";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donor Requests</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <!-- Custom Styles -->
    <link href="Assets/Templates/Main/css/style.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f8f9fa;
        }
        .main-body {
            width: 100%;
            min-height: 100vh;
            background-color: #ecf0f3;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 20px 0;
        }
        .card-title {
            color: #605e5e; /* Match the theme color */
            font-weight: 700;
        }
        .table {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .table th {
            background-color: #605e5e; /* Match the theme color */
            color: #ffffff;
        }
        .table td {
            background-color: #f9f9f9;
        }
        .btn-primary {
            background-color: #5bc0de;
            border-color: #5bc0de;
        }
        .btn-primary:hover {
            background-color: #31b0d5;
            border-color: #31b0d5;
        }
        /* Remove padding and margin for full width */
        .container {
            max-width: 100%;
            padding: 0;
        }
        .card {
            margin: 0;
        }
        .card {
    margin: 0;
    height: 20cm;
}
.header_section {
    background-color: #605e5e !important;
}
    </style>
</head>
<body>
<div class="container-fluid mt-5"> <!-- Full width container -->
    <div class="row justify-content-center">
        <div class="col-12"> <!-- Full width column -->
            <div class="card p-4"> <!-- Full width card -->
                <h3 class="card-title mb-4 text-center">Blood Donation Requests</h3>
                <form id="form1" name="form1" method="post" action="">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">SL.NO</th>
                                    <th scope="col">Attendee Name</th>
                                    <th scope="col">Blood Group</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">District</th>
                                    <th scope="col">Place</th>
                                    <th scope="col">Required Date</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $resprofile = $Conn->query($acceptrequest);
                                $i = 0;
                                while ($datauser = $resprofile->fetch_assoc()) {
                                    $i++;
                                    ?>
                                    <tr>
                                        <td><?php echo $i ?></td>
                                        <td><?php echo $datauser['user_name'] ?></td>
                                        <td><?php echo $datauser['blood_group'] ?></td>
                                        <td><?php echo $datauser['type_name'] ?></td>
                                        <td><?php echo $datauser['district_name'] ?></td>
                                        <td><?php echo $datauser['place_name'] ?></td>
                                        <td><?php echo date('d-m-Y', strtotime($datauser['request_requireddate'])) ?></td>
                                        <td><?php echo $datauser['request_quantity'] ?></td>
                                        <td class="text-center">
                                            <?php
                                            if ($datauser['drequest_status'] == 0) {
                                                ?>
                                                <a href="donorrequest.php?rid=<?php echo $datauser['request_id'] ?>&drid=<?php echo $datauser['donorrequest_id'] ?>" class="btn btn-primary btn-sm">Accept</a>
                                                <?php
                                            } else if ($datauser['drequest_status'] == 1) {
                                                ?>
                                                <div>
                                                    <p><?php echo $datauser['user_contact']; ?></p>
                                                    <p><?php echo $datauser['user_address']; ?></p>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
