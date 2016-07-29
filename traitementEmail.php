<?php 
// connection to database
$db = new PDO('mysql:host=YOUR_HOST;dbname=YOUR_DBNAME;charset=utf8', 'USER', 'PASSWORD');

// email domains known
$domains = array(
	"hotmail",
	"orange",
	"gmail",
	"yahoo",
	"sfr",
	"live",
	"wanadoo",
	"laposte",
	"free",
	"neuf",
	"voila",
	"aol",
	"msn",
	"bbox",
	"aliceadsl",
	"numericable",
	"dbmail",
	"cegetel",
	"gmx",
	"outlook",
	"ymail",
	"akeonet",
	"netcourrier",
	"noos",
	"libertysurf",
	"estvideo",
	"dartybox",
	"nordnet",
	"mail",
	"rocketmail"
);

// get the domain name from all emails in my table
$req = "SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(member_email, '@', -1), '.', 1) AS domain_name, COUNT(member_email) AS nbr_domain
FROM member GROUP BY domain_name";

// PDO query
$res = $db->query($req);

// fetch all
$wrongDomainsWithCorrection=array();
while ($data = $res->fetch(PDO::FETCH_OBJ)) {

	// if the domain we're looking at
	// is already in the domains array
	// that means it is a good one
	// so we don't need to search for his correction
	if (in_array($data->domain_name, $domains)) {
		continue;
	}

	// else we loop on the domains 
	// array in order to see if
	// the wrong domains have a 
	// potential correction
	foreach ($domains as $domain) {

		// go in php Manual to see the levenshtein
		// https://secure.php.net/manual/fr/function.levenshtein.php
		if ( levenshtein($domain, $data->domain_name) < 2 ) {
			// the array we return is formatted like that:
			// "wrongdomain" = 10 => "correctededdomain"
			$wrongDomainsWithCorrection[$data->domain_name] = array("number_occurence" => $data->nbr_domain, "domain_corrected" => $domain);
		}
	}

}

return $wrongDomainsWithCorrection;


