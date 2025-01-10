<?php
ob_start();
include('Head.php');
include("../Assets/Connection/connection.php");
$curDate = Date('Y-m-d');
$viewrequest = "SELECT * FROM tbl_request r 
                INNER JOIN tbl_bloodgroup b ON r.bloodgroup_id = b.blood_id 
                INNER JOIN tbl_type t ON t.type_id = r.type_id 
                INNER JOIN tbl_place p ON p.place_id = r.place_id 
                INNER JOIN tbl_district d ON d.district_id = p.district_id 
                INNER JOIN tbl_user u ON u.user_id = r.user_id 
                AND request_status = 0 
                AND request_requireddate >= '$curDate' 
                ORDER BY request_requireddate ASC";
$resprofile = $Conn->query($viewrequest);
?>

        <!--Start Dashboard Content-->

        

        <div class="card">
  <div class="card-header">Request List
    <div class="card-action">
      <div class="dropdown">
        <a href="javascript:void();" class="dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown">
          <i class="icon-options"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right">
          <a class="dropdown-item" href="javascript:void();">Action</a>
          <a class="dropdown-item" href="javascript:void();">Another action</a>
          <a class="dropdown-item" href="javascript:void();">Something else here</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="javascript:void();">Separated link</a>
        </div>
      </div>
    </div>
  </div>
  <div class="table-responsive">
    <table class="table align-items-center table-flush table-borderless">
      <thead>
        <tr>
          <th>#</th>
          <th>Attendee Name</th>
          <th>Blood Group</th>
          <th>Type</th>
          <th>Location</th>
          <th>Required Date</th>
          <th>Quantity</th>
          <th>Status</th>
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
          <td><?php echo htmlspecialchars($datauser['district_name'].", ".$datauser['place_name']); ?></td>
          <td><?php echo htmlspecialchars($datauser['request_requireddate']); ?></td>
          <td><?php echo htmlspecialchars($datauser['request_quantity']); ?></td>
          <td>
            <?php
            if ($datauser['request_status'] == 0) {
              echo '<div class="text-success">Request Active</div>';
            }
            else{
              echo '<div class=" text-danger">Request Closed</div>';
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
<!--End Row-->

        <!--End Dashboard Content-->

        <!--start overlay-->
        <div class="overlay toggle-menu"></div>
        <!--end overlay-->
<?php
include('Foot.php');
ob_flush();
?>
      