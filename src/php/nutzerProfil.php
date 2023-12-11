<?php
session_start();

$action = $_POST["action"];
if (isset($_SESSION["usrName"])) {
    $usrName = $_SESSION["usrName"];
} else {
    exit;
}

$db = new PDO("sqlite:" . $_SERVER['DOCUMENT_ROOT'] . "/sql/webprogrammierung.db");

$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$actionOK = 1;

//https://www.w3schools.com/php/php_file_upload.asp -> teilweise
if ($action == "foto") {

    $dateiName = uniqid();

    $uuid = uniqid();
    $target_dir = "../userProfile/";
    $imageFileType = strtolower(pathinfo($_FILES["bildZumHochladen"]["name"], PATHINFO_EXTENSION));
    $target_file = $target_dir . $uuid . "." . $imageFileType;
    // Überprüfe ob das Bild wirklich ein Bild ist
    if (isset($_POST["submit"])) {
        if (getimagesize($_FILES["bildZumHochladen"]["tmp_name"]) !== false) {
            $actionOK = 1;
        } else {
            $actionOK = 0;
        }

        if ($actionOK == 1 && move_uploaded_file($_FILES["bildZumHochladen"]["tmp_name"], $target_file)) {
            $db->beginTransaction();

            $sql = $db->prepare("SELECT imagepath FROM users WHERE username = :username;");
            if (!$sql->execute([':username' => $usrName])) {
                $db->rollBack();
                $actionOK = 0;
            }
            $oldFile = $sql->fetchColumn();

            //Speichere Pfad im User in der Datenbank
            $sql = $db->prepare("UPDATE users SET imagepath = :imagepath WHERE username = :username;");
            if ($actionOK == 1 && !$sql->execute([':username' => $usrName, ':imagepath' => "userProfile/" . $uuid . "." . $imageFileType])) {
                $db->rollBack();
                $actionOK = 0;
            }

            $db->commit();

            if ($actionOK == 0) {
                unlink($target_file);
            } else {
                if (strpos($oldFile, "blankProfile") === false) {
                    unlink("../" . $oldFile);
                }

            }
        }

    }
}
if ($action == "deleteAll" || $action == "delete") {

    $db->beginTransaction();

    //hole infos
    $id = 0;
    $oldimagepath = "";

    $sql = $db->prepare("SELECT id, imagepath FROM users WHERE username = :username;");
    if (!$sql->execute([':username' => $usrName])) {
        $db->rollBack();
        $actionOK = 0;
    } else {
        $row = $sql->fetch(PDO::FETCH_ASSOC);
        $id = $row["id"];
        $oldimagepath = $row["imagepath"];
    }

    //lösche beiträge
    if ($action == "deleteAll") {
        //löschen der Artikel
        $sql = $db->prepare("DELETE FROM articles WHERE userID = :userID;");
        if (!$sql->execute([':userID' => $id])) {
            $db->rollback();
        }

    }

    //lösche nutzer
    //lösche zuerst Profilbild
    if (strpos($oldimagepath, "blankProfile") === false) {
        unlink("../" . $oldimagepath);
    }

    //dann lösche den Nutzer
    $sql = $db->prepare("DELETE FROM users WHERE id = :id");
    if ($actionOK == 1 && !$sql->execute([':id' => $id])) {
        $db->rollBack();
    }

    $db->commit();

    //nutzer logout
    header("location:http://" . $_SERVER["SERVER_NAME"] . "/php/logout.php");
    exit;
}

if ($action == "update") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $title = $_POST["title"];
    if ($username == "" && $password == "" && $firstname == "" && $lastname == "" && $title == "") {
        $actionOK = 0;
    }

    if ($actionOK == 1) {
        $db->beginTransaction();
        $valBefore = 0;
        $execArr = array();
        $sql = "UPDATE users SET ";
        if ($username != "") {
            $sql .= "username = :username";
            $execArr[":username"] = $username;
            $valBefore = 1;
        }
        if ($password != "") {
            if ($valBefore) {
                $sql .= ", ";
            }
            $sql .= "password = :password";
            $execArr[":password"] = password_hash($password, PASSWORD_DEFAULT);
            $valBefore = 1;
        }
        if ($firstname != "") {
            if ($valBefore) {
                $sql .= ", ";
            }
            $sql .= "firstname = :firstname";
            $execArr[":firstname"] = $firstname;
            $valBefore = 1;
        }
        if ($lastname != "") {
            if ($valBefore) {
                $sql .= ", ";
            }
            $sql .= "lastname = :lastname";
            $execArr[":lastname"] = $lastname;
            $valBefore = 1;
        }
        if ($title != "") {
            if ($valBefore) {
                $sql .= ", ";
            }
            $sql .= "title = :title";
            $execArr[":title"] = $title;
            $valBefore = 1;
		}
		$sql .= " WHERE username = :usrname;";
		$execArr[":usrname"] = $usrName;

		$stmt = $db->prepare($sql);
		if($actionOK && !$stmt->execute($execArr)){
			$db->rollBack();
		}

		$db->commit();
		
		//nutzer muss sich nochmal einloggen
		header("location:http://" . $_SERVER["SERVER_NAME"] . "/php/logout.php");
		exit;
    }
}

if ($action == "request") {
	//öffne pdf mit nutzerdaten
}

header("Location: http://" . $_SERVER["SERVER_NAME"] . "/nutzerProfil.html");
