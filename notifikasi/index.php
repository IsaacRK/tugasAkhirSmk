<html>
    <head>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/materialize.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.css">
    <link rel="stylesheet" href="../fontawesome/css/all.min.css">
    </head>
    <body>
<?php
 require '../data/conn.php';
 require '../data/fetch.php';
 
 if(isset($_POST['submit'])){
     if($_POST['yn'] == 'yes'){
        $nid = $_POST['var'];
        $select = ("SELECT * FROM notifikasi WHERE id = $nid");
        $run = mysqli_query($conn,$select);
        $fetch = mysqli_fetch_assoc($run);

        $sf = ("UPDATE teman SET u2 = 1 WHERE author_id = $fetch[author_id] AND reciver_id = $uid");
        $rn = mysqli_query($conn,$sf);

        $snf = ("UPDATE notifikasi SET notif = 0 WHERE id = $nid");
        $srn = mysqli_query($conn,$snf);
     }elseif($_POST['yn'] == 'no'){
        $nid = $_POST['var'];
        $select = ("SELECT * FROM notifikasi WHERE id = $nid");
        $run = mysqli_query($conn,$select);
        $fetch = mysqli_fetch_assoc($run);

        $sf = ("UPDATE teman SET u2 = 1 WHERE author_id = $fetch[author_id] AND reciver_id = $uid");
        $rn = mysqli_query($conn,$sf);

        $snf = ("UPDATE notifikasi SET notif = 0 WHERE id = $nid");
        $srn = mysqli_query($conn,$snf);
     }
 }
echo '<div class="container">';
 $sqlFetchNotif = ("SELECT * FROM notifikasi WHERE uid = $uid AND notif = 1");
 $runFetchNotif = mysqli_query($conn,$sqlFetchNotif);
 if(mysqli_num_rows($runFetchNotif)>0){
     while($f = mysqli_fetch_assoc($runFetchNotif)){

         $sqlfu = ("SELECT * FROM user WHERE id = '$f[author_id]'");
         $sqlrunn = mysqli_query($conn,$sqlfu);
         $fetch = mysqli_fetch_assoc($sqlrunn);
         echo '
         <div style="width:100%">
         <div stye="80%">
            '.$f['status'].'
        </div>
        <div style="20%">
            from '.$fetch['username'].'
        </div>
        <div style="width:100%">
        <form action="" method="post">
        <input display="none" type="hidden" name="var" value="'.$f['id'].'">
        <label><input name="yn" type="radio" value="yes"/><span>yes</span></label>
        <label><input name="yn" type="radio" value="no"/><span>no</span></label>
        <input type="submit" name="submit" value="submit" class="btn btn-small">
        </form>
        </div>
         </div>
         ';
     }
 }else{
     echo 'anda tida memiliki notifikasi apapun';
 }
echo '
</div>
<div class="btn btn-small"><a style="color:white;text_decoration:none;" href="../home/?fuid=me">Back</a></div>
';
?>
</body>
</html>