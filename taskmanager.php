<?php 
include 'connection.php';




?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <![endif]-->
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="account.css">
        <link rel="stylesheet" href="request.css">
        <link rel="stylesheet" href="meet.css">


        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>


    </head>
    <body>
        <div class="container-fluid">

            <h1 class="webname">Paradigm Education</h1>

        </div>
        <nav class="navbar navbar-expand-sm sticky-top">
            <div class="container-fluid" id="one">

            <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#MenuExpand" aria-controls="MenuExpand" aria-expanded="false" aria-label="Toggle navigation">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-center" id="MenuExpand">

                <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item first redUnderline" id="underline">
                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                </li>


                <?php
                if(isset($_SESSION['type'])) {
                  $type = $_SESSION['type'];
                  if($type == 'student'){
                    echo '
                    <li class="nav-item redUnderline" id="underline">
                    <a class="nav-link" href="teacheravailability.php">Teacher Availability</a>
                </li>
                    <li class="nav-item redUnderline" id="underline">
                          <a class="nav-link" href="taskmanager.php">Tasks & Deadlines</a>
                    </li>
                    
                    <li class="nav-item redUnderline" id="underline">
                    <a class="nav-link" href="aitutor.php">AI Tutor</a>
                </li>';

                  }

                }
                else {
                  echo '                    <li class="nav-item redUnderline" id="underline">
                  <a class="nav-link" href="teacheravailability.php">Teacher Availability</a>
              </li>                    <li class="nav-item redUnderline" id="underline">
              <a class="nav-link" href="aitutor.php">AI Tutor</a>
          </li>';
                }

                  if(isset($_SESSION['type'])) {
                    $type = $_SESSION['type'];
                    if($type == 'student'){
                      echo '

                      <li class="nav-item redUnderline" id="underline">
                        <a class="nav-link" href="yourmeetings.php">Your Meetings</a>
                      </li>
                      ';
                    
                  }
                  elseif($type == 'tutor') {
                    echo '

                    <li class="nav-item redUnderline" id="underline">
                    <a class="nav-link" href="managerequests.php">Manage Requests</a>
                  </li>


                    <li class="nav-item redUnderline" id="underline">
                      <a class="nav-link" href="yourmeetings.php">Your Meetings</a>
                    </li>
                    
                    

                  
                  <li class="nav-item redUnderline" id="underline">
                  <a class="nav-link" href="">Create Meeting</a>
                </li>

                <li class="nav-item redUnderline" id="underline">
                <a class="nav-link" href="assigntasks.php">Assign Tasks</a>
              </li>

                  ';
                    
                  }

                }


                if(isset($_SESSION['id'])) {
                    echo '                
                
                
                <li class="nav-item redUnderline" id="underline">
                    <a class="nav-link" href="profile.php">Profile</a>
                </li>';
                }
                else {
                    echo '                <li class="nav-item redUnderline" id="underline">
                    <a class="nav-link" href="signup.php">Login/ Signup</a>
                </li>';
                }

                


                ?>
                </ul>

            </div>
            </div>
        </nav>








        <div class="container">
                <center><div class="header" style="margin-top: 100px; font-size:45px; margin-bottom: 30px;">Your Tasks and Assessments.</div></center>
                <center><div class="header" style="margin-top: 10px; font-size:22px; margin-bottom: 100px;">Stick to your deadlines and do your best in your tasks!</div></center>
                
            </div>

            <div class="service-area">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-12 col-md-12 col-xs-12">
                <?php
                $studentid = $_SESSION["id"];
                $result = mysqli_query($conn, "SELECT * FROM task_assign WHERE studentid = '$studentid'");
                $result2 = mysqli_query($conn, "SELECT * FROM task_submit WHERE studentid = '$studentid'");
                $result3 = mysqli_query($conn, "SELECT * FROM task_graded WHERE studentid = '$studentid'");
                if(mysqli_num_rows($result) != 0 or mysqli_num_rows($result2) != 0 or mysqli_num_rows($result3) != 0) {
                    if(mysqli_num_rows($result)) {

                    if(mysqli_num_rows($result) != 0){
                        echo '<div class="header" style=" font-size:45px; margin-bottom: 30px;">Pending Work</div>';
                    }
                    while($row = mysqli_fetch_array($result)) {
                        echo "
                        <a href='submittask.php?id={$row['taskid']}'><div class='card'>
                            <div class='row'>
                                <div class='col-6'>
                                    <h3 class='card-heading'>Task Name: {$row['taskname']}</h3>
                                    <h3 class='card-heading'>Tutor Name: {$row['tutorname']}</h3>
                                    <p class='card-heading'>Subject: {$row['subject']}</p>
                                </div>
                                <div class='col-6'>
                                    <h3 class='card-heading'>Description: {$row['taskdescription']}</h3>
                                </div>
                            </div>
                        </div>";
                    }
                }

                    if(mysqli_num_rows($result2) != 0){
                        echo '<div class="header" style=" font-size:45px; margin-bottom: 30px;">Submitted Work</div>';
                    }
                    while($row = mysqli_fetch_array($result2)) {
                        echo "
                        <a href='submittask.php?id={$row['tasksubmitid']}'><div class='card'>
                            <div class='row'>
                                <div class='col-6'>
                                    <h3 class='card-heading'>Task Name: {$row['taskname']}</h3>
                                    <h3 class='card-heading'>Tutor Name: {$row['tutorname']}</h3>
                                    <p class='card-heading'>Subject:{$row['totalmarks']}</p>
                                </div>
                                <div class='col-6'>
                                    <h3 class='card-heading'>Description: {$row['taskdescription']}</h3>
                                </div>
                            </div>
                        </div>";
                    }


                    if(mysqli_num_rows($result3) != 0){
                        echo '<div class="header" style=" font-size:45px; margin-bottom: 30px;">Graded Work</div>';
                    }
                    while($row = mysqli_fetch_array($result3)) {
                        echo "
                        <a href='submittask.php?id={$row['taskid']}'><div class='card'>
                            <div class='row'>
                                <div class='col-6'>
                                    <h3 class='card-heading'>Task Name: {$row['taskname']}</h3>
                                    <h3 class='card-heading'>Tutor Name: {$row['tutorname']}</h3>
                                    <p class='card-heading'>Score:{$row['marksachieved']}/{$row['totalmarks']}</p>
                                </div>
                                <div class='col-6'>
                                    <h3 class='card-heading'>Take a look: {$row['feedbackdescription']}</h3>
                                </div>
                            </div>
                        </div>";
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>







    
        <script src="" async defer></script>
    </body>
</html>