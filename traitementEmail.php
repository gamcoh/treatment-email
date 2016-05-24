<?php 
$email = $_POST['email'];

$webmails = ["hotmail","orange","gmail","yahoo","sfr","live","wanadoo","laposte","free","neuf","voila","aol","msn","bbox","aliceadsl","numericable","dbmail","cegetel","gmx","outlook","ymail","akeonet","netcourrier","noos","libertysurf","estvideo","dartybox","nordnet","mail","rocketmail"];

preg_match("/@([^\.]*)/i", $email, $matches);

foreach ($webmails as $webmail) {
	if (levenshtein($webmail, $matches[1]) < 2) {
		// the corrected webmail
		echo $webmail;
	}
}
