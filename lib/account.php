<?php
require_once("lib/utils.php");

public function veloce_account_login($username, $password) {

	$password = $veloce::hash($password);

	$bdd::setActiveTable($accountManagerConf["table"]);

	$req = $bdd::query($accountManagerConf["sql_conf_login"], array($username, $password));

	$array = array("username" => $username);

	if ($req->rowCount === 1) 
		$array["logged"] = true;
	else 
		$array["logged"] = false;

	return $array;
}

public function veloce_account_init() {

	$req = $bdd::query($accountManagerConf["sql_conf_init"]);

	return $req;
}
?>