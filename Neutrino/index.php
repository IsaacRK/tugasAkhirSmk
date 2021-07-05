<?php
@session_start();
date_default_timezone_set('Asia/Jakarta');
require '../data/conn.php';
require '../common/navbar.php';

if(@$_SESSION['uid'] != null){
    header('location:../home/?fuid=me');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/materialize.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.css">
    <link rel="stylesheet" href="../fontawesome/css/all.min.css">
    <style>
    .divider{
        background-color: rgba(0,0,0,.7)!important;
    }
    </style>
</head>
<body>
    <?php
    navbar_start_page($logo,$login,$end);
    ?>
    <div class="container">
        <div class="container tpadd-20">
            <h1 class="bold font-logo right-align">Neutrino</h1>
            <div class="divider"></div>
            <p class="index-paragraph right-align"></p>
        </div>
    </div>
</body>
</html>