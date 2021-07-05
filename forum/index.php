<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
require '../data/conn.php';
require '../data/fetch.php';

if(@$_SESSION['uid'] !=null){
    $fetch = "SELECT * FROM user WHERE id='$_SESSION[uid]'";
    $fetchRun = mysqli_query($conn,$fetch);
    $rows = mysqli_fetch_assoc($fetchRun);
}else{
    header('location:../index.php');
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
        .container{
            width:85%;
            margin: 120px 20px 0 0!important;
            position: absolute;
            right: 0;
        }
        a{
            text-decoration: none!important;
        }
    </style>
</head>
<body>
    <div class="container" style="border:1px solid grey!important;">
        <div class="forum-main-body">
            <div class="row">
                <div class="col s12">
                    <div class="col s12 marginb-header-forum">
                        <div class="col s8">Recent Question</div>
                        <div class="col s2">
                            <a href="../ask"><div class="btn btn-small">Ask Question</div></a>
                        </div>
                        <div class="col s2">
                            <a href="../home/?fuid=me"><div class="btn btn-small">Back</div></a>
                        </div>
                    </div>
                    <div class="col s12">
                        <div class="divider"></div>
                    </div>
        <?php
            $question = ("SELECT * FROM dataForum ORDER BY waktu DESC");
            $run = mysqli_query($conn,$question);
            
            if(mysqli_num_rows($run)>0){
                while($fetch = mysqli_fetch_assoc($run)){

                    $ufquery = ("SELECT * FROM user WHERE id = $fetch[author_id] ORDER BY waktu DESC");
                    $ufrun =  mysqli_query($conn,$ufquery);
                    $fetchDataUser = mysqli_fetch_assoc($ufrun);

                    echo '
                        <a href="../question/?qid='.$fetch['id'].'">
                        <div class="col s12 tabel-pertanyaan">
                        <div class="col s1">
                        <div class="col s12">'.$fetch['poin'].'</div>
                        <div class="col s12">poin</div>
                        </div>
                        <div class="col s11">'.$fetch['namaForum'].'</div>
                        <div class="col s11 right-align">'.$fetchDataUser['username'].'#'.$fetchDataUser['waktu'].'</div>
                        </div>
                        <div class="col s12">
                        <div class="divider"></div>
                        </div>
                    ';
                }
            }
        ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>