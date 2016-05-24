<?php 
// the email recupered from the user
$email = $_POST['email'];

// the existing webmails
$webmails = ["hotmail","orange","gmail","yahoo","sfr","live","wanadoo","laposte","free","neuf","voila","aol","msn","bbox","aliceadsl","numericable","dbmail","cegetel","gmx","outlook","ymail","akeonet","netcourrier","noos","libertysurf","estvideo","dartybox","nordnet","mail","rocketmail"];

// we get the webmail from the user's email
preg_match("/@([^\.]*)/i", $email, $matches);

// we loop on the webmails array in order to find the right webmail
foreach ($webmails as $webmail) {
	// we can find the right webmail with the levenshtein function https://secure.php.net/manual/en/function.levenshtein.php
	if (levenshtein($webmail, $matches[1]) < 2) {
		// the corrected webmail
		echo $webmail;
	}
}
