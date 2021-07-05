<?php
//format ?name=value

@$foeid = mysqli_real_escape_string($conn,$_GET['fuid']);

$grupUname = '';
if(@$foeid == 'me'){
    $grupUname = "Home";
}

if(@$grupUname == "Home"){
    $showChat = "
    
    ";
}

if(@$foeid != "me"){
    $checkFoeUser = ("SELECT * FROM user WHERE id = $foeid");
    $checkFoeUserRun = mysqli_query($conn,$checkFoeUser);
    $rowsFoeUser = mysqli_fetch_assoc($checkFoeUserRun);
    $grupUname = $rowsFoeUser['username'];
}
?>