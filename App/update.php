<?php
/*
	Veloce Framework
    Copyright (C) 2012  Pierre Ferran

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

//Welcome to Veloce core update system !
//This system will only update the "lib" folder, if needed do an manual update.
require_once("config/config.php");
require_once("lib/utils.php");

if ($_GET["key"] != $security["updateKey"]) {
	Error("Update key is wrong", "Please enter the correct update key: <form method='get'><input type='text' name='key' /><input type='submit' /></form>");
	die();
}

$veloce_url = "http://veloce.pixelsdev.fr/dashboard/update.php";

$version = file_get_contents("lib/version");
$b_version = $version;

echo "Checking Veloce's Version...";

$a_version = file_get_contents($veloce_url."?v=".$version."&get=version");

function chrono() {$temps = explode(' ', microtime());return $temps[0] + $temps[1];}

if ($a_version != $version) {

	echo "Ok<br />Getting new lib files md5...";

	$md5 = json_decode(file_get_contents($veloce_url."?v=".$version."&get=md5"), true);

	echo "Ok<br /> Downloading files...";

	$i = 0;
	$start = chrono();

	//Key is the php file name, value is the md5
	foreach($md5 as $key => $value) {

		echo "<br /> Downloading file".$key." ...";

		$f = file_get_contents($veloce_url."?v=".$version."&get=dl&md5=".$value);
		file_put_contents("lib/".$key, $f);

		echo "Ok !";

		$i++;
	}

	echo "<br />Downloaded ".$i." files in ".round(chrono() - $start, 6)." secondes.";
	echo "<br />Update is done !";

} else {
	echo "Seems that you have the lastest version, or that veloce's servers are down.<br />";
}


?>