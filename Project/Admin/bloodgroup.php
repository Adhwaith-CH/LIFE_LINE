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

 $bg="";
 $dis="";
 $did="";
 $id="";

include("../Assets/Connection/connection.php");
if(isset($_POST["btn_submit"]))
{
	$id=$_POST["txt_id"];
	$bg=strtoupper($_POST["txt_bloodgroup"]);
	if($id=="")
	{
	  $insqry="insert into tbl_bloodgroup(blood_group)values('$bg')";
	  if($Conn->query($insqry))
	  {
		 echo "inserted";
	  }
	  else{
		  echo "Failure";
	  }
    }
	else{
		$updQry="update tbl_bloodgroup set blood_group ='".$bg."' where blood_id=".$id;
	 	echo $id;
	 
	 	if($Conn ->query($updQry))
	  	{
		 	?>
	   		<script>
		     alert('update')
		     window.location="Bloodgroup.php"
		     </script>
		   <?php
	 	}
		else{
			echo"failure";
		}
 
	}

}







###########DELETE############


	
if(isset($_GET['did']))
    {
	$delQry="delete from tbl_bloodgroup where blood_id=".$_GET['did'];
	if($Conn->query($delQry))
	{
?>
   <script>
   alert('Deleted')
   window.location="Bloodgroup.php"
   </script>
   <?php
	}
	else{
		echo"failure";
	}
}












if(isset($_GET['eid']))
    {
	$selQry="select * from tbl_bloodgroup where blood_id=".$_GET['eid'];
	$resEdit=$Conn->query($selQry);
	$dataEdit=$resEdit->fetch_assoc();
	$dis=$dataEdit['blood_group'];
	$did=$dataEdit['blood_id'];
	}



?>




<div class="row mt-3">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <div class="card-title">Blood Group Form</div>
        <form id="form1" name="form1" method="post" action="Bloodgroup.php">
          <input type="hidden" name="txt_id" value="<?php echo $did ?>"/>
          <!-- Use the Bootstrap table class for styling -->
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th colspan="2" class="text-center">Blood Group Details</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Blood Group</td>
                <td>
                  <input type="text" value="<?php echo $dis ?>" name="txt_bloodgroup" id="txt_bloodgroup" class="form-control" pattern="[A-Za-z]+" />
                </td>
              </tr>
              <tr>
                <td colspan="2" class="text-center">
                  <input type="submit" name="btn_submit" id="btn_submit" class="btn btn-primary" value="Submit" />
                  <a href="#" class="btn btn-secondary">Cancel</a>
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
        <div class="card-title">Blood Group List</div>
        <!-- Use Bootstrap's table classes for styling -->
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th class="text-center">Blood ID</th>
              <th class="text-center">Blood Group</th>
              <th class="text-center">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $dis = "SELECT * FROM tbl_bloodgroup";
            $result = $Conn->query($dis);
            $i = 0;
            while ($data = $result->fetch_assoc()) {
              $i++;
            ?>
              <tr>
                <td class="text-center"><?php echo $i; ?></td>
                <td class="text-center"><?php echo $data['blood_group']; ?></td>
                <td class="text-center">
                  <a href="Bloodgroup.php?did=<?php echo $data['blood_id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                  <a href="Bloodgroup.php?eid=<?php echo $data['blood_id']; ?>" class="btn btn-warning btn-sm">Edit</a>
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

</body>
</html>
<?php
include('Foot.php');
ob_flush();
?>
