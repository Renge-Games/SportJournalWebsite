<?php
//generiere html datei mit beitrag
function genArticleHTML($beitragTitel, $beitragAbstract, $dbfile, $autorID, $beitragID)
{
    $db = new PDO("sqlite:../sql/webprogrammierung.db");

    return '<?php
	session_start();

	$db = new PDO(\'sqlite:../sql/webprogrammierung.db\');
	try{
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->beginTransaction();

		$sql = $db->prepare("UPDATE articles SET views = views + 1 WHERE id = :id");
		$sql->execute(array(":id" => ' . $beitragID . ')); //wird generiert

		$db->commit();
	}catch(PDOException $e){
		$db->rollBack();
	}

?>
<!DOCTYPE html>
<html>

<head>
	<title>' . $beitragTitel . '</title>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<!-- Wichtig fuer Bootstrap -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="beitrag">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB"
	 crossorigin="anonymous">
	<!-- Javascript -->
	<script src="/js/responsiveNav.js"></script>
	<script src="/js/header.js"></script>
	<script src="/js/ajax.js"></script>
	<!-- Unsere CSS -->
	<link rel="stylesheet" type="text/css" href="/css/cookieNotification.css">
	<link rel="stylesheet" type="text/css" href="/css/navigation.css">
	<link rel="stylesheet" type="text/css" href="/css/header.css">
	<link rel="stylesheet" type="text/css" href="/css/pagelayout.css">
	<link rel="stylesheet" type="text/css" href="/css/beitrag.css">
	<!-- Icons-->
	<link rel="shortcut icon" type="image/x-icon" href="/materials/icons/glyph.png">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp"
	 crossorigin="anonymous">
</head>

<body onload="setRndBG();" onresize="setRndBG();">
	<div id="container">
		<div id="container-main">
			<header>
				<a id="headerTitle" onclick="toggleBG()"><span id="headerFirst">Sport</span><span id="headerLast">Journal</span></a>
			</header>

			<nav it-include-html="/navigation.html"></nav>

			<section>
				<div class="container-fluid">
					<div class="row">
						<div id="beitragContainer">
							<div id="main">
								<div id="abstractTitle">
									<h2>' . $beitragTitel . '</h2>
									<br>
									<br>
									<h6>Abstract</h6>
								</div>
								<div id="abstractText">
									<p>' . $beitragAbstract . '</p>
								</div>
								<div id="dlPDF">
									<form id="download" method="get" action="/' . $dbfile . '" target="_blank">
										<b>PDF</b>
										<button type="submit" >Download</button>
									</form>
								</div>
								<div id="facebookPlugin">
									<div>
										<!-- Load Facebook SDK for JavaScript -->
										<div id="fb-root"></div>
										<script>
											(function(d, s, id) {
												var js, fjs = d.getElementsByTagName(s)[0];
												if (d.getElementById(id)) return;
												js = d.createElement(s);
												js.id = id;
												js.src = "https://connect.facebook.net/de_DE/sdk.js#xfbml=1&version=v3.0&appId=1972512699433935";
												fjs.parentNode.insertBefore(js, fjs);
											}(document, \'script\', \'facebook-jssdk\'));
										</script>

										<div class="fb-share-button" data-href=<?php echo "\"http://" . $_SERVER["SERVER_NAME"] . $_SERVER["PHP_SELF"] . "\""; ?> data-layout="button_count" data-size="small" data-mobile-iframe="true"></div>

									</div>
								</div>
							</div>
							<?php
								$db = new PDO("sqlite:../sql/webprogrammierung.db");
								$db->beginTransaction();
								$sql = $db->prepare("SELECT title, firstname, lastname, imagepath FROM users WHERE id = :id;");
								$sql->execute([\':id\' => "' . htmlspecialchars($autorID) . '"]);
								$ergebnis = $sql->fetch();
								$db->commit();
							?>
							<a href="/php/erweiterteSuche.php?autor=<?php echo "\"" . $ergebnis["title"] . " " . $ergebnis["firstname"] . " " . $ergebnis["lastname"] . "\"";?>>
								<div id="author">
									<?php
										if(count($ergebnis) > 0){
											echo "<div id=\"authorImage\" style=\"background: #f0f0f0 url(/";
											echo $ergebnis["imagepath"];
											echo ") no-repeat 50% 50% / 100%\"></div><div id=\"authorName\"><div id=\"authorSurName\">";
											echo $ergebnis["title"] . " " . $ergebnis["firstname"];
											echo "</div><div id=\"authorLastName\">";
											echo $ergebnis["lastname"];
											echo "</div></div>";
										}else{
											echo "<div id=\"authorImage\"></div>";
											echo "<div id=\"authorName\"><div id=\"authorSurName\">Gelöscht</div>";
											echo "<div id=\"authorLastName\">Gelöscht";
											echo "</div></div>";
										}
										?>
								</div>
							</a>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>

	<footer>
		<div id="footer">
			<a href="/impressum.html">Impressum</a> -
			<a href="/datenschutz.html">Datenschutz</a>
		</div>
	</footer>

	<?php
		if(!isset($_COOKIE["disableCookieNotify"])){
		echo \'<div id="cookieNotification">
				<div id="cookieNotifyText">Wir verwenden Cookies. Für weitere informationen siehe unser <a href="/datenschutz.html">Datenschutz</a>.</div>
				<div id="cookieNotifyButton" >
					<form action="/php/notifyCookie.php" method="post">
						<input type=hidden name="acceptCookie" value="true">
						<input id="cookieSubmit" type="submit" value="Akzeptieren">
					</form>
				</div>
			</div>\';
		}
	?>
</body>
<script>includeHTML();</script>
</html>';
}
