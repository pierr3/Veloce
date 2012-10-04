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

class DatabaseCon {

	private $host;

	private $user;

	private $pass;

	private $charset = "UTF-8";

	private $database;

	private $link;

	private $ActiveTable;

	public function __construct($config) {
		
		if (empty($config))
			Error("Empty config", "Please set the database config in config/config.php");

		$this->host = $config["host"];

		$this->user = $config["user"];

		$this->pass = $config["password"];

		$this->database = $config["database"];

		if(!empty($config["charset"]))
			$this->charset = $config["charset"];

		$this->CreateLink();

	}

	private function CreateLink() {

		try 
		{
			$this->link = new PDO('mysql:host='.$this->host.';dbname='.$this->database.';charset='.$this->charset, $this->user, $this->pass);
		} 
		catch(Exception $e)
		{
			Error($e->getCode(), $e->getMessage());
		}

	}

	public function setActiveTable($table) {

		$this->ActiveTable = $table;

	}

	public function get($string, $values=array(), $fetchAll=0) {

		if ($string === "-all") {

			$prepare = $this->link->prepare("SELECT * FROM `".$this->ActiveTable."`");
			$prepare->execute();

		} else {

			$prepare = $this->link->prepare("SELECT * FROM `".$this->ActiveTable."` WHERE ".$string);
			$prepare->execute($values);

		}

		if ($fetchAll != 1) return $prepare; else return $prepare->fetchAll();

	}

	public function put($string, $values=array()) {

		$prepare = $this->link->prepare("INSERT INTO `".$this->ActiveTable."` VALUES(".$string.")");
		$prepare->execute($values);

	}

	public function query($string, $values=array()) {

		$sql = str_replace(array("%table%", "'"), array($this->ActiveTable, "`"), $string);
		$prepare = $this->link->prepare($sql);
		$prepare->execute($values);
		return $prepare;

	}

	public function delete($where, $values) {
		
		$prepare = $this->link->prepare("DELETE FROM `".$this->ActiveTable."` WHERE ".$where);
		$prepare->execute($values);

	}

}

?>