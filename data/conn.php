<?php

$conn = mysqli_connect("localhost","root","","TA");

if (mysqli_connect_errno()){
    echo "DATABASE ERROR HUEHEHEHE : " . mysqli_connect_error();
}
@session_start();
?>