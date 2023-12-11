<?php
$nutzerId = htmlspecialchars($_REQUEST["nutzerID"]);
$action = htmlspecialchars($_REQUEST["action"]);
$page = htmlspecialchars($_REQUEST["page"]);

$db = new PDO("sqlite:../sql/webprogrammierung.db");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if ($action == "delete") {
    try {
        $db->beginTransaction();

        //lösche von db
        $sql = $db->prepare("DELETE FROM users WHERE id = :id;");
        $sql->execute([':id' => $nutzerId]);

        $db->commit();
    } catch (PDOException $e) {
        $db->rollBack();
        echo "nutzer löschen fehlgeschlagen!";
    }
}
if ($action == "toggleMod") {
    try {
        $db->beginTransaction();

        $sql = $db->prepare("UPDATE users SET admin = 1 - admin WHERE id = :id;");
        $sql->execute([':id' => $nutzerId]);

        $db->commit();
    } catch (PDOException $e) {
        $db->rollBack();
        echo "mod toggle fehlgeschlagen!";
    }
}

header("Location: http://" . $_SERVER["SERVER_NAME"] . "/php/erweiterteSuche.php?approved=" . $page);
