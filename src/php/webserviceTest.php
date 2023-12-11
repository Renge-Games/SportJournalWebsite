<?php

$client = new SoapClient(null, ['location' => "http://localhost/php/webservice.php", 
								'uri' => "http://localhost/php/webservice.php"]);

try{
	$result = $client->__soapCall("getRecentEntries", [2]);
	var_dump($result);
	echo "<br><br>";
	$result = $client->__soapCall("getEntries", [2017, 11]);
	var_dump($result);

}catch(SoapFault $e){
	print "Fehler-String: " . $e->faultstring;
}
