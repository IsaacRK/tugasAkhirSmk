<?php
if($_SESSION!=null){
$idFetch = "SELECT * FROM user WHERE id='$_SESSION[uid]'";
$idRun = mysqli_query($conn,$idFetch);
$idRows = mysqli_fetch_assoc($idRun);
$uid = $idRows['id'];
$usernameFetch = "SELECT * FROM user WHERE id = '$uid'";
$usernameFetchRun = mysqli_query($conn, $usernameFetch);
$x = mysqli_fetch_assoc($usernameFetchRun);
$username = $x['username'];
}
?>