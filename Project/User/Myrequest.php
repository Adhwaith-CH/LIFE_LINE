<?php
include('../Assets/Connection/connection.php');
session_start();
ob_start();
include("Head.php");

$myrequest = "SELECT * FROM tbl_request r 
              INNER JOIN tbl_bloodgroup b ON r.bloodgroup_id = b.blood_id 
              INNER JOIN tbl_type t ON t.type_id = r.type_id 
              WHERE user_id = '" . $_SESSION['uid'] . "' 
              ORDER BY request_id DESC";
$resprofile = $Conn->query($myrequest);

$datauser = $resprofile->fetch_assoc();

if(isset($_GET['request_id'])) {
    $deactivate = "UPDATE tbl_request SET request_status = 1 WHERE request_id = '" . $_GET['request_id'] . "'";
    if($Conn->query($deactivate)) {
?>
        <script>
        alert('Deactivated');
        window.location = "Myrequest.php";
        </script>
<?php
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
    <title>My Requests</title>
    <!-- Bootstrap CSS -->
    <!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> -->
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
            background-color: #d26262; /* Match the theme color */
            color: #ffffff;
        }
        .table td {
            background-color: #f9f9f9;
        }
        .btn-danger {
            background-color: #d9534f;
            border-color: #d9534f;
        }
        .btn-danger:hover {
            background-color: #c9302c;
            border-color: #c9302c;
        }
        .btn-info {
            background-color: #5bc0de;
            border-color: #5bc0de;
        }
        .btn-info:hover {
            background-color: #31b0d5;
            border-color: #31b0d5;
        }
        .alert {
            margin: 20px 0;
        }
        .header_section {
    padding: 12px 0;
}
.col-md-6 {
        -ms-flex: 0 0 50%;
        flex: 0 0 50%;
        max-width: 50%;
        margin-right: -92px;
    }
    th {
    text-align: center;
}
.fas {
    margin-right: 5px;
}
.btn-danger:hover {
    background-color: #c9302c;
    border-color: #c9302c;
}

.btn-info:hover {
    background-color: #31b0d5;
    border-color: #31b0d5;
}

.table th {
    background-color: #605e5e;
    color: #ffffff;
}
.card-title {
    color: #900613;
    font-weight: 700;
}
.btn-danger {
    background-color: #900613;
    border-color: #900613;
}
.btn-info {
    background-color: #2bac99;
    border-color: #2bac99;
}
.btn-sm {
    padding: .25rem .5rem;
    font-size: .875rem;
    line-height: 1.5;
    border-radius: .2rem;
    margin-left: 22px;
    margin-top: 4px;
}
.header_section {
    background-color: #605e5e !important;
}
.card-title {
    color: #605e5e;
    font-weight: 700;
}
.footer_section {
    background: #605e5e !important;
}
.card {
    border-radius: 15px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin: -30px 0;
}

    </style>
</head>
<body>
<div class="container-fluid mt-5"> <!-- Full height container -->
    <div class="row justify-content-center h-100">
        <div class="col-12 h-100"> <!-- Full width and height column -->
            <div class="card p-4 h-100" style="min-height: 100vh;"> <!-- Full height card -->
                <h3 class="card-title mb-4 text-center">My Requests</h3>
                <form id="form1" name="form1" method="post" action="">
                    <div class="table-responsive h-100"> <!-- Ensure table is responsive and fits -->
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Sl.No</th>
                                    <th scope="col">Blood Group</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Required Date</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $resprofile = $Conn->query($myrequest);
                                $i = 0;
                                while ($datauser = $resprofile->fetch_assoc()) {
                                    $i++;
                                    ?>
                                    <tr>
                                        <td><?php echo $i ?></td>
                                        <td><?php echo $datauser['blood_group'] ?></td>
                                        <td><?php echo $datauser['type_name'] ?></td>
                                        <td><?php 
                                            $date = $datauser['request_requireddate'];
                                            $formattedDate = date('d-m-Y', strtotime($date));
                                            echo $formattedDate;
                                        ?></td>
                                        <td><?php echo $datauser['request_quantity'] ?></td>
                                        <td>
                                            <?php
                                            if ($datauser['request_status'] == 0) {
                                                echo "Active";
                                            } else {
                                                echo "Closed";
                                            }
                                            ?>
                                        </td>
                                        <td class="text-center">
                                            <?php
                                            if ($datauser['request_status'] == 0) {
                                                ?>
                                               <a href="Myrequest.php?request_id=<?php echo $datauser['request_id'] ?>" class="btn btn-danger btn-sm">
    <i class="fas fa-times"></i> Deactivate
</a>
<a href="donorrequest.php?rid=<?php echo $datauser['request_id'] ?>" class="btn btn-info btn-sm mt-1">
    <i class="fas fa-eye"></i> View Donor Request
</a>


                                                <?php
                                            } else {
                                                ?>
                                                <span class="badge badge-secondary">Expired</span>
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
<?php
include('Foot.php');
ob_flush();
?>

