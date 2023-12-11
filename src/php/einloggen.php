<?php
session_start();

if (isset($_POST["login"])) {
    $benName = htmlspecialchars($_POST["benName"]);
    $password = htmlspecialchars($_POST["password"]);
    $db = new PDO("sqlite:../sql/webprogrammierung.db");
    try {
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->beginTransaction();

        $sql = "SELECT username, password, admin FROM users WHERE username = '$benName';";
        $ergebnis = $db->query($sql);

        $db->commit();
        $dbBenName = "";
        $dbPasswort = "";
        $dbAdmin = 0;

        foreach ($ergebnis as $zeile) {
            $dbBenName = htmlspecialchars($zeile["username"]);
            $dbPasswort = $zeile["password"];
            $dbAdmin = $zeile["admin"];
        }

        if ($benName === $dbBenName && password_verify($password, $dbPasswort)) {
            $_SESSION["loggedIn"] = true;
            $_SESSION["usrName"] = $benName;
            $_SESSION["admin"] = $dbAdmin;
            header("Location: http://" . $_SERVER["SERVER_NAME"]);
        } else {
            header("Location: http://" . $_SERVER["SERVER_NAME"] . "/einloggen.html");
        }

    } catch (PDOException $e) {
        header("Location: http://" . $_SERVER["SERVER_NAME"] . "/einloggen.html");
    }
} else {
    header("Location: http://" . $_SERVER["SERVER_NAME"] . "/einloggen.html");
}
exit;
