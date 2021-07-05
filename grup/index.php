<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
require '../data/conn.php';
require '../data/fetch.php';

if($_SESSION['uid'] == null){
    header('location:../index.php');
}

$gid = mysqli_real_escape_string($conn,$_GET['gid']);
if(isset($_GET['gid'])){
    $checkGrup = ("SELECT * FROM dataGrup WHERE id = $gid");
    $checkGrupRun = mysqli_query($conn,$checkGrup);
    $rowsGrup = mysqli_fetch_assoc($checkGrupRun);
    $grupName = $rowsGrup['nama'];
}
require '../common/navbar.php';

if(isset($_POST['inputPesan'])){
    $timestamp = date("Y-m-d H:i:s");
    $text = $_POST['inputPesan'];
    $inputPesan = ("INSERT INTO chatGrup (id,gid,author_id,text,time) VALUE ('','$gid','$uid','$text','$timestamp')");
    mysqli_query($conn,$inputPesan);
}

if(isset($_POST['gsubmit'])){
    $ajak = $_POST['ftag'];
    
    $sqlgAdd = ("INSERT INTO userGrup (id,gid,uid) VALUE ('','$gid','$ajak')");
    if(mysqli_query($conn,$sqlgAdd)){
        echo '<script language="javascript">alert("successfully added user to the grup!")</script>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/materialize.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.css">
    <link rel="stylesheet" href="../fontawesome/css/all.min.css">
    <style>
        #chat-search .input-field .prefix{
          width:0rem !important;
        }
        #chat-search nav ul li:hover, nav ul li.active {
                background-color: none !important;
            }
        .input-field .prefix ~ input, .input-field .prefix ~ textarea, .input-field .prefix ~ label, .input-field .prefix ~ .validate ~ label, .input-field .prefix ~ .autocomplete-content{
            margin-left: 1rem !important;
            }
        .container{
            width: 65%!important;
            position: absolute;
            right: 200px;
            padding-bottom: 8rem;
        }
        .sidenav{
            background-color:#cbdbf4!important;
            border-right: 2px solid #aaa;
        }
        .sideUser{
            background-color:#cbdbf4!important;
        }
        .nav-wrapper{
            z-index: 99;
        }
        ul{
            height: 100%;
        }
        nav{
            height: 46px!important;
            line-height: 46px!important;
            width: 80%!important;
            position:absolute;
            right:0;
        }
        .prefix{
            top:0rem!important;
        }
        nav .nav-wrapper i{
            height: 46px!important;
            line-height: 46px!important;
        }
        .navbar-fixed{
            height:46px!important;
            z-index: 50!important;
        }
        a{
            text-decoration: none!important;
        }
        .dsadsa{
            right:200px!important;
            width: 65.5%;
        }
    </style>
    
    <script src="../js/materialize.js"></script>
    <script src="../js/jquery-3.3.1.min.js"></script>
</head>
<body style="background-color:#ededed;">
    
    <?php
    gnavbar($chatStartGname,$search,$dataGrup,$UserEnd);
    //sideGrup==============
    echo $startsideGroup;

    $fetchNotif = ("SELECT * FROM notifikasi WHERE `uid` = $uid");
    $notifRun = mysqli_query($conn,$fetchNotif);
    $fetchGrup = ("SELECT * FROM userGrup WHERE `uid` = $uid");
    $runGrup = mysqli_query($conn,$fetchGrup);
    
    //notif count
    mysqli_num_rows($notifRun);
    if(mysqli_num_rows($notifRun)>0){
        echo '<li><a href=""><div class="center"><i class="material-icons prefix">notification_important</i></div></a></li>';
    }else{
        echo'<li><a href=""><div class="center"><i class="material-icons prefix">notifications</i></div></a></li>';
    }

    echo $dividerSideGrup;

    //grup count
    if(mysqli_num_rows($runGrup)>0){
        while($grupInfoFetch = mysqli_fetch_assoc($runGrup)){
            $grupId = $grupInfoFetch['gid'];
            $dfgrup = mysqli_query($conn,"SELECT * FROM dataGrup WHERE id = $grupId");
            $gfetch = mysqli_fetch_assoc($dfgrup);
            $g = $gfetch['nama'];
            echo '
            <li class="margint20"><a href="?gid='.$grupId.'" class="center"><img class="circle sngp" src="../common/img/profile.jpeg" alt=""></a></li>';
        }
    }else{
        echo'';
    }

    echo $grupEnd;
    //sideUser=============== 
    echo $sideUserStart;

    $fetchTeman = ("SELECT * FROM teman WHERE author_id = $uid and u1 = 1 and u2 = 1 or reciver_id = $uid and u1 =1 and u2 = 1");
    $temanRun = mysqli_query($conn,$fetchTeman);
    if(mysqli_num_rows($temanRun)>0){
        while($temanRow = mysqli_fetch_assoc($temanRun)){
            if($temanRow['author_id'] == $uid){
                $fetchDataUserFoe = ("SELECT * FROM user WHERE id = '$temanRow[reciver_id]'");
                $fetchDataUserFoeRun = mysqli_query($conn,$fetchDataUserFoe);
                $fetchDataUserFoeRow = mysqli_fetch_assoc($fetchDataUserFoeRun);

                echo '
                    <li class="valign-wrapper truncate" style="height:42px;">
                    <a href="../home/?fuid='.$fetchDataUserFoeRow['id'].'">
                    <div class="userSideNavContainer">
                    <div class="userSideNavImg"><img class="circle snup" src="../common/img/profile.jpeg" alt=""></div>
                    <div class="userSideNavName truncate">'.$fetchDataUserFoeRow['username'].'</div>
                    </div>
                    </a>
                    </li>';
            }

            if($temanRow['reciver_id'] == $uid){
                $fetchDataUserFoe = ("SELECT * FROM user WHERE id = '$temanRow[author_id]'");
                $fetchDataUserFoeRun = mysqli_query($conn,$fetchDataUserFoe);
                $fetchDataUserFoeRow = mysqli_fetch_assoc($fetchDataUserFoeRun);

                echo '
                    <li class="valign-wrapper truncate" style="height:42px;">
                    <a href="../home/?fuid='.$fetchDataUserFoeRow['id'].'">
                    <div class="userSideNavContainer">
                    <div class="userSideNavImg"><img class="circle snup" src="../common/img/profile.jpeg" alt=""></div>
                    <div class="userSideNavName truncate">'.$fetchDataUserFoeRow['username'].'</div>
                    </div>
                    </a>
                    </li>';
            }
        }
    }
    echo $sideUserEnd;
    ?>
    <!--=======================||  user list ||=====================-->
    <div class="grupUserCozy">
    <ul>
    <?php
    $fetchGuid = ("SELECT * FROM userGrup WHERE gid = $gid");
    $fgidRun = mysqli_query($conn,$fetchGuid);

    if(mysqli_num_rows($fgidRun)>0){
        while($fguid = mysqli_fetch_assoc($fgidRun)){
            $FguidUserId = $fguid['uid'];
            $sqlFguid = ("SELECT * FROM user WHERE id = $FguidUserId");
            $runFguid = mysqli_query($conn,$sqlFguid);
            $fetchFguid = mysqli_fetch_assoc($runFguid);

            echo '
            <a href="../home/?fuid='.$fetchFguid['id'].'">
            <li class="valign-wrapper truncate">
            <div class="userSideNavContainer">
            <div class="userSideNavImg"><img class="circle snup" src="../common/img/profile.jpeg" alt=""></div>
            <div class="userSideNavName truncate">'.$fetchFguid['username'].'</div>
            </div>
            </li>
            </a>        
            ';
        }
    }
    
    ?>
    </ul>
    </div>

    <!--======================||  chat box  ||=====================-->
    <div class="container">
        <div class="spacer">
            <?php
            if($gid != null){
                if($gid != "me"){
                    $fetchChat = ("SELECT * FROM chatGrup WHERE gid = $gid ORDER BY `time` DESC");
                    $chatRun = mysqli_query($conn, $fetchChat);
                    
                    if(mysqli_num_rows($chatRun) > 0){
                        while($chatRow = mysqli_fetch_assoc($chatRun)){
                            
                            $fetchFoeProfile = ("SELECT * FROM user WHERE id = $chatRow[author_id]");
                            $foeUserRun = mysqli_query($conn,$fetchFoeProfile);
                            $foeUserRow = mysqli_fetch_assoc($foeUserRun);
                                echo '
                                <div class="chatWrapper">
                                <div class="scrollerFlex">
                                <div class="containerCozy">
                                <div class="messageCozy">
                                <div class="headerCozy">
                                <div class="avatarWrapper">
                                <img src="../common/img/profile.jpeg" class="circle chatUserProfile">
                                </div>
                                <div class="headerCozyName">'.$foeUserRow['username'].'</div>
                                <time class="timestampCozy">'.$chatRow['time'].'</time>
                                </div>
                                <div class="containerChatCozy">
                                <div class="contentCozy">
                                '.$chatRow['text'].'
                                </div>
                                </div>
                                </div>
                                </div>
                                </div>
                                </div>
                                <div class="divider"></div>
                                ';
                            }
                        }else{
                            echo '
                            <div>jadilah orang pertama yang mengirim pesan!</div>
                            ';
                        }
                    }
                }else{
                    if($gid == null){
                        echo "
                        <div style='margin-top:50px;' class='col s12 center-align'>
                        <a href='../profile/'><div class='col s12 center-align margin7 divBox'>Profile</div></a>
                        <a href='../forum/'><div class='col s12 center-align margin7 divBox'>Forum</div></a>
                        <a href='../logout/'><div class='col s12 center-align margin7 divBox'>Logout</div></a>
                        </div>
                        ";
                    }
                }
            
            ?>
        </div>
    </div>
    <?php
    if($gid != null){
        echo '
        <div class="dsadsa">
        <form action="" method="post" class="formContainer">
        <div class="inputContainer">
        <div class="cozyTextArea">
        <div class="innerChatArea" id="innerChatArea">
        <input type="textarea" maxlength="400" name="inputPesan" id="inputPesan" tabindex="1" class="actualTextArea" rows="1" style="height:auto"></textarea>
        </div>
        </div>
        </div>
        </form>
        </div>
        ';
    }else{}
    
    ?>
            </div>
        </div>
    </form>
    </div>
<!----------------add user modal---------------->
<div id="modalContainer" class="friendReqContainer">
    <div id="" class="z-depth-1 addFriendModal">
    <form action="" method="post">
    <ul>
    <li class="gheader">Add Member by their id tag</li>
    <li><input type="text" name="ftag"></li>
    <li><input type="submit" class="btn btn-small" name="gsubmit" value="Add user"><div onclick="cmodal()" class="btn btn-small waves-effect waves-light red">cancel</div></li>
    </ul>
    </form>
    </div>
</div>

<script>
    var fRequestModal = document.getElementById("modalContainer");
    function gadd(){
        fRequestModal.style.display = 'block';
    }
    function cmodal(){
        fRequestModal.style.display = 'none'
    }
    window.addEventListener('click',function(event){
        if(event.target == fRequestModal){
            fRequestModal.style.display = 'none';
        }
    })
</script>
</body>
</html>
<?php mysqli_close($conn);?>