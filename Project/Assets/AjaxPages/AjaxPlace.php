
<option value="">Select Place</option>
<?php
include('../Connection/connection.php');
$id=$_GET['did'];
$seqry="select * from tbl_place where district_id=".$id;
$result=$Conn->query($seqry);
       while($data=$result->fetch_assoc())
	   {
		   ?>
           <option value="<?php echo $data['place_id'] ?>"><?php
		   echo $data['place_name']?> </option>
           <?php
	   }
	   ?>