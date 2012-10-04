<?php
/*
	Veloce Framework
    Copyright (C) 2012 Pierre Ferran

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

class VeloceClassLoader {

	private $ClassesConf;

	public function __construct($c) {
		$this->ClassesConf = $c;
	}

	public function init() {
		foreach($this->ClassesConf as $c) {
			if (file_exists("lib/".$c)) {
				require_once("lib/".$c);
			}
		}

	}

	public function load($c) {
			if (file_exists("lib/".$c)) {
				require_once("lib/".$c);
			}
	}

}

?>