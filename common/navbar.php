<?php
require '../data/conn.php';
require '../data/fetch.php';

$logo = '
    <nav>
    <div class="nav-wrapper">
    <a href="">
        <img src="" class="brand-logo" alt="" style="height: 100%;padding: 5px;"/>
    </a>
    <a class="nameHeader font-logo" style="margin-left:50px;">Neutrino</a>
    <ul id="nav-mobile" class="right hide-on-med-and-down">
';
$start = '
    <nav>
    <div class="nav-wrapper">
    <ul id="nav-mobile" class="right hide-on-med-and-down">
';
$chatStartUname = '
<div class="navbar-fixed">
<nav class="light-blue lighten-3">
<div class="nav-wrapper">
<a href="" class="brand-logo">'.@$grupUname.'</a>
<ul id="nav-mobile" class="right hide-on-med-and-down green-text">
';
$chatStartGname = '
<div class="navbar-fixed">
<nav class="light-blue lighten-3">
<div class="nav-wrapper">
<a href="" class="brand-logo">'.@$grupName.'</a>
<ul id="nav-mobile" class="right hide-on-med-and-down green-text">
';
$dataUser = '
<li onclick="mgrup()"><a href="#"><i class="material-icons prefix">receipt</i></a></li>
<li><a href="../profile/"><i class="material-icons prefix">account_circle</i></a></li>
<li onclick="fReq()"><a href="#"><i class="material-icons prefix">person_add</i></a></li>
<li><a href="../logout/"><i class="material-icons prefix">power_settings_new</i></a></li>
';
$dataGrup = '
<li><a href="../profile/"><i class="material-icons prefix">account_circle</i></a></li>
<li onclick="gadd()"><a href="#"><i class="material-icons prefix">group_add</i></a></li>
<li><a href="../logout/"><i class="material-icons prefix">power_settings_new</i></a></li>
';
$search='
<li>    
 <div class="center row">
    <div class="col s12">
        <div class="row" id="chat-search">
            <div class="input-field col s6 s12">
                <i class="white-text material-icons prefix">search</i>
                <input type="text" placeholder="search" class="white-text" >
            </div>
        </div>
    </div>
</div>          
</li>     
';
$user= '
    <li><a href="">'.
    @$username
    .'</a></li>
';
$login= '
    <li><a href="../login/">login</a></li>
    <li><a href="../register/">register</a></li>
';
$logout= '
    <li><a href="../logout/">logout</a></li>
';
$git= '
    <li><i class="fa fa-cogs"></i></li>
';
$end = '
    </ul>
    </div>
    </nav>
';

$UserEnd='
    </ul>
    </div>
    </nav>
    </div>
';
//-----------------navbar show grup--------------------------------
$startsideGroup='
<ul class="sidenav sidenav-fixed sideGroup">
<li><a href="../home/?fuid=me"><div class="center"><i class="material-icons prefix">home</i></div></a></li>';
$dividerSideGrup='<li><div class="divider indigo darken-4"></div></li>';
$grupEnd='</ul>';
//---------------navbar show user---------------------------------
$sideUserStart='
<ul class="sideUser">
    <li><div><input type="text" name="searchUser" id="searchUser"></div></li>';
$sideUserEnd = '</ul>';
//----------------------------------------------------------------
$sidenavProfile = '
    <ul class="sidenav sidenav-fixed tpadd-5">
        <li class="lpadd-30"><a class="subheader">User Settings</a></li>
        <li class="lpadd-40 rpadd-10"><a onclick="openProfile()" class="waves-effect">My Account</a></li>
        <li class="lpadd-40 rpadd-10"><a onclick="openApperance()" class="waves-effect">Apperance</a></li>
        <li class="lpadd-40 rpadd-10"><a href="../logout/">Logout</a></li>
    </ul>
';

$headerForum = '
    <ul>
';

function navbar_start_page($logo,$login,$end){
    echo $logo;
    echo $login;
    echo $end;
}

function navbar($chatStartUname,$search,$dataUser,$UserEnd){
    echo $chatStartUname;
    echo $search;
    echo $dataUser;
    echo $UserEnd;
}

function gnavbar($chatStartGname,$search,$dataGrup,$UserEnd){
    echo $chatStartGname;
    echo $search;
    echo $dataGrup;
    echo $UserEnd;
}

function sidegrup(){
    
}

function sideuser(){

}
?>