<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);
$user_id = $user_data['userId'];

        $get_suites = "select * from suites";

        $result = mysqli_query($con, $get_suites);
        // print_r( $result);

        if($result)
        {
            if($result && mysqli_num_rows($result) > 0)
            {
                $suites_data = mysqli_fetch_all($result);
                // print_r($harbors_data);
            }
        }

        $get_rooms = "select * from rooms";

        $result = mysqli_query($con, $get_rooms);
        // print_r( $result);

        if($result)
        {
            if($result && mysqli_num_rows($result) > 0)
            {
                $rooms_data = mysqli_fetch_all($result);
                // print_r($harbors_data);
            }
        }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home page</title>
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

<div class="container mt-4">
    
        <div class="row">
        <h3 class="display-3 text-primary">Suites</h3>
           <?php for ($row = 0; $row < count($suites_data); $row++) { ?>
            <div class="col-4">
            <div class="card" style="width: 15rem;">
              <img class="card-img-top" src="data:image/png;charset=utf8;base64,<?php echo base64_encode($suites_data[$row][5]); ?>" width = "150px" height="150px" alt="Card image cap">
             <div class="card-body text-left">
               <p class="card-text p-0"><b><?php echo $suites_data[$row][2]; ?></b></p>
               <p class="card-text p-0"><?php echo $suites_data[$row][3]; ?></p>
               <p class="card-text p-0">$<?php echo $suites_data[$row][4]; ?></p>


             </div>
            </div>
            
                 
            </div>
            <?php }?>
        </div>
        <div class="row">
        <h3 class="display-3  text-primary">Rooms</h3>
        <?php for ($row = 0; $row < count($rooms_data); $row++) { ?>

            <div class="col-4">

            <div class="card" style="width: 15rem;">
              <img class="card-img-top" src="data:image/png;charset=utf8;base64,<?php echo base64_encode($rooms_data[$row][5]); ?>" width = "150px" height="150px" alt="Card image cap">
             <div class="card-body text-left">
               <p class="card-text p-0"><b><?php echo $rooms_data[$row][2]; ?></b></p>
               <p class="card-text p-0"><?php echo $rooms_data[$row][3]; ?></p>
               <p class="card-text p-0">$<?php echo $rooms_data[$row][4]; ?></p>


             </div>
            </div>
           
                 
            </div>
            <?php }?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
  </body>
</html>