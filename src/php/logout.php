<?php
session_start();
//einige session variablen sollen nicht gelöscht werden
$tmp1 = $_SESSION["registerCountDay"];
$tmp2 = $_SESSION["registerCountDay"];
$tmp3 = $_SESSION["beitragCountDay"];
$tmp4 = $_SESSION["beitragCount"];
session_unset();

$_SESSION["registerCountDay"] = $tmp1;
$_SESSION["registerCountDay"] = $tmp2;
$_SESSION["beitragCountDay"] = $tmp3;
$_SESSION["beitragCount"] = $tmp4;

/*
$_SESSION["loggedIn"] = false;
$_SESSION["usrName"] = "";
$_SESSION["admin"] = false;*/

header("Location: http://" . $_SERVER["SERVER_NAME"]);
