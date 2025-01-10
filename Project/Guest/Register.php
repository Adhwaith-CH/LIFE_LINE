<?php
include('../Assets/Connection/connection.php');
session_start();

if (isset($_POST['btn_signup'])) {
  $fname = $_POST['txt_fname'];
  $lname = $_POST['txt_lname'];
  $name = $fname." ".$lname;
  $address = $_POST['txt_address'];
  $contact = $_POST['txt_contact'];
  $email = $_POST['txt_email'];
  $district = $_POST['sel_district'];
  $place = $_POST['sel_place'];
  $gender = $_POST['radio'];
  $password = $_POST['txt_password'];
  $confirmPassword = $_POST['txt_confirmpassword'];
  $dateOfBirth = $_POST['txt_date'];

  $photo = $_FILES['filephoto']['name'];
  $temp = $_FILES['filephoto']['tmp_name'];
  $photoPath = '../Assets/Files/UserDocs/' . $photo;

  move_uploaded_file($temp, $photoPath);

  if ($password !== $confirmPassword) {
    echo "<script>alert('Passwords do not match'); window.location='register.php';</script>";
  } else {
    // Check if email already exists
    $stmt = $Conn->prepare("SELECT * FROM tbl_user WHERE user_email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resuser = $stmt->get_result();

    $stmt = $Conn->prepare("SELECT * FROM tbl_admin WHERE admin_email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resadmin = $stmt->get_result();

    if ($resuser->num_rows > 0 || $resadmin->num_rows > 0) {
      echo "<script>alert('Email already exists'); window.location='register.php';</script>";
    } else {
      // Insert new user into the database
      $stmt = $Conn->prepare("INSERT INTO tbl_user (user_name, user_address, user_email, place_id, gender, user_password, user_contact, user_dob, user_photo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
      $stmt->bind_param("sssssssss", $name, $address, $email, $place, $gender, $password, $contact, $dateOfBirth, $photo);

      if ($stmt->execute()) {
       ?>
        <script>
          // document.contact-form.reset();
          alert("Registration Successfull");
          window.location="Login.php";
        </script>
       <?php
    } else {
        echo "<script>alert('Registration failed'); window.location='register.php';</script>";
    }
    }
  }
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../Assets/Templates/Login/fonts/icomoon/style.css">
  <link rel="stylesheet" href="../Assets/Templates/Login/css/owl.carousel.min.css">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="../Assets/Templates/Login/css/bootstrap.min.css">
  <!-- Style -->
  <link rel="stylesheet" href="../Assets/Templates/Login/css/style.css">
  <title>Register</title>

  <style>
    .form-block {
      max-width: 900px !important;
    }
    .btn-primary {
    color: #fff;
    background-color: #900613;
    border-color: #726e6b;
}

  .form-block {
    max-width: 900px !important;
  }
  .btn-primary {
    color: #fff;
    background-color: #900613; /* Original color */
    border-color: #726e6b;
    transition: background-color 0.3s ease;
  }
  .btn-primary:hover {
    background-color:#4f4e49; /* Grey color on hover */
    border-color: #6c757d; /* Optional: change border color to match */
  }


  </style>


</head>
<script type="text/javascript">
  function preventBack() { window.history.forward(); }
  setTimeout("preventBack()", 0);
  window.onunload = function () { null };
</script>
<body>
  <div class="d-md-flex half">
    <div class="bg" style="background-image: url('../Assets/Templates/Login/images/istockphoto-2154964150-612x612-transformed-removebg-preview (1).png');"></div>
    <div class="contents">
      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-12">
            <div class="form-block mx-auto">
              <div class="text-center mb-5">
                <h3>REGISTER FOR <strong>LIFELINE</strong></h3>
              </div>
              <form method="post" name="reg-form" enctype="multipart/form-data">
                <div class="row">
                  <div class="col-4">
                    <div class="form-group first">
                      <label for="name">First Name</label>
                      <input type="text" name="txt_fname" class="form-control" placeholder="Enter Your First Name" id="name" required>
                    </div>
                    <div class="form-group first">
                      <label for="name">Last Name</label>
                      <input type="text" name="txt_lname" class="form-control" placeholder="Enter Your Last Name" id="name" required>
                    </div>
                    <div class="form-group last mb-3">
                      <label for="address">Address</label> 
                      <textarea name="txt_address" id="" class="form-control" placeholder="Enter Your Address" id="address" required ></textarea>
                
                    </div>
                    <div class="form-group last mb-3">
                      <label for="contact">Mobile</label>
                      <input type="text" name="txt_contact" class="form-control" placeholder="Enter Your Contact Number" id="contact" required pattern="\d{10}" title="Please enter exactly 10 digits">

                    </div>
                  </div>
                  <div class="col-4">
                    <div class="form-group last mb-3">
                      <label for="email">Email</label>
                      <input type="email" name="txt_email" class="form-control" placeholder="Enter Your Email" id="email" required>
                    </div>
                    <div class="form-group last mb-3">
                      <label for="district">District</label>
                      <select name="sel_district" id="district" class="form-control" onchange="getPlace(this.value)" required>
                        <option value="">Select District</option>
                        <?php
                        $selqry = "SELECT * FROM tbl_district";
                        $result = $Conn->query($selqry);
                        while ($data = $result->fetch_assoc()) {
                          echo "<option value='" . $data['district_id'] . "'>" . $data['district_name'] . "</option>";
                        }
                        ?>
                      </select>
                    </div>
                    <div class="form-group last mb-3">
                      <label for="place">Place</label>
                      <select name="sel_place" id="place" class="form-control" required>
                        <option value="">Select Place</option>
                      </select>
                    </div>
                    <div class="form-group last mb-3">
                      <label>Gender</label>
                      <div style="margin-top: 15px;">
                        <label><input type="radio" name="radio" value="male" required> Male</label>
                        <label><input type="radio" name="radio" value="female" required> Female</label>
                      </div>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="form-group last mb-3">
                      <label for="photo">Photo</label>
                      <input type="file" name="filephoto" class="form-control" id="photo" required>
                    </div>
                    <div class="form-group last mb-3">
                      <label for="date">Date of Birth</label>
                      <input type="date" name="txt_date" class="form-control" id="date" required>
                    </div>
                    <div class="form-group last mb-3">
                      <label for="password">Password</label>
                      <input type="password" name="txt_password" class="form-control" placeholder="Enter Your Password" id="password" required>
                    </div>
                    <div class="form-group last mb-3">
                      <label for="confirmpassword">Confirm Password</label>
                      <input type="password" name="txt_confirmpassword" class="form-control" placeholder="Confirm Your Password" id="confirmpassword" required>
                    </div>
                  </div>
                </div>
                <input type="submit" name="btn_signup" class="btn btn-block btn-primary" value="Sign Up">
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="../Assets/Templates/Login/js/jquery-3.3.1.min.js"></script>
  <script src="../Assets/Templates/Login/js/popper.min.js"></script>
  <script src="../Assets/Templates/Login/js/bootstrap.min.js"></script>
  <script src="../Assets/Templates/Login/js/main.js"></script>
  <script>
    function getPlace(did) {
      $.ajax({
        url: "../Assets/AjaxPages/AjaxPlace.php?did=" + did,
        success: function(result) {
          $("#place").html(result);
        }
      });
    }

    document.addEventListener('DOMContentLoaded', function() {
      const today = new Date();
      const maxDate = new Date(today.getFullYear() - 18, today.getMonth(), today.getDate());
      const maxDateString = maxDate.toISOString().split('T')[0];
      document.getElementById('date').setAttribute('max', maxDateString);
    });
  </script>
</body>

</html>