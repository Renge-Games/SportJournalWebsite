<?php
$beitragId = htmlspecialchars($_REQUEST["beitragId"]);
$action = htmlspecialchars($_REQUEST["beitragAction"]);
$page = htmlspecialchars($_REQUEST["page"]);
$deleted = false;

$db = new PDO("sqlite:../sql/webprogrammierung.db");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if($action == "delete"){
    $db->beginTransaction();

    $sql = $db->prepare("SELECT webpath, path, status FROM articles WHERE id = :id;");
    $sql->execute([':id' => $beitragId]);
    $beitrag = $sql->fetch();
    
    try {
        //lösche dateien wenn beitrag nicht bereits bestätigt
        if($beitrag["status"] != "true"){
            //lösche von db
            $sql = $db->prepare("DELETE FROM articles WHERE id = :id;");
            $sql->execute([':id' => $beitragId]);

            //lösche html und pdf
            unlink("../" . $beitrag["webpath"]);
            unlink("../" . $beitrag["path"]);

            $deleted = true; //datei gelöscht
        }
    } catch (PDOException $e) {
        $db->rollBack();
        echo "beitrag löschen fehlgeschlagen!";
    }

    $db->commit();

}
if($deleted == false){
    try {
        $db->beginTransaction();

        $sql = $db->prepare("UPDATE articles SET status = :status WHERE id = :id;");
        $sql->execute([
            ':status' => $action == "accept" ? "true" : "false",
            ':id' => $beitragId]);

        $db->commit();
    } catch (PDOException $e) {
        $db->rollBack();
        echo "beitrag akzeptieren fehlgeschlagen!";
    }
}

header("Location: http://" . $_SERVER["SERVER_NAME"] . "/php/erweiterteSuche.php?approved=" . $page);
