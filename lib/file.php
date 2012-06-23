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

class FileManager {

	private $activeFile;

	private $content;

	private $path;

	public function __construct() {

	}

	public function setActiveFile($path) {
		$this->path = $path;
		if (!file_exists($path)) {
			Error("404", "The file '".$path."' was not found.");
		}
	}

	public function get($perm) {
		return fopen($this->path, $perm);
	}

	public function read() {
		$this->activeFile = $this->get("r");

		while (!feof($this->activeFile)):
  			$this->content .= fgets($this->activeFile, 4096);
  		endwhile;

  		fclose($this->activeFile);

  		return $this->content;
	}

	public function put($value) {
		$this->activeFile = $this->get("w");

		fputs($this->activeFile, $value);

		fclose($this->activeFile);
	}

	public add($value) {
		$this->activeFile = $this->get("a");

		fputs($this->activeFile, $value);

		fclose($this->activeFile);
	}
}


?>