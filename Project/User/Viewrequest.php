<?php
include("../Assets/Connection/connection.php");
session_start();
ob_start();
include("Head.php");

$curDate = Date('Y-m-d');

// Fetch the logged-in user's district
$userDistrictQuery = "SELECT p.district_id 
                      FROM tbl_user u
                      INNER JOIN tbl_place p ON u.place_id = p.place_id 
                      WHERE u.user_id = '" . $_SESSION['uid'] . "'";
$userDistrictResult = $Conn->query($userDistrictQuery);

if ($userDistrictResult->num_rows > 0) {
    $userDistrict = $userDistrictResult->fetch_assoc()['district_id'];

    // Updated query to fetch requests for the same district
    $viewrequest = "SELECT * FROM tbl_request r 
                    INNER JOIN tbl_bloodgroup b ON r.bloodgroup_id = b.blood_id 
                    INNER JOIN tbl_type t ON t.type_id = r.type_id 
                    INNER JOIN tbl_place p ON p.place_id = r.place_id 
                    INNER JOIN tbl_district d ON d.district_id = p.district_id 
                    INNER JOIN tbl_user u ON u.user_id = r.user_id 
                    WHERE r.user_id != '" . $_SESSION['uid'] . "' 
                    AND d.district_id = '$userDistrict' 
                    AND request_status = 0 
                    AND request_requireddate >= '$curDate' 
                    ORDER BY request_requireddate ASC";
    $resprofile = $Conn->query($viewrequest);
} else {
    echo '<div class="msg">Unable to fetch your district information.</div>';
}

if (isset($_GET['request_id'])) {
    $sendrequest = "INSERT INTO tbl_donorrequest (request_id, donorrequest_date, user_id) 
                    VALUES ('" . $_GET['request_id'] . "', CURDATE(), '" . $_SESSION['uid'] . "')";
    if ($Conn->query($sendrequest)) {
        echo '<script>alert("Request Sent Successfully"); window.location = "viewrequest.php";</script>';
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
    <title>View Requests</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        .msg {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 300px;
            color: #605e5e;
            font-family: 'Courier New', Courier, monospace;
            font-size: 30px;
        }

        .header_section {
    background-color: #605e5e !important;
}
        .card-title {
            color: #605e5e;
            font-weight: bold;
        }
        .table th {
            background-color: #605e5e;
            color: white;
        }
        .btn-primary {
            background-color: #2bac99;
            border-color: #2bac99;
        }
        .btn-primary:hover {
            background-color: #31b0d5;
            border-color: #31b0d5;
        }
    </style>
</head>
<body>
<?php
if ($userDistrictResult->num_rows > 0 && isset($resprofile) && $resprofile->num_rows > 0) {
    ?>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card p-4">
                    <h3 class="card-title mb-4 text-center">View Requests</h3>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">SL. NO</th>
                                    <th scope="col">Attendee Name</th>
                                    <th scope="col">Blood Group</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">District</th>
                                    <th scope="col">Place</th>
                                    <th scope="col">Required Date</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 0;
                                while ($datauser = $resprofile->fetch_assoc()) {
                                    $i++;
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo htmlspecialchars($datauser['user_name']); ?></td>
                                        <td><?php echo htmlspecialchars($datauser['blood_group']); ?></td>
                                        <td><?php echo htmlspecialchars($datauser['type_name']); ?></td>
                                        <td><?php echo htmlspecialchars($datauser['district_name']); ?></td>
                                        <td><?php echo htmlspecialchars($datauser['place_name']); ?></td>
                                        <td><?php echo htmlspecialchars($datauser['request_requireddate']); ?></td>
                                        <td><?php echo htmlspecialchars($datauser['request_quantity']); ?></td>
                                        <td>
                                            <?php
                                            $selQry = "SELECT * FROM tbl_donorrequest 
                                                       WHERE user_id='" . $_SESSION['uid'] . "' 
                                                       AND request_id=" . $datauser['request_id'];
                                            $resQry = $Conn->query($selQry);
                                            if ($resQry->num_rows > 0) {
                                                $resData = $resQry->fetch_assoc();
                                                if ($resData['drequest_status'] == 0) {
                                                    echo "Request Sent";
                                                } elseif ($resData['drequest_status'] == 1) {
                                                    echo "Request Accepted";
                                                } elseif ($resData['drequest_status'] == 2) {
                                                    echo "Request Rejected";
                                                }
                                            }
                                            ?>
                                        </td>
                                        <td class="text-center">
                                            <?php
                                            if ($resQry->num_rows <= 0) {
                                                ?>
                                                <a href="viewrequest.php?request_id=<?php echo $datauser['request_id']; ?>" class="btn btn-primary btn-sm">
                                                    Send Request
                                                </a>
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
                </div>
            </div>
        </div>
    </div>
    <?php
} else {
    ?>
    <div class="msg">No requests available for your district.</div>
    <?php
}
?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>