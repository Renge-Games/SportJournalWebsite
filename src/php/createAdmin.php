<?php
$db = new PDO("sqlite:../sql/webprogrammierung.db");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$actionOK = 1;
try {
    $db->beginTransaction();

	$sql = "SELECT count(*) FROM users WHERE username = 'admin';";
	$ergebnis = $db->query($sql)->fetchColumn();

    $db->commit();
    if ($ergebnis > 0) {
        $actionOK = 0;
    }

} catch (PDOException $e) {
    echo "nutzerabfrage fehlgeschlagen<br>";
    $actionOK = 0;
}

if($actionOK){
	$sql = "INSERT INTO users (username, email, password, admin, imagepath, firstname, lastname, title) VALUES ('admin', 'admin@local', '" . password_hash("password", PASSWORD_DEFAULT) . "', 1, 'userProfile/blankProfile.png', 'Admin', 'Admin', 'Admin');";
	$db->exec($sql);
	echo "admin erfolgreich erstellt...";
}else{
	echo "es gibt bereits einen admin...";
}

?>