<?php

//return: assoc array mit allen nutzern
function queryAllUsers()
{
    session_start();
    $db = new PDO("sqlite:" . $_SERVER['DOCUMENT_ROOT'] . "/sql/webprogrammierung.db");


    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $ergebnis = null;

    try {
        $db->beginTransaction();

        $sql = $db->prepare("SELECT * FROM users WHERE username != :username");
        $sql->execute([':username' => $_SESSION["usrName"]]);
        $ergebnis = $sql->fetchAll();

        $db->commit();
    } catch (PDOException $e) {
        return null;
    }
    return $ergebnis;
}

function printBeitraege()
{
	if(session_status() != 2)
    	session_start();
    $db = new PDO("sqlite:" . $_SERVER['DOCUMENT_ROOT'] . "/sql/webprogrammierung.db");


    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    try {
        $db->beginTransaction();
        $sql = $db->prepare("SELECT name, webpath, date FROM articles " .
            "JOIN users ON articles.userID = users.id WHERE username = :userName ORDER BY datetime(date) Desc");
        $sql->execute([':userName' => $_SESSION["usrName"]]);
        $array = $sql->fetchAll();

        $db->commit();

        try {
			echo "<ul class='beitragList'>";
            foreach ($array as $i) {
                echo "<li><a href='/" . $i["webpath"] . "'>";
                echo $i["name"] . " | " . $i["date"];
				echo "</a></li>";
			}
			echo "</ul>";

        } catch (PDOException $e) {
            echo "<div><p>Konnte keine Beiträge finden</p></div>";
        }
    } catch (PDOException $e) {
        echo "shit";
    }
}
