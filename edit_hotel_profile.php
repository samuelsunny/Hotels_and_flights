<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);
$user_id = $user_data['userId'];


    if($_SERVER['REQUEST_METHOD'] == "GET")
    {
        $get_users = "select * from users where userId='{$user_id}'";

        $result = mysqli_query($con, $get_users);
        // print_r( $result);

        if($result)
        {
            if($result && mysqli_num_rows($result) > 0)
            {
                $users_data = mysqli_fetch_all($result);
                // print_r($harbors_data);
            }
        }
        // print_r($users_data);
    }
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        // print_r($_POST);
        // user details
        $user_name     = $_POST['username'];
        $password      = $_POST['password'];
        if($user_data['password'] != $password)
        {
            $password      = md5($password);
        }
        $name          = $_POST['name'];
        $address          = $_POST['address'];
        $city          = $_POST['city'];
        $country          = $_POST['country'];
        $contact_number   = $_POST['contact_number'];

        // Payment details
        $name_on_card  = $_POST['name_on_card'];
        $card_number   = $_POST['card_number'];
        $expiry_date   = $_POST['expiry_date'];
        $cvv           = $_POST['cvv'];
        $billing_address = $_POST['billing_address'];
        $account_type   = "individual";
        $status = "active";

        if((!empty($user_name)) && (!empty($password))&&
            (!empty($account_type))&& (!empty($address))&&
            (!empty($contact_number)))
        {

            // Saving to data base
            $query = "update users set username='{$user_name}',password='{$password}',name='{$name}',address='{$address}',city='{$city}',country='{$country}',contact_number='{$contact_number}',
            name_on_card= '{$name_on_card}',card_number='{$card_number}',expiry_date='{$expiry_date}',cvv='{$cvv}',billing_address='{$billing_address}',account_type='{$account_type}',status='{$status}' where userId='{$user_id}'";

            mysqli_query($con, $query);

            header("Location: success.php");
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
                <a class="nav-link active  text-white" aria-current="page" href="#">Hotels</a>
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
    
    <div class="container-fluid">

        <div class="row justify-content-center">
            
            <div class="col-12">
                <h4 class="text-primary">Edit account details</h4>
                <div class="card mt-1 p-2 bg-light">
                    <div class="card-body"> 
                       <form method = "post">
                       <div class="row">
                            <div class="col-6">
                                <div class="mb-2">
                                <label for="exampleFormControlInput1" class="form-label">Create your username</label>

                                    <input type="text" class="form-control"  id = "username" name = "username"  placeholder="" value="<?php echo$users_data[0][1]?>">
                                </div>
                
                                <div class="mb-2">
                                <label for="exampleFormControlInput1" class="form-label">Create your password</label>

                                    <input type="password" class="form-control" id = "password" name = "password" placeholder="" value="<?php echo$users_data[0][2]?>">
                                </div>

                                <div class="mb-2">
                                        <label for="name" class="form-label">Enter your name</label>
                                        <input type="text" class="form-control" id = "name" name = "name" placeholder="" value="<?php echo$users_data[0][3]?>">
                                </div>
                            </div>

                            <div class="col-6">
                            <div class="mb-2">
                                    <label for="mailing_address" class="form-label">Mailing address</label>
                                    <textarea class="form-control" id = "address" name = "address" rows="2" ><?php echo$users_data[0][4]?></textarea>
                                </div>

                                <div class="mb-2">
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="username" class="form-label">City</label>
                                            <input type="text" class="form-control"  id = "city" name = "city"  placeholder="" value="<?php echo$users_data[0][5];?>">                                        </div>
                                        <div class="col-6">
                                            <label for="password" class="form-label">Country</label>
                                            <input type="text" class="form-control" id = "country" name = "country" placeholder="" value="<?php echo$users_data[0][6];?>">                                        </div>
                                    </div>     
                                </div>

                                <div class="mt-3">
                                    <input type="text" class="form-control" id = "contact_number" name = "contact_number" placeholder="Contact number" value="<?php echo$users_data[0][7];?>">
                                </div>
                            </div>

                       </div>
                </div>

</div>


</div>

                            

                            
                            <div id="sender" class="mt-2">
                                <button type="submit" class="btn btn-primary mb-2" id="button" >Confirm changes</button>
                            </div>
                        </form>
                    </div>

                  </div>
            </div>
        </div>
        
    </div>

    <!-- <div class="row justify-content-center ">
        <a href="products.php">
            <div class="card bg-light" style="width: 15rem;height: 10rem; ">
                <div class="card-body text-decoration-none">
                    <h1 class="card-text mt-10 display-4 fs-3 text-center">Products</p>
                </div>
            </div>
        </a>
    </div> -->

   

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
  </body>
</html>