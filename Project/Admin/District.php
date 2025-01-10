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



$did="";
$dis="";

$district='';





include("../Assets/Connection/connection.php");
$flage=0;
 if(isset($_POST["btn_submit"]))
 {
	 $id=$_POST["txt_id"];
	 $dn=$_POST["txt_disname"];
	 $district=strtoupper($dn);
	
	 if($_POST["txt_id"]=="")
	 
	 {
		 
		 $seldis="select * from tbl_district where district_name='".$district."'";   //District ലെ എല്ലാ values സും select ചെയുക//
		$rowdis=$Conn->query($seldis);
		if($rowdis->num_rows>0)
		 {
			 echo " DISTRICT IS ALREADY EXIST ";
		 }
		 else
		 {
		 $insqry="insert into tbl_district(district_name)values('$district')";
		 if($Conn->query($insqry))
		 {
			 echo "inserted";
		 }
		 else
		 {
			  echo "Failure";
		 }
 		}
	 }
 else{
	 $updQry="update tbl_district set district_name ='".$district."' where district_id=".$id;
	 if($Conn->query($updQry))
	 {
		 ?>
	   <script>
   alert('update')
   window.location="District.php"
   </script>
   <?php
	 }
	else{
		echo "failure";
	}
 
 }
 }
 
 
 
 
 
 
 
 if(isset($_GET['did']))
    {
	$delQry="delete from tbl_district where district_id=".$_GET['did'];
	if($Conn->query($delQry))
	{
?>






   <script>
   alert('Deleted')
   window.location="District.php"
   </script>
   <?php
	}
	else{
		echo"failure";
	}
}







 if(isset($_GET['eid']))
    {
	$selQry="select * from tbl_district where district_id=".$_GET['eid'];
	$resEdit=$Conn->query($selQry);
	$dataEdit=$resEdit->fetch_assoc();
	$dis=$dataEdit['district_name'];
	$did=$dataEdit['district_id'];
	}
?>




<div class="row mt-3">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <div class="card-title">District Form</div>
        <form id="form1" name="form1" method="post">
          <input type="hidden" name="txt_id" value="<?php echo $did ?>"/>
          
          <!-- Bootstrap form layout -->
          <div class="mb-3 row">
            <label for="txt_disname" class="col-sm-3 col-form-label">District Name</label>
            <div class="col-sm-9">
              <input type="text" name="txt_disname" id="txt_disname" class="form-control" value="<?php echo $dis ?>" />
            </div>
          </div>
          
          <!-- Buttons -->
          <div class="mb-3 row">
            <div class="col-sm-12 text-center">
              <button type="submit" name="btn_submit" id="btn_submit" class="btn btn-primary">Submit</button>
              <button type="reset" name="btn_clear" id="btn_clear" class="btn btn-secondary">Clear</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


<div class="container mt-3">
  <div class="card">
    <div class="card-body">
      <div class="card-title">District List</div>
      <form action="District.php" method="get">
        <!-- Bootstrap table classes -->
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th class="text-center">SI.NO</th>
              <th class="text-center">DISTRICT</th>
              <th class="text-center">ACTION</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $dis = "SELECT * FROM tbl_district";
            $result = $Conn->query($dis);
            $i = 0;
            while ($data = $result->fetch_assoc()) {
              $i++;
            ?>
              <tr>
                <td class="text-center"><?php echo $i; ?></td>
                <td><?php echo $data['district_name']; ?></td>
                <td class="text-center">
                  <a href="District.php?did=<?php echo $data['district_id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                  <a href="District.php?eid=<?php echo $data['district_id']; ?>" class="btn btn-warning btn-sm">Edit</a>
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