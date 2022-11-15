<?php

$dbhost = 'localhost';
$dbuser = 'root';
$dbpassword = '';
$dbname = 'hotels_and_flights';

if(!$con = mysqli_connect(
    $dbhost,$dbuser,$dbpassword,$dbname
))
{
    die("Failed to connect to the server");
}