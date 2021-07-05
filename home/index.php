<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
require '../data/conn.php';
require '../data/fetch.php';
require 'gear.php';
require '../common/navbar.php';

if($_SESSION['uid'] == null){
    header('location:../index.php');
}

if(isset($_POST['inputPesan'])){
    $timestamp = date("Y-m-d H:i:s");
    $text = $_POST['inputPesan'];
    $inputPesan = ("INSERT INTO chat (id,author_id,reciver_id,text,attachment,time) VALUE ('','$uid','$foeid','$text','','$timestamp')");
    mysqli_query($conn,$inputPesan);
}

if(isset($_POST['fsubmit'])){
    $author_id = $x['id'];
    $reciver_id = $_POST['ftag'];
    $sqlfreq = ("INSERT INTO teman (id,author_id,reciver_id,u1,u2) VALUE ('','$author_id','$reciver_id','1','')");
    $sendFNotice = ("INSERT INTO notifikasi (`id`,`uid`,`freq`,`author_id`,`status`,`notif`) VALUE ('','$reciver_id','1','$uid','You have new friend request!','1')");
    if(mysqli_query($conn,$sqlfreq)){
        mysqli_query($conn,$sendFNotice);
        echo '<script language="javascript">alert("successfully sent a friend request")</script>';
    }else{
        echo'<script language="javascript">alert("task failed")</script>';
    }
}

