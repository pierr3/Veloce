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
require_once("config/config.php");
require_once("utils.php");

session_start("Veloce" . sha1($security["salt"]));


class Sessions {

	public function __construct() {

	}

	public function set($key, $value) {
		$value = base64_encode($value);
		$_SESSION[$key] = $value;
	}

	public function get($key) {
		return $_SESSION[$key];
	}

	public function flush($key) {
		$_SESSION[$key] = null;
		unset($_SESSION[$key]);
	}

	public function destroy() {
		session_unset();
    	session_destroy();
    	session_write_close();
    	session_regenerate_id(true);
	}

}

?>