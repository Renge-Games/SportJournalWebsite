<?php

//alte db dateien löschen
delAll("../sql/*");
delAll("../journals/*");
delAll("../journals/artikel/*");
delAll("../userProfile/*");

function delAll($dir)
{
    $dat = glob($dir, GLOB_BRACE);
    foreach ($dat as $file) {
        if (is_file($file) && strpos($file, "blankProfile") === false && strpos($file, "txt.txt") === false) {
            unlink($file);
        }
    }
}


//verbindungsaufbau
$db = new PDO("sqlite:" . $_SERVER['DOCUMENT_ROOT'] . "/sql/webprogrammierung.db");


//hier haben wir keine prepared statements verwendet, da diese datei nur zum testen da ist
try {


    $sql = "CREATE TABLE users( id INTEGER PRIMARY KEY AUTOINCREMENT,
								username CHAR(255),
								email CHAR(255),
								password CHAR(255),
								admin BOOLEAN,
								imagepath CHAR(255),
								firstname CHAR(255),
								lastname CHAR(255),
								title CHAR(20))";
    $db->exec($sql);

    $sql = "CREATE TABLE articles( id INTEGER PRIMARY KEY AUTOINCREMENT,
								name CHAR(255),
								abstract TEXT,
								path CHAR(255),
								webpath CHAR(255),
								userID INTEGER,
								category TEXT,
								date TEXT,
								views INTEGER,
								status TEXT,
								FOREIGN KEY(userID) REFERENCES users(id))";
    $db->exec($sql);

    //admin konto erstellen
    $sql = "INSERT INTO users (username, email, password, admin, imagepath, firstname, lastname, title) VALUES ('admin', 'admin@local', '" . password_hash("password", PASSWORD_DEFAULT) . "', 1, 'userProfile/blankProfile.png', 'Admin', 'Admin', 'Admin');";
	$db->exec($sql);
	echo "db erfolgreich erstellt.";

} catch (PDOException $e) {
    echo "table existiert bereits oder table erstellen fehlgeschlagen";
}
