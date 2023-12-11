<?php
session_start();

require 'genBeitragHTML.php';

$beitragTitel = htmlspecialchars($_POST["beitragTitel"]);
$beitragAbstract = htmlspecialchars($_POST["beitragAbstract"]);
$kategorie = htmlspecialchars($_POST["kategorieWahl"]);
$file = $_FILES["beitragPDF"];
$nutzerID = 0;
$beitragID = 0;
$nutzerVorname = "";
$nutzerNachname = "";
$nutzerTitel = "";

$target_dir = "../journals/artikel/"; //nur für pdf dateien
$uuid = uniqid();
$target_file = $target_dir . $uuid . ".pdf";
$dbfile = "journals/artikel/" . $uuid . ".pdf";
$dbhtml = "journals/beitrag" . $uuid . ".html";
$uploadOk = 1;
$pdfFileType = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION)); //datei typ

if (!isset($_SESSION["beitragCountDay"])) {
    $_SESSION["beitragCountDay"] = date("d"); //nur tag
    $_SESSION["beitragCount"] = 0;
} else if ($_SESSION["beitragCountDay"] != date("d")) {
    $_SESSION["beitragCount"] = 0;
}

if ($_SESSION["beitragCount"] > 10) {
    $uploadOk = 0;
}

if ($pdfFileType !== "pdf") {
    echo "datei ist keine pdf";
    $uploadOk = 0;
}

if (file_exists($target_file)) {
    echo "Beitrag existiert bereits";
    $uploadOk = 0;
}

if ($uploadOk == 1) {
    $db = new PDO("sqlite:../sql/webprogrammierung.db");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    try {
        $db->beginTransaction();
        echo "transaction begonnen <br>";

        $sql = $db->prepare("SELECT id, firstname, lastname, title FROM users WHERE username = :username;");
        echo "statement prepared <br>";
        $sql->execute(array(':username' => $_SESSION["usrName"]));
        echo "statement executed <br>";
        $ergebnis = $sql->fetchAll();
        echo "statement gefetched <br>";

        $db->commit();
        echo "transaction complete<br>";

        foreach ($ergebnis as $zeile) {
			$nutzerID = htmlspecialchars($zeile["id"]);
            $nutzerVorname = htmlspecialchars($zeile["firstname"]);
            $nutzerNachname = htmlspecialchars($zeile["lastname"]);
            $nutzerTitel = htmlspecialchars($zeile["title"]);
        }

    } catch (PDOException $e) {
        echo "Nutzer lookup fehlgeschlagen";
        $uploadOk = 0;
    }
}

if ($uploadOk == 1) {
    try {
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->beginTransaction();

        $sql = $db->prepare("INSERT INTO articles (name, abstract, path, webpath, userID, category, date, views, status) VALUES (:name, :abstract, :path, :webpath, :userID, :category, :date, :views, :status);");
        $sql->execute(array(
            ':name' => $beitragTitel,
            ':abstract' => $beitragAbstract,
            ':path' => $dbfile,
            ':webpath' => $dbhtml,
            ':userID' => $nutzerID,
            ':category' => $kategorie,
            ':date' => date("Y-m-d H:i"), /*heutiger tag jahr.monat.tag stunden:minuten :: 2018-06-14 05:05*/
            ':views' => 0,
            ':status' => "false"));

        $beitragID = (int) ($db->lastInsertId());

        $db->commit();
        echo "Bitrag '$beitragTitel' in db eingetragen mit ID: $beitragID <br>";
    } catch (PDOException $e) {
        echo "DB eintrag fehlgeschlagen";
        $uploadOk = 0;
        $db->rollBack();
    }
}

if ($uploadOk == 1) {
    //erstelle html beitrag datei
    $htmlDatei = fopen("../" . $dbhtml, "w");
    $htmlCode = genArticleHTML($beitragTitel, $beitragAbstract, $dbfile, $nutzerID, $beitragID);
    fwrite($htmlDatei, $htmlCode);
    fclose($htmlDatei);

    //lade datei hoch
    move_uploaded_file($file["tmp_name"], $target_file);

    //beitragCount vom nutzer incrementieren -> darf nur limitierte anzahl an beiträge pro tag erstellen
    if ($_SESSION["beitragCountDay"] == date("d")) {
        $_SESSION["beitragCount"]++;
    }

    //gehe zum beitrag html
    header("location: http://" . $_SERVER["SERVER_NAME"] . "/" . $dbhtml);
    exit;
}

echo "<br>beitrag erstellen fehlgeschlagen<br>";
header("location: http://" . $_SERVER["SERVER_NAME"] . "/beitragErstellen.html");
