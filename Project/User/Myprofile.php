<?php
include('../Assets/Connection/connection.php');
session_start();
ob_start();
include("Head.php");

// Fetch user profile data
$myprofile = "SELECT * FROM tbl_user u 
              INNER JOIN tbl_place p ON u.place_id = p.place_id 
              INNER JOIN tbl_district d ON p.district_id = d.district_id 
              INNER JOIN tbl_bloodgroup bg ON u.blood_id = bg.blood_id 
              WHERE user_id = ?";
$stmt = $Conn->prepare($myprofile);
$stmt->bind_param('i', $_SESSION['uid']);
$stmt->execute();
$resprofile = $stmt->get_result();
$datauser = $resprofile->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <link href="../Assets/Templates/Main/css/style.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .profile-card {
            background-color: #ffffff;
            border-radius: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 50px;
            position: relative;
            overflow: hidden;
        }
        .profile-card-body {
            padding: 20px;
            position: relative;
            z-index: 1;
        }
        .profile-card-title {
            color: #333;
            font-size: 2rem;
            font-weight: 600;
        }
        .profile-card-text {
            font-size: 1rem;
            color: #666;
        }
        .btn-custom {
            font-size: 1rem;
            border-radius: 25px;
            padding: 10px 20px;
            transition: background-color 0.3s, box-shadow 0.3s;
        }
        .btn-primary-custom {
            background-color: #d26262;
            color: #ffffff;
        }
        .btn-primary-custom:hover {
            background-color: #b23b3b;
        }
        .btn-secondary-custom {
            background-color: #6c757d;
            color: #ffffff;
        }
        .btn-secondary-custom:hover {
            background-color: #5a6268;
        }
        .user-photo {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #e8edf3;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            margin-bottom: 20px;
        }
        @media (max-width: 768px) {
            .profile-card {
                margin: 20px;
            }
            .user-photo {
                width: 100px;
                height: 100px;
            }
        }
        .profile-card {
    background-color: #ffffff;
    border-radius: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 20px;
    margin-top: 50px;
    position: relative;
    overflow: hidden;
}

.profile-info {
    margin-left: 30px; /* Adjusted margin for larger photo */
    text-align: left;
}

.user-photo {
    width: 150px; /* Increased size */
    height: 150px; /* Increased size */
    border-radius: 50%;
    object-fit: cover;
    border: 4px solid #e8edf3;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
}

.profile-card-title {
    color: #333;
    font-size: 2.2rem; /* Increased font size */
    font-weight: 600;
}

@media (max-width: 768px) {
    .profile-card {
        margin: 20px;
    }
    .user-photo {
        width: 120px; /* Adjusted size for smaller screens */
        height: 120px; /* Adjusted size for smaller screens */
    }
    .profile-info {
        margin-left: 20px; /* Adjusted margin for smaller screens */
    }
}
.profile-card-title {
    color: #d26262;
    font-size: 3.5rem;
    font-weight: 900;
    padding-left: 3cm;
}
.user-photo {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    object-fit: cover;
    border: 4px solid #e8edf3;
    box-shadow: -3 10px 20px rgba(0, 0, 0, 0.2);
    margin-left: 1cm;
}
.profile-card {
    background-color: #ffffff;
    border-radius: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 20px;
    margin-top: 20px;
    position: relative;
    overflow: hidden;
    margin-bottom: 20px;
}

.btn-primary-custom {
    background-color: #900613;
    color: #ffffff;
}
        
.profile-card-title {
    color: #900613;
    font-size: 3.5rem;
    font-weight: 900;
    padding-left: 3cm;
}
.header_section {
    background-color: #605e5e !important;
}
.profile-card-title {
    color: #605e5e;
    font-size: 3.5rem;
    font-weight: 900;
    padding-left: 3cm;
}
.footer_section {
    background: #605e5e !important;
}

.profile-card-title {
    color: #584f4f;
    font-size: 3.5rem;
    font-weight: 900;
    padding-left: 3cm;
}
.btn-secondary-custom {
    background-color: #605e5e;
    color: #ffffff;
}
    </style>
</head>
<body>

<div class="container-fluid"> <!-- Use container-fluid for full-width -->
    <div class="row justify-content-center">
        <div class="col-12"> <!-- Full width column -->
            <div class="profile-card text-center">
                <div class="d-flex align-items-center">
                    <img src="../Assets/Files/UserDocs/<?php echo htmlspecialchars($datauser['user_photo']); ?>" class="user-photo" alt="User Photo">
                    <div class="profile-info ms-3">
                        <h2 class="profile-card-title"><?php echo htmlspecialchars($datauser['user_name']); ?></h2>
                    </div>
                </div>

                <div class="profile-card-body mt-3">
                    <form>
                        <div class="form-group row">
                            <label for="email" class="col-sm-2 col-form-label">Email:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="email" value="<?php echo htmlspecialchars($datauser['user_email']); ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="contact" class="col-sm-2 col-form-label">Contact:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="contact" value="<?php echo htmlspecialchars($datauser['user_contact']); ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-sm-2 col-form-label">Address:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="address" value="<?php echo htmlspecialchars($datauser['user_address']); ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="district" class="col-sm-2 col-form-label">District:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="district" value="<?php echo htmlspecialchars($datauser['district_name']); ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="place" class="col-sm-2 col-form-label">Place:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="place" value="<?php echo htmlspecialchars($datauser['place_name']); ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="blood_group" class="col-sm-2 col-form-label">Blood Group:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="blood_group" value="<?php echo htmlspecialchars($datauser['blood_group']); ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="height" class="col-sm-2 col-form-label">Height:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="height" value="<?php echo htmlspecialchars($datauser['user_height']); ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="weight" class="col-sm-2 col-form-label">Weight:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="weight" value="<?php echo htmlspecialchars($datauser['user_weight']); ?>" readonly>
                            </div>
                        </div>
                    </form>

                    <div class="text-center mt-4">
                        <a href="Editprofile.php" class="btn btn-custom btn-primary-custom">Edit Profile</a>
                        <a href="Changepassword.php" class="btn btn-custom btn-secondary-custom">Change Password</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
include('Foot.php');
ob_flush();
?>
