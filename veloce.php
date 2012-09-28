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
require_once("lib/veloce.inc.php");

session_start("Veloce" . sha1($security["salt"]));


if ($security["checkBannedIps"]) {
    $s = new Restricted();
    $s->check();
}

if (!empty($_SERVER["REDIRECT_STATUS"])) {
    $HttpStatus = $_SERVER["REDIRECT_STATUS"] ;
    if($HttpStatus==400) {Error("#400", "You did an bad request.");die();}
    if($HttpStatus==401) {Error("#401", "Unauthorized request.");die();}
    if($HttpStatus==403) {Error("#403", "Forbidden request.");die();}
    if($HttpStatus==404) {Error("#404", "The file was not found.");die();}
    if($HttpStatus==500) {Error("#500", "Internal Server Error.");die();}
    if($HttpStatus==502) {Error("#502", "Bad gateway.");die();}
}
if (!$paths["root"]) 
{
    $path = $_SERVER["REQUEST_URI"];
    $path = str_replace($paths["AppFolder"], "", $path);
    $path = explode("?", $path);
    $path = $path[0];
} else {
    $path = $_SERVER["REQUEST_URI"];
    $path = explode("?", $path);
    $path = $path[0];
}

if($path !== "/") {
    if (file_exists("App". $path)) {
        include("App". $path);
    } else {
        Error("#404", "The file was not found.");
    }
} else {
    if (file_exists("App/index.php")) {
        include("App/index.php");
    } else {
        Error("#404", "The file was not found.");
    }
}

?>