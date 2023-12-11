<?php
require "queryUsers.php";

session_start();

$titel = trim(strtolower(htmlspecialchars($_REQUEST["titel"])));
$autor = trim(strtolower(htmlspecialchars($_REQUEST["autor"])));
$datum = trim(strtolower(htmlspecialchars($_REQUEST["datum"])));
$kategorie = trim(strtolower(htmlspecialchars($_REQUEST["kategorie"])));
$approved = trim(strtolower($_REQUEST["approved"])); //string true, false, false2, rejected

if ($approved != "" && (!isset($_SESSION["admin"]) || $_SESSION["admin"] === false)) {
    header("Location: http://" . $_SERVER["SERVER_NAME"]);
    exit;
}

$beitraege = null; //alle artikel auf der website
$finds = array(); //anzahl aufrufe für sortieren
$ergebnis = array(); //suchergebnisse

$titelArr = explode(" ", $titel); //alle schlüsselwörter vom titel
$autorArr = explode(" ", $autor); //alle schlüsselwörter vom autor

//////
//////
////// Artikel Suche
//////
//////
if ($approved != "user") {
    $db = new PDO("sqlite:../sql/webprogrammierung.db");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    try {
        $db->beginTransaction();

        $allesArr = array();

        $sql = "SELECT articles.id as articleId, name, category, date, views, status, webpath, title, firstname, lastname FROM articles LEFT JOIN users ON articles.userID = users.id WHERE ";
        if ($titel != "") {
            $sql .= "(";
        }

        for ($i = 0; $i < count($titelArr) && $titel != ""; $i++) {
            $titelArr[$i] = "%" . $titelArr[$i] . "%";
            $allesArr[] = $titelArr[$i];
            if ($i != 0) {
                $sql .= " OR ";
            }

            $sql .= "name LIKE ?";
            if ($i == count($titelArr) - 1) {
                $sql .= ")";
            }

        }
        if ($autor != "" && $titel != "") {
            $sql .= "AND (";
        } else if ($autor != "") {
            $sql .= "(";
        }

        for ($i = 0; $i < count($autorArr) && $autor != ""; $i++) {
            $autorArr[$i] = "%" . $autorArr[$i] . "%";
            $allesArr[] = $autorArr[$i];
            if ($i != 0) {
                $sql .= " OR ";
            }

            $sql .= "title || ' ' || firstname || ' ' || lastname LIKE ?";
            if ($i == count($autorArr) - 1) {
                $sql .= ")";
            }

        }
        if ($datum != "") {
            if ($titel != "" || $autor != "") {
                $sql .= " AND ";
            }

            $allesArr[] = "%$datum%";
            $sql .= "date LIKE ?";
        }
        if ($kategorie != "") {
            if ($titel != "" || $autor != "" || $datum != "") {
                $sql .= " AND ";
            }

            $allesArr[] = "%$kategorie%";
            $sql .= "category LIKE ?";
        }
        if ($titel != "" || $autor != "" || $datum != "" || $kategorie != "") {
            $sql .= " AND ";
        }

        if ($approved != "") {
            $allesArr[] = "%$approved%";
        } else {
            $allesArr[] = "%true%";
        }

        $sql .= "status LIKE ?;";
        echo "$sql<br>";
        $stmt = $db->prepare($sql);
        echo var_dump($allesArr) . "<br>";
        $stmt->execute($allesArr);
        echo "b<br>";
        //$beitraege = $stmt->fetchALL(PDO::FETCH_ASSOC);
        $ergebnis = $stmt->fetchALL(PDO::FETCH_ASSOC);
        echo "c<br>";
        $db->commit();
    } catch (PDOException $e) {
        exit;
    }
}
//////
//////
////// Nutzer Suche
//////
//////
else if ($approved == "user") {
    $ergebnis = queryAllUsers();
}

if (count($ergebnis) > 0) {
    $_SESSION["suche"] = $ergebnis;
    if ($approved != "") {
        $_SESSION["adminSuche"] = $approved;
        header("Location: http://" . $_SERVER["SERVER_NAME"] . "/adminseite.html");
    } else {
        if (isset($_SESSION["adminSuche"])) {
            unset($_SESSION["adminSuche"]);
        }

        header("Location: http://" . $_SERVER["SERVER_NAME"] . "/suchergebnis.html");
    }

} else {
    if ($approved != "") {
        $_SESSION["suche"] = $ergebnis;
        $_SESSION["adminSuche"] = $approved;
        header("Location: http://" . $_SERVER["SERVER_NAME"] . "/adminseite.html");
    } else {
        if (isset($_SESSION["adminSuche"])) {
            unset($_SESSION["adminSuche"]);
        }

        header("Location: http://" . $_SERVER["SERVER_NAME"] . "/erweiterteSuche.html");
    }

}
