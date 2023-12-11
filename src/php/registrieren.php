<?php
$vorname = htmlspecialchars($_POST["vorname"]);
$nachname = htmlspecialchars($_POST["nachname"]);
$titel = htmlspecialchars($_POST["titelWahl"]);
$email = htmlspecialchars($_POST["email"]);
$benName = htmlspecialchars($_POST["benName"]);
$passwort = htmlspecialchars($_POST["passwort"]);
$passwort2 = htmlspecialchars($_POST["passwort2"]);

$formOK = 1; //form ist gültig solange $formOK == 1

//nutzer darf sich nicht mehr als 10 mal pro tag registrieren
if (!isset($_SESSION["registerCountDay"])) {
    $_SESSION["registerCountDay"] = date("d"); //nur tag
    $_SESSION["registerCount"] = 0;
} else if ($_SESSION["registerCountDay"] != date("d")) {
    $_SESSION["registerCount"] = 0;
}

if ($_SESSION["registerCount"] > 10) {
    $formOK = 0;
}

//eingabe überprüfung
if (!$formOK || $benName == "admin" || $email == "admin@local" || $passwort != $passwort2 || strspn(" ", $benName) > 0) { //db abfrage ob nutzer name oder email bereits existieren
    $formOK = 0;
}

//bestätige, dass nutzer nicht bereits existiert
if ($formOK) {
    $db = new PDO("sqlite:../sql/webprogrammierung.db");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    try {
        $db->beginTransaction();

        $sql = $db->prepare("SELECT count(*) FROM users WHERE username = :username OR email = :email;");
        $sql->execute(
            [':username' => $benName,
                ':email' => $email]);
        $ergebnis = $sql->fetchColumn();
        if ($ergebnis > 0) {
            $formOK = 0;
        }

        if ($formOK) {
            $sql = $db->prepare("INSERT INTO users (username, email, password, admin, imagepath, firstname, lastname, title) VALUES (:username, :email, :password, :admin, :imagepath, :firstname, :lastname, :title);");
            $sql->execute(array(
                ':username' => $benName,
                ':email' => $email,
                ':password' => password_hash($passwort, PASSWORD_DEFAULT),
                ':admin' => 0,
                ':imagepath' => "userProfile/blankProfile.png",
                ':firstname' => $vorname,
                ':lastname' => $nachname,
                ':title' => $titel));
        }

        $db->commit();

    } catch (PDOException $e) {
        echo "nutzerabfrage fehlgeschlagen<br>";
        $formOK = 0;
    }
}

if ($formOK) {
    //einloggen
    session_start();
    $_SESSION["loggedIn"] = true;
    $_SESSION["usrName"] = $benName;
    $_SESSION["admin"] = false;

    //registerCount incrementieren -> nutzer darf sich nicht mehr als 10 mal pro tag registrieren
    if ($_SESSION["registerCountDay"] == date("d")) {
        $_SESSION["registerCount"]++;
    }

    header("Location: http://" . $_SERVER["SERVER_NAME"]);
} else {
    header("Location: http://" . $_SERVER["SERVER_NAME"] . "/registrierung.html");
}
