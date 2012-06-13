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
require_once("utils.php");

class Cookie {

	public function __construct() {

	}

	public function set($key, $value, $time=1800) {
		$value = base64_encode($value);
		setcookie($key, $value, time()+$time);
	}

	public function get($key) {
		return base64_decode($_COOKIE[$key]);
	}

	public function flush($key) {
		setcookie($key, "", time() - 360000);
	}


}

?>