if(isset($_POST['gNew'])){
    if($_POST['makeNewGrup'] != null){
    $nameG = $_POST['makeNewGrup'];
    $mgsql = ("INSERT INTO dataGrup (id,nama,pic,author_id) VALUE ('','$nameG','','$uid')");
    $success = mysqli_query($conn,$mgsql);
    $selUser = ("SELECT * FROM dataGrup WHERE nama = '$nameG' AND author_id = $uid");
    $selURun = mysqli_query($conn,$selUser);
    $fetUG = mysqli_fetch_assoc($selURun);
    $qwerty = $fetUG['id'];
    $uinput = ("INSERT INTO userGrup (id,gid,uid) VALUE ('','$qwerty','$uid')");
    if(mysqli_query($conn,$uinput)){
        echo'<script language="javascript">alert("managed to create a new group")</script>';
    }else{
        echo'<script language="javascript">alert("task failed")</script>';
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
            width: 80%!important;
            position: absolute;
            right: 0;
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
    </style>
    
    <script src="../js/materialize.js"></script>
    <script src="../js/jquery-3.3.1.min.js"></script>
</head>
<body  style="background-color:#ededed;">
    
    <?php
    navbar($chatStartUname,$search,$dataUser,$UserEnd);
    //sideGrup==============
    echo $startsideGroup;

    $fetchNotif = ("SELECT * FROM notifikasi WHERE `uid` = $uid");
    $notifRun = mysqli_query($conn,$fetchNotif);
    
    //notif count
    mysqli_num_rows($notifRun);
    if(mysqli_num_rows($notifRun)>0){
        echo '<li><a href="../notifikasi/"><div class="center"><i class="material-icons prefix">notification_important</i></div></a></li>';
    }else{
        echo'<li><a href="../notifikasi/"><div class="center"><i class="material-icons prefix">notifications</i></div></a></li>';
    }

    echo $dividerSideGrup;

    //grup count
    $fetchGrup = ("SELECT * FROM userGrup WHERE `uid` = $uid");
    $runGrup = mysqli_query($conn,$fetchGrup);
    if(mysqli_num_rows($runGrup)>0){
        while($grupInfoFetch = mysqli_fetch_assoc($runGrup)){
            $grupId = $grupInfoFetch['gid'];
            $dfgrup = mysqli_query($conn,"SELECT * FROM dataGrup WHERE id = $grupId");
            $gfetch = mysqli_fetch_assoc($dfgrup);
            $g = $gfetch['nama'];
            echo '
            <li class="margint20"><a href="../grup/?gid='.$grupId.'" class="center"><img class="circle sngp" src="../common/img/profile.jpeg" alt=""></a></li>';
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
                    <a href="?fuid='.$fetchDataUserFoeRow['id'].'">
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
                    <a href="?fuid='.$fetchDataUserFoeRow['id'].'">
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
    //=======================|| chat box ||======================
    ?>
    <div class="container">
        <div class="spacer">
            <?php
            if($foeid != "me"){
                if(@$foeid != "me"){
                    $fetchChat = ("SELECT * FROM chat WHERE author_id = $uid AND reciver_id = $foeid or author_id=$foeid AND reciver_id=$uid ORDER BY `time` DESC");
                    $chatRun = mysqli_query($conn, $fetchChat);

                    $fetchFoeProfile = ("SELECT * FROM user WHERE id = $foeid");
                    $foeUserRun = mysqli_query($conn,$fetchFoeProfile);
                    $foeUserRow = mysqli_fetch_assoc($foeUserRun);

                    
                    if(mysqli_num_rows($chatRun) > 0){
                        while($chatRow = mysqli_fetch_assoc($chatRun)){
                            if($chatRow['author_id'] == $foeid){
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
                            }else{
                                echo '
                                <div class="chatWrapper">
                                <div class="scrollerFlex">
                                <div class="containerCozy">
                                <div class="messageCozy">
                                <div class="headerCozy">
                                <div class="avatarWrapper">
                                <img src="../common/img/profile.jpeg" class="circle chatUserProfile">
                                </div>
                                <div class="headerCozyName">'.$x['username'].'</div>
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
                        }
                    }else{
                        echo '
                        <div>mulai konfersasi dengan orang ini</div>
                        ';
                    }
                }
            }else{
                if($foeid == "me"){
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
    if($foeid != "me"){
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
<!----------------add friend modal---------------->

<div id="modalContainer" class="friendReqContainer">
    <div id="" class="z-depth-1 addFriendModal">
    <form action="" method="post">
    <ul>
    <li class="gheader">Add Friend with their idTag</li>
    <li><input type="text" name="ftag"></li>
    <li><input type="   " class="btn btn-small" name="fsubmit" value="Send Friend Request"><div onclick="cmodal()" class="btn btn-small waves-effect waves-light red">cancel</div></li>
    </ul>
    </form>
    </div>
</div>
<!---------------make new geup-------------------->
<div id="mgContainer" class="friendReqContainer">
    <div class="z-depth-1 addFriendModal">
    <form action="" method="post">
        <ul>
            <li class="gheader">Make new grup</li>
            <li><input type="text" name="makeNewGrup" id=""></li>
            <li><input type="submit" class="btn btn-small" value="Submit" name="gNew"><div onclick="closeMng()" class="btn btn-small waves-effect waves-light red">Cancel</div></li>
        </ul>
    </form>
</div>
</div>
<!----------------ifarame------------>
<div class="notifContainer" id="notifContainer">
<iframe class="notif" src="../notifikasi/">
</iframe>
</div>

<script>
    var fRequestModal = document.getElementById("modalContainer");
    var makeGrup = document.getElementById("mgContainer");
    var notifModal = document.getElementById("notifContainer");
    function fReq(){
        fRequestModal.style.display = 'block';
    }
    function mgrup(){
        makeGrup.style.display = 'block';
    }
    function cmodal(){
        fRequestModal.style.display = 'none'
    }
    function closeMng(){
        makeGrup.style.display = 'none';
    }
    function tampilNotif(){
        notifModal.style.display = 'block';
    }
    window.addEventListener('click',function(event){
        if(event.target == fRequestModal){
            fRequestModal.style.display = 'none';
        }
    })
    window.addEventListener('click',function(event){
        if(event.target == makeGrup){
            makeGrup.style.display= 'none';
        }
    })
    window.addEventListener('click',function(event){
        if(event.target == notifModal){
            notifModal.style.display = 'none';
        }
    })
</script>
</body>
</html>
<?php mysqli_close($conn);?>