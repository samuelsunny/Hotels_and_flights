<?php
session_start();

    include("connection.php");
    include("functions.php");
    

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        // print_r($_POST);
        // user details
        $user_name     = $_POST['username'];
        $password      = $_POST['password'];
        $password      = md5($password);
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
            $query = "insert into users (username,password,name,address,city,country,contact_number,
            name_on_card,card_number,expiry_date,cvv,billing_address,account_type,status) values ('$user_name','$password','$name','$address','$city','$country','$contact_number',
            '$name_on_card','$card_number','$expiry_date','$cvv','$billing_address','$account_type','$status')";

            mysqli_query($con, $query);

            header("Location: login.php");
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
    <title>Register user</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    
    
  </head>
  <body>
    <div class="container-fluid">

        <div class="row justify-content-center">
            
            <div class="col-12">
                <h2 class="text-primary">Account details</h2>
                <div class="card mt-1 p-2 bg-light">
                    <div class="card-body"> 
                       <form method = "post">
                       <div class="row">
                            <div class="col-6">
                                <div class="mb-2">
                                <label for="exampleFormControlInput1" class="form-label">Create your username</label>

                                    <input type="text" class="form-control"  id = "username" name = "username"  placeholder="">
                                </div>
                
                                <div class="mb-2">
                                <label for="exampleFormControlInput1" class="form-label">Create your password</label>

                                    <input type="password" class="form-control" id = "password" name = "password" placeholder="">
                                </div>

                                <div class="mb-2">
                                        <label for="name" class="form-label">Enter your name</label>
                                        <input type="text" class="form-control" id = "name" name = "name" placeholder="">
                                </div>
                            </div>

                            <div class="col-6">
                            <div class="mb-2">
                                    <label for="mailing_address" class="form-label">Enter your mailing address</label>
                                    <textarea class="form-control" id = "address" name = "address" rows="2"></textarea>
                                </div>

                                <div class="mb-2">
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="username" class="form-label">City</label>
                                            <input type="text" class="form-control"  id = "city" name = "city"  placeholder="">                                        </div>
                                        <div class="col-6">
                                            <label for="password" class="form-label">Country</label>
                                            <input type="text" class="form-control" id = "country" name = "country" placeholder="">                                        </div>
                                    </div>     
                                </div>

                                <div class="mt-3">
                                    <input type="text" class="form-control" id = "contact_number" name = "contact_number" placeholder="Contact number">
                                </div>
                            </div>

                       </div>
                </div>

</div>

        <div class="row justify-content-center">
            
            <div class="col-12">
            <h2 class="text-primary">Payment information</h2>

                <div class="card mt-1 p-2 bg-light">
                    <div class="card-body"> 
                       
                       <div class="row">
                            <div class="col-6">
                            <div class="mb-4">
                                <input type="text" class="form-control"  id = "name_on_card" name = "name_on_card"  placeholder="Enter the name on the card">
                            </div>
            
                            <div class="mb-4">
                                <input type="text" class="form-control" id = "card_number" name = "card_number" placeholder="Enter the card number">
                            </div>

                            <div class="mb-4">          
                                <div class="row">
                                    <div class="col-6">
                                        <input type="text" class="form-control" id = "expiry_date" name = "expiry_date" placeholder="Card expiry date (MM/YY)">
                                    </div>
                                    <div class="col-6">
                                        <input type="password" class="form-control" id = "cvv" name = "cvv" placeholder="CVV">
                                    </div>
                                </div>
                            </div>
                            </div>

                            <div class="col-6">
                                    <label for="billing_address" class="form-label">Billing address</label>
                                    <textarea class="form-control" id = "billing_address" name = "billing_address" rows="5" placeholder=""></textarea>
                            </div>
                       </div>
                </div>

</div>

                            

                            
                            <div id="sender" class="mt-2">
                                <button type="submit" class="btn btn-primary mb-2" id="button" onclick="reviewInfo()">Create account</button>
                            </div>
                        </form>
                    </div>

                  </div>
            </div>
        </div>
        
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
  </body>
</html>
