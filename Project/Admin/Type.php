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
	$tn = "";
	$id = "";
	$dis = "";
	$did = "";


	include("../Assets/Connection/connection.php");
	if (isset($_POST["btn_submit"])) {
		$id = $_POST["txt_id"];
		$tn = strtoupper($_POST["txt_typename"]);
		if ($id == "") {
			$insqry = "insert into tbl_type(type_name)values('$tn')";
			if ($Conn->query($insqry)) {
				echo "inserted";
			} else {
				echo "Failure";
			}
		} else {

			$updQry = "update tbl_type set type_name='" . $tn . "'where type_id=" . $id;
			echo $id;
			if ($Conn->query($updQry)) {
	?>
				<script>
					alert('update')
					window.location = "type.php"
				</script>
			<?php
			} else {
				echo "failure";
			}
		}
	}







	if (isset($_GET['did'])) {
		$delQry = "delete from tbl_type where type_id=" . $_GET['did'];
		if ($Conn->query($delQry)) {
			?>
			<script>
				alert('Deleted')
				window.location = "type.php"
			</script>
	<?php
		} else {
			echo "failure";
		}
	}



	if (isset($_GET['eid'])) {
		$selQry = "select * from tbl_type where type_id=" . $_GET['eid'];
		$resEdit = $Conn->query($selQry);
		$dataEdit = $resEdit->fetch_assoc();
		$dis = $dataEdit['type_name'];
		$did = $dataEdit['type_id'];
	}






	?>
	<div class="container mt-3">
  <div class="card">
    <div class="card-body">
      <div class="card-title">Type Form</div>
      <form id="form1" name="form1" method="post" action="type.php">
        <input type="hidden" name="txt_id" value="<?php echo $did ?>" />

        <!-- Bootstrap form layout -->
        <div class="mb-3 row">
          <label for="txt_typename" class="col-sm-3 col-form-label">Type Name</label>
          <div class="col-sm-9">
            <input type="text" name="txt_typename" id="txt_typename" class="form-control" value="<?php echo $dis ?>" />
          </div>
        </div>

        <!-- Submit button -->
        <div class="mb-3 row">
          <div class="col-sm-12 text-center">
            <button type="submit" name="btn_submit" id="btn_submit" class="btn btn-primary">Submit</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="container mt-3">
  <div class="card">
    <div class="card-body">
      <div class="card-title">Type List</div>
      <form action="" method="get">
        <!-- Bootstrap table classes -->
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th class="text-center">Type ID</th>
              <th class="text-center">Type Name</th>
              <th class="text-center">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $dis = "SELECT * FROM tbl_type";
            $result = $Conn->query($dis);
            $i = 0;
            while ($data = $result->fetch_assoc()) {
              $i++;
            ?>
              <tr>
                <td class="text-center"><?php echo $i; ?></td>
                <td><?php echo $data['type_name']; ?></td>
                <td class="text-center">
                  <a href="type.php?did=<?php echo $data['type_id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                  <a href="type.php?eid=<?php echo $data['type_id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                </td>
              </tr>
            <?php
            }
            ?>
          </tbody>
        </table>
      </form>
    </div>
  </div>
</div>


</body>

</html>
<?php
include('Foot.php');
ob_flush();
?>