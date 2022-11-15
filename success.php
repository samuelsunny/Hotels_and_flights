<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);
$user_id = $user_data['userId'];





?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  </head>
  <body>
    <div class="container-fluid">
    <nav class="navbar navbar-expand-lg bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="index.php"><b>Hotels and flights</b></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                
                <li class="nav-item">
                <a class="nav-link active  text-white" aria-current="page" href="index.php">Home</a>
                </li>

                <li class="nav-item">
                <a class="nav-link active  text-white" aria-current="page" href="hotels.php">Hotels</a>
                </li>

                <li class="nav-item">
                <a class="nav-link active  text-white" aria-current="page" href="#">Flights</a>
                </li>
            </ul>
            
                <span class="align-middle mr-2">
                <a class="nav-link active  text-white" href="edit_profile.php">
                    <h1 class="display-4 fs-5 text-center  text-white ">Welcome, <?php echo $user_data['username'];?> &nbsp; </h1>
                </a>
                </span>
                <a href="logout.php">
                    <button class="btn btn-light text-primary  ml-2" type="submit">Log out</button>
                </a>
            </div>
        </div>
    </nav>
</div>

<div class="container-fluid">
    <div class="row justify-content-center mt-5">
        <div class="col-2 text-right">
            <img class="img" src="greentick.png" width = "150px" height="150px">
        </div>
        <div class="col-5">
            <h1 class="display-4 fs-2 text-left mt-4"><b>Added successfully!</b></h1>
        </div>
        </div>
    </div>
    
    
</div>
  
  
      

      
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
  </body>
</html>

