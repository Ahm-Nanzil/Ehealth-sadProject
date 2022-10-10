<?php
session_start();
include "includes/db_conn.php";
if (isset($_SESSION['username']) && isset($_SESSION['user_id'])) {   ?>


    <!DOCTYPE html>
    <html>

    <head>
        <title>Doctor List</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/custom.css">
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    </head>

    <style>
.dropbtn {
  background-color: #04AA6D;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {background-color: #ddd;}

.dropdown:hover .dropdown-content {display: block;}

.dropdown:hover .dropbtn {background-color: #3e8e41;}
</style>


    <body>

        <?php include "includes/sidebar.php" ?>

        <div class="main">

            <?php if (isset($_REQUEST['deleted'])) {
                echo '<div class="alert alert-danger" role="alert"> User Deleted successful.</div>';
            } ?>
            <section>
                <div class="content-body">
                    <div id="doctors-list">
                        <div class="row">
                            <?php $sql = "SELECT * FROM users JOIN doctors USING(user_id) WHERE role = 'doctor'";
                            $res = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($res) > 0) {
                                while ($rows = mysqli_fetch_assoc($res)) { ?>
                                    <div class=" col-xl-3 col-lg-4 col-md-6 pb-3">
                                        <div class="card" style="height: 280px;">
                                            <img src="img/doctor.png" alt="" class="card-img-top img-fluid rounded-circle w-25 mx-auto mt-1">
                                            <div class="card-body">
                                                <h6 class="card-title font-large-1 mb-0 text-center"><?php echo $rows["first_name"] . " " . $rows["last_name"]; ?></h6>
                                                <p class="font-small-3 mb-0 text-center"><?php echo $rows["doctor_degree"]; ?></p>
                                                <p class="font-small-3 mb-0 text-center"><?php echo $rows["age"]; ?></p>
                                                <p class="font-small-3 text-center"><?php echo $rows["gender"]; ?></p>
                                                <p class="font-small-3 mb-0 text-center"><?php echo $rows["email"]; ?></p>
                                                <p class="card-text card font-medium-1 text-center mb-0"><?php echo $rows["department"]; 
                                                $id= $rows["user_id"];
                                                // echo 'srgbzfhg'+$id;
                                                ?></p>
                                              
                                              <?php 
                                                echo '
                                                <div class="dropdown">
  <button class="dropbtn">Contact</button>
  <div class="dropdown-content">
    <a href="Chat/chat.php?user_id='.$id.'">Massage</a>
    <a href="add_appoinment.php">Appoinment</a>
    
  </div>
</div>
';

?>
                                              
                                            </div>
                                        </div>
                                    </div>
                            <?php }
                            } ?>
                        </div>
                    </div>

                </div>
            </section>

        </div>
    </body>

    </html>
<?php } else {
    header("Location: login.php");
} ?>