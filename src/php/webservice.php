<?php

$server = new SoapServer(null, ['uri' => "http://localhost/php/webservice.php"]);

function getEntries($year, $monthAsNumber){
	$db = new PDO("sqlite:../sql/webprogrammierung.db");
	$db->beginTransaction();
	$sql = "SELECT name, abstract, webpath, trim(title || ' ' || firstname || ' ' || lastname) as author FROM articles " . 
			"LEFT JOIN users ON articles.userID = users.id WHERE status = 'true' AND date LIKE '$year-%$monthAsNumber-%' ORDER BY datetime(date)";
	$result = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
	$db->commit();
	return $result;
}

function getRecentEntries($count)
{
    $db = new PDO("sqlite:../sql/webprogrammierung.db");
    $db->beginTransaction();
    $currYear = date("Y");
    $sql = "SELECT name, abstract, webpath, trim(title || ' ' || firstname || ' ' || lastname) as author FROM articles " .
        "LEFT JOIN users ON articles.userID = users.id WHERE status = 'true' ORDER BY datetime(date) LIMIT $count";
    $result = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    $db->commit();
    return $result;
}

$server->addFunction("getEntries");
$server->addFunction("getRecentEntries");
$server->handle();