<?php
session_start();

$from = $_GET["from"];
$count = $_GET["count"];
$erg = $count;

if(!isset($_SESSION["admin"]) || $_SESSION["admin"] == false){
    exit;
}


$db = new PDO("sqlite:../sql/webprogrammierung.db");
if($from == "1"){
    $db->beginTransaction();

    $sql = "SELECT count(*) FROM articles WHERE status = 'false';";
    $erg = $db->query($sql)->fetchColumn();
        
    $db->commit();
}else if($from == "2"){
    $db->beginTransaction();

    $sql = "SELECT count(*) FROM articles WHERE status = 'true';";
    $erg = $db->query($sql)->fetchColumn();
        
    $db->commit();
}else if($from == "3"){
    $db->beginTransaction();

    $sql = $db->prepare("SELECT count(*) FROM users WHERE username != :username;");
    $sql->execute([':username' => $_SESSION["usrName"]]);
    $erg = $sql->fetchColumn();

    $db->commit();
}

if($erg != $count){
    echo "updateRequired"; //für ajax
}