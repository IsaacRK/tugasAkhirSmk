<?php
date_default_timezone_set('Asia/Jakarta');
require '../data/conn.php';
require '../data/fetch.php';
$time = date("Y-m-d H:i:s");
if(@$_SESSION['uid'] !=null){
    $fetch = "SELECT * FROM user WHERE id='$_SESSION[uid]'";
    $fetchRun = mysqli_query($conn,$fetch);
    $rows = mysqli_fetch_assoc($fetchRun);
}else{
    header('location:../index.php');
}
if(isset($_POST['submit'])){
    $time = date("Y-m-d H:i:s");
    $header = $_POST['judul'];
    $ask = $_POST['ask'];
    $queryInput = ("INSERT INTO dataForum (id,namaForum,author_id,body,poin,waktu) VALUE ('','$header','$uid','$ask','0','$time')");
    if(mysqli_query($conn,$queryInput)){
        echo '<div style="width:100%;background-color:green;color:white;text-align:center;"><b>Your Question has sucessfully posted!</b></div>';
    }else{
        echo '<div style="width:100%;background-color:red;color:white;text-align:center;"><b>Input Data Failed!, Try again later.</b></div>';
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/materialize.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.css">
    <link rel="stylesheet" href="../fontawesome/css/all.min.css">
    <style>
        .box-line{
            border:1px solid rgba(0,0,0,.4)!important;
            padding: 5px!important;
            width: 100%!important;
        }
    </style>
</head>
<body style="background-color:#ededed;">
    <div class="container row">
    <div class="formAsk">
    <form action="" method="post">
        <div class="gheader col s12">Title</div>
        <input type="textbox"  class="box-line col s12" placeholder="judul" name="judul">
        <div class="gheader col s12">Body</div>
        <textarea class="inputBody col s12" name="ask" wrap=""></textarea>
        <div><input type="submit" class="btn btn-small" name="submit" value="Post">
    </form>
    <a href="../forum/"><div class="btn btn-small">Back</div></a></div>
    </div>
    </div>
</body>
</html>