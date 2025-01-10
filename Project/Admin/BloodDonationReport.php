<?php
ob_start(); // Start output buffering
include('Head.php');
include('../Assets/Connection/connection.php');
require('fpdf/fpdf.php'); // Include the FPDF library
$sdate="";
$edate="";
if (isset($_POST['btn_search'])) {
    $sdate = $_POST['txt_sdate'];
    $edate = $_POST['txt_edate'];
}
if (isset($_POST['btn_print'])) {
    $sdate = $_POST['txt_sdate'];
    $edate = $_POST['txt_edate'];

    // Query to fetch the data
    $stmt = $Conn->prepare("SELECT * FROM tbl_donorrequest d 
                            INNER JOIN tbl_user u ON u.user_id = d.user_id 
                            INNER JOIN tbl_place p ON p.place_id = u.place_id 
                            INNER JOIN tbl_district dt ON dt.district_id = p.district_id 
                            INNER JOIN tbl_request r ON r.request_id = d.request_id 
                            INNER JOIN tbl_bloodgroup bg ON bg.blood_id = r.bloodgroup_id 
                            WHERE donorrequest_date BETWEEN ? AND ?");
    $stmt->bind_param("ss", $sdate, $edate);
    $stmt->execute();
    $resprofile = $stmt->get_result();

    // Create new PDF document
    $pdf = new FPDF('L');
    $pdf->AddPage();

    // Set title and font
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 10, 'Donor Request Report', 1, 1, 'C');

    // Set column headers
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(10, 10, '#', 1);
    $pdf->Cell(50, 10, 'NAME', 1);
    $pdf->Cell(40, 10, 'BLOODGROUP', 1);
    $pdf->Cell(50, 10, 'DISTRICT', 1);
    $pdf->Cell(50, 10, 'PLACE', 1);
    $pdf->Cell(30, 10, 'REQ DATE', 1);
    $pdf->Cell(15         , 10, 'QTY', 1);
    $pdf->Cell(30, 10, 'PHONE', 1);
    $pdf->Ln();

    // Fetch and display data in the PDF
    $i = 0;
    while ($datauser = $resprofile->fetch_assoc()) {
        $i++;
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(10, 10, $i, 1);
        $pdf->Cell(50, 10, $datauser['user_name'], 1);
        $pdf->Cell(40, 10, $datauser['blood_group'], 1);
        $pdf->Cell(50, 10, $datauser['district_name'], 1);
        $pdf->Cell(50, 10, $datauser['place_name'], 1);
        $pdf->Cell(30, 10, $datauser['donorrequest_date'], 1);
        $pdf->Cell(15, 10, $datauser['request_quantity'], 1);
        $pdf->Cell(30, 10, $datauser['user_contact'], 1);
        $pdf->Ln();
    }

    // Clear the output buffer
    ob_end_clean(); // Clear the buffer before PDF output

    // Output the PDF
    $pdf->Output('D', 'DonorRequestReport.pdf'); // Force download
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate PDF</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #343a40; /* Dark background color */
            color: white; /* White text color */
        }
        .form-control,
        .btn {
            background-color: #495057; /* Dark form background to match the theme */
            color: white; /* White text inside form fields and buttons */
        }
        .form-control:focus,
        .btn:focus {
            box-shadow: none; /* Remove default focus box-shadow */
            border-color: #495057; /* Match border color with form background */
        }
        .table {
            background-color: transparent; /* Transparent table background */
        }
        .table td, .table th {
            color: white; /* White text in the table */
            background-color: rgba(255, 255, 255, 0.1); /* Increase opacity for table data (10%) */
        }
        .table-hover tbody tr:hover td {
            background-color: rgba(255, 255, 255, 0.2); /* Slightly higher opacity on hover */
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Donor Request Report</h2>
        <form action="" method="post" class="mt-4">
            <div class="row">
                <div class="col-md-4">
                    <label for="txt_sdate" class="form-label">Start Date</label>
                    <input type="date" name="txt_sdate" class="form-control" value="<?php echo $sdate ?>" required>
                </div>
                <div class="col-md-4">
                    <label for="txt_edate" class="form-label">End Date</label>
                    <input type="date" name="txt_edate" class="form-control" value="<?php echo $edate ?>" required>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-12 text-center">
                    <button type="submit" name="btn_search" class="btn btn-info me-2">Search</button>
                    <button type="submit" name="btn_print" class="btn btn-primary">Generate PDF</button>
                    <button type="reset" class="btn btn-warning">Reset</button>
                </div>
            </div>
        </form>

        <?php
        if (isset($_POST['btn_search'])) {
            $sdate = $_POST['txt_sdate'];
            $edate = $_POST['txt_edate'];

            // Query to fetch and display data in the table (similar to the PDF logic)
            $stmt = $Conn->prepare("SELECT * FROM tbl_donorrequest d 
                                    INNER JOIN tbl_user u ON u.user_id = d.user_id 
                                    INNER JOIN tbl_place p ON p.place_id = u.place_id 
                                    INNER JOIN tbl_district dt ON dt.district_id = p.district_id 
                                    INNER JOIN tbl_request r ON r.request_id = d.request_id 
                                    INNER JOIN tbl_bloodgroup bg ON bg.blood_id = r.bloodgroup_id 
                                    WHERE donorrequest_date BETWEEN ? AND ?");
            $stmt->bind_param("ss", $sdate, $edate);
            $stmt->execute();
            $resprofile = $stmt->get_result();

            if ($resprofile->num_rows > 0) {
                echo '<table class="table table-bordered mt-4">';
                echo '<thead class="table-dark">
                        <tr>
                            <th>SI.NO</th>
                            <th>NAME</th>
                            <th>BLOODGROUP</th>
                            <th>DISTRICT</th>
                            <th>PLACE</th>
                            <th>REQ DATE</th>
                            <th>QTY</th>
                            <th>PHONE</th>
                        </tr>
                    </thead>';
                echo '<tbody>';
                $i = 0;
                while ($datauser = $resprofile->fetch_assoc()) {
                    $i++;
                    echo '<tr>
                            <td>' . $i . '</td>
                            <td>' . htmlspecialchars($datauser['user_name']) . '</td>
                            <td>' . htmlspecialchars($datauser['blood_group']) . '</td>
                            <td>' . htmlspecialchars($datauser['district_name']) . '</td>
                            <td>' . htmlspecialchars($datauser['place_name']) . '</td>
                            <td>' . htmlspecialchars($datauser['donorrequest_date']) . '</td>
                            <td>' . htmlspecialchars($datauser['request_quantity']) . '</td>
                            <td>' . htmlspecialchars($datauser['user_contact']) . '</td>
                          </tr>';
                }
                echo '</tbody></table>';
            } else {
                echo '<p class="text-danger text-center">No records found for the selected dates.</p>';
            }
        }
        ?>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
include('Foot.php');
ob_flush();
?>
