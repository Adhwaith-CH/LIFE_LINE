<?php
ob_start();
include('Head.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Untitled Document</title>
</head>

<body>
  <?php
  include("../Assets/Connection/connection.php");
  if (isset($_POST["btn_submit"])) {
    $sd = $_POST["sel_district"];
    $ln = $_POST["txt_place"];
    $place=strtoupper($ln);
    $inqry = "insert into tbl_place(place_name,district_id)value('$place','$sd')";
    if ($Conn->query($inqry)) {
      echo "inserted";
    } else {
      echo "Failure";
    }
  }




  if (isset($_GET['did'])) {
    $delQry = "delete from tbl_place where place_id=" . $_GET['did'];
    if ($Conn->query($delQry)) {
  ?>
      <script>
        alert('Deleted')
        window.location = "Place.php"
      </script>
  <?php
    } else {
      echo "failure";
    }
  }
  ?>
  <div class="row mt-3">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <div class="card-title">Vertical Form</div>
          <form id="form1" name="form1" method="post" action="Place.php">
            <!-- Use the Bootstrap table class for styling -->
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th colspan="2" class="text-center">Place</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Select District</td>
                  <td>
                    <select name="sel_district" id="txt_chkbox" class="form-select form-select-lg">
                      <option>Select District</option>
                      <?php
                      $selqry = "select * from tbl_district";
                      $result = $Conn->query($selqry);
                      while ($data = $result->fetch_assoc()) {
                      ?>
                        <option value="<?php echo $data['district_id']; ?>">
                          <?php echo $data['district_name']; ?>
                        </option>
                      <?php
                      }
                      ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td>Place</td>
                  <td>
                    <input type="text" name="txt_place" id="txt_place" class="form-control" />
                  </td>
                </tr>
                <tr>
                  <td colspan="2" class="text-center">
                    <input type="submit" name="btn_submit" id="btn_submit" class="btn btn-primary" value="Submit" />
                  </td>
                </tr>
              </tbody>
            </table>
          </form>
        </div>
      </div>
    </div>
  </div>


  <div class="row mt-3">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Place List</h5>
          <form action="Place.php" method="get">
            <div class="table-responsive">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th class="text-center">SI NO</th>
                    <th class="text-center">PLACE</th>
                    <th class="text-center">DISTRICT</th>
                    <th class="text-center">ACTION</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $dis = "select * from tbl_place p inner join tbl_district d on d.district_id = p.district_id";
                  $result = $Conn->query($dis);
                  $i = 0;
                  while ($data = $result->fetch_assoc()) {
                    $i++;
                  ?>
                    <tr>
                      <td class="text-center"><?php echo $i; ?></td>
                      <td class="text-center"><?php echo $data['place_name']; ?></td>
                      <td class="text-center"><?php echo $data['district_name']; ?></td>
                      <td class="text-center">
                        <a href="Place.php?did=<?php echo $data['place_id']; ?>" class="action-link">Delete</a>
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
</body>

</html>
<?php
include('Foot.php');
ob_flush();
?>