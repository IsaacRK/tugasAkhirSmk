<?php
date_default_timezone_set('Asia/Jakarta');
require '../data/conn.php';

if(isset($_POST['login'])){
    $user = $_POST['username'];
    $pass = $_POST['pass'];

    if(empty($user)){('username kosong');}
    if(empty($pass)){('password kosong');}

    if(!empty($user . $pass)){
        $query = ("SELECT * FROM user WHERE username='$user' AND pass='$pass' LIMIT 1");
        $run = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($run);
        if($row > 0){
            session_start();
            $_SESSION['uid'] = $row['id'];
            header('location:../home/?fuid=me');
        }else{
            echo 'coba lagi';
        } 
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/materialize.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.css">
    <link rel="stylesheet" href="../fontawesome/css/all.min.css">
</head>
<body>
    <div class="container">
    <div class="card-panel cyan lighten-4 container-login-regis margint-10">
    <form action="" method="post">
        <h4>Login</h4>
        <ul>
            <li>
                <span>Username</span>
                <input type="text" name="username" id="" placeholder="username"/>
            </li>
            <li>
                <span>Password</span>
                <input type="password" name="pass" id="" placeholder="password"/>
            </li>
            <li>
                <input class="button btn-small" type="submit" name="login" value="login"/>
            </li>
        </ul>
        <span>doesn't have an account? <a href="../register">Register</a></span>
        
    </form>
    </div>
    </div>
</body>
</html>