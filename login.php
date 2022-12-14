<?php
session_start();

include("connection.php");
include("functions.php");

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    // print_r($_POST);
    // When the user clicks on the create account button
    $user_name = $_POST['user_name'];
    $password  = $_POST['password'];
    $password = md5($password);

    if(!empty($user_name) &&
        (!empty($password)))
    {
        // Reading from the data base
        $query = "select * from users where username = '$user_name' limit 1";

        $result = mysqli_query($con, $query);

        if($result)
        {
            if($result && mysqli_num_rows($result) > 0)
            {
                $user_data = mysqli_fetch_assoc($result);
                // print_r($user_data);
                echo $user_data['password']," ",$password;

                if($user_data['password'] == $password)
                {
                    if($user_data['status'] == "active")
                    {
                        if($user_data['account_type'] == "hotel_management")
                        {
                            $_SESSION['user_name'] = $user_data['username'];
                            header("Location: hotel_index.php");
                            die;
                        }
                        if($user_data['account_type'] == "flight_management")
                        {
                            $_SESSION['user_name'] = $user_data['username'];
                            header("Location: flight_index.php");
                            die;
                        }
                        $_SESSION['user_name'] = $user_data['username'];
                        header("Location: index.php");
                        die;
                    }
                    else
                    {
                        echo '<script>alert("Your account is deactivated.Please contact the administrator.")</script>';
                        
                    }
                }
            }   
        }
    }
    else{
        echo '<script>alert("Wrong User Details")</script>';
        }
    }


?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <style>
        .container-fluid{
            background-color: #083AA9;
        }
        .title
        {
            color : white;
        }
    </style>
  </head>
  
  <body>
    <div class="container-fluid p-4">
        <div class="row justify-content-center  mb-1">
            <div class="col-6 text-center">
                <h2 class="title">Hotels and Flights</h2>
            </div>
        </div>
        <div class="row justify-content-center  mb-3 p-5">
            <div class="col-4">
                <div class="card mt-1 p-2">
                    <div class="card-body"> 
                       <form method = "post">
                            <div class="mb-4">
                                <label for="name" class="form-label">Enter username</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" name = "user_name" placeholder="Enter your email">
                            </div>
            
                            <div class="mb-4">
                                <label for="name" class="form-label">Enter password</label>
                                <input type="password" class="form-control" id="exampleFormControlInput1" name = "password" placeholder="Enter your password">
                            </div>
            
                            <button type="submit" class="btn btn-primary mb-2">Login</button>
                        </form>

                            <div class="mt-3 mx-auto">
                            <label for="name" class="form-label">New to Hotels and flights?</label>
                                <a href="signup.php">
                                    <button type="button" class="btn btn-success text-decoration-none">Create an account</button>
                                </a>                            
                            </div>
                    </div>

                  </div>
            </div>
        </div>
       
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
  </body>
</html>