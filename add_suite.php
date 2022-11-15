<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);
$user_id = $user_data['userId'];



if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        // When the user clicks on the submit button
        $hotelId = $user_data['userId'];
        $suite_name = $_POST['suite_name'];
        $amenities  = $_POST['amenities'];
        $price  = $_POST['price'];
        

       
        if(!empty($_FILES["image_file"]["name"])) { 
            echo "Inside image code!";
            // Get file info 
            $fileName = basename($_FILES["image_file"]["name"]); 
            $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
             
            // Allow certain file formats 
            $allowTypes = array('jpg','png','jpeg','gif'); 
            if(in_array($fileType, $allowTypes)){ 
                $image = $_FILES['image_file']['tmp_name']; 
                $imgContent = addslashes(file_get_contents($image)); 
            }
        }



        if(!empty($suite_name) &&
            (!empty($amenities)) &&
            (!empty($amenities))&&
            (!empty($price)))
        {
            // Saving to data base
            $query = "insert into suites (hotelId, suite_name, amenities, price,suite_image) values ('$hotelId','$suite_name','$amenities','$price','$imgContent')";

            mysqli_query($con, $query);

            


            header("Location: hotel_index.php");
            die;
        }
        else{
            echo '<script>alert("Please enter valid information!")</script>';
            
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
                <a class="nav-link active  text-white" aria-current="page" href="hotel_index.php">Home</a>
                </li>

                <li class="nav-item">
                <a class="nav-link active  text-white" aria-current="page" href="add_suite.php">Add suites</a>
                </li>

                <li class="nav-item">
                <a class="nav-link active  text-white" aria-current="page" href="add_room.php">Add rooms</a>
                </li>
            </ul>
            
                <span class="align-middle mr-2">
                <a class="nav-link active  text-white" href="edit_hotel_profile.php">
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
    <div class="row justify-content-center mt-5">
        <div class="col-6">
            <h1 class="display-4 fs-2 text-center"><b>Add suite details</b></h1>
        </div>
    </div>

    <div class="row mt-5 justify-content-center">
        <div class="col-8">
        <form method = "post" enctype="multipart/form-data">
            <div class="row">
                <div class="mb-4">
                <label for="exampleFormControlInput1" class="form-label">Enter suite name</label>

                    <input type="text" class="form-control" id="suite_name" name = "suite_name" placeholder="">
                </div>
            </div>
            <div class="row">
                <div class="mb-4">
                <label for="exampleFormControlInput1" class="form-label">Enter amenities</label>

                    <textarea class="form-control" id = "amenities" name = "amenities" rows="2"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="mb-4">
                <label for="exampleFormControlInput1" class="form-label">Enter price</label>

                    <input type="text" class="form-control" id="price" name = "price" placeholder="">
                </div>
            </div>

        
           
            <div class="row">
                <div class="mb-3">
                    <label for="formFile" class="form-label">Choose the suite image file</label>
                    <input class="form-control" type="file" id="formFile" name="image_file">
                </div>
            </div>
        <div class="row">

            <button type="submit" class="btn btn-primary mb-2">Submit</button>
        </div>
</div>
        </form>
        </div>
    </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
  </body>
</html>