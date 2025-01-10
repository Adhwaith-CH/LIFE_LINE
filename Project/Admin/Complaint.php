<?php
ob_start();
include('Head.php');
include("../Assets/Connection/connection.php");
session_start();

// Query to fetch complaint data
$selQry = "SELECT * FROM tbl_Complaint c 
            INNER JOIN tbl_user u ON c.user_id = u.user_id";
$resQry = $Conn->query($selQry);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaint List</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #343a40; /* Dark background color */
            color: white; /* White text color */
        }

        .card {
            background-color: transparent; /* Transparent background for the form */
            border: none; /* Remove border */
        }

        .form-control,
        .btn {
            background-color: #495057; /* Dark form background to match the theme */
            color: white; /* White text inside form fields and buttons */
        }

        .table {
            background-color: transparent; /* Transparent table background */
        }

        .table td,
        .table th {
            color: white; /* White text in the table */
            background-color: rgba(255, 255, 255, 0.1); /* Increase opacity for table data (10%) */
        }

        .table-hover tbody tr:hover td {
            background-color: rgba(255, 255, 255, 0.2); /* Slightly higher opacity on hover */
        }

        /* Ensure white text color in all table elements */
        .table th, .table td {
            color: white;
        }
        .table-striped>tbody>tr:nth-of-type(odd)>* {
    --bs-table-accent-bg: var(--bs-table-striped-bg);
    color:white;
}
.form-control, .btn {
    background-color: #108e43;
    color: white;
}
element.style {
    margin-top: 53px;
}
    </style>
</head>

<body>
<div class="container-fluid mt-5" style="height: 100vh;"> <!-- Full height container -->
    <div class="row h-100">
        <div class="col-12 h-100"> <!-- Full width and height column -->
            <div class="card h-100">
                <div class="card-body d-flex flex-column h-100"> <!-- Full height card body -->
                    <h2 class="text-center mb-4">Complaint Management</h2>
                    <form id="form1" name="form1" method="post" action="" class="flex-grow-1">
                        <div class="table-responsive h-100"> <!-- Responsive table -->
                            <table class="table table-hover table-bordered table-striped">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="text-center">Sl.No</th>
                                        <th class="text-center">User</th>
                                        <th class="text-center">Title</th>
                                        <th class="text-center">Content</th>
                                        <th class="text-center">Reply</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    while ($datauser = $resQry->fetch_assoc()) {
                                        $i++;
                                    ?>
                                        <tr>
                                            <td class="text-center"><?php echo $i; ?></td>
                                            <td><?php echo htmlspecialchars($datauser['user_name']); ?></td>
                                            <td><?php echo htmlspecialchars($datauser['complaint_title']); ?></td>
                                            <td><?php echo htmlspecialchars($datauser['complaint_description']); ?></td>
                                            <td><?php echo htmlspecialchars($datauser['complaint_reply']); ?></td>
                                            <td class="text-center">
                                                <a href="Reply.php?cid=<?php echo $datauser['complaint_id']; ?>" class="btn btn-sm btn-primary">Reply</a>
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
</div>


    <!-- Include Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
include('Foot.php');
ob_flush();
?>
