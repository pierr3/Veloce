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

require_once("config/config.php");
require_once("lib/utils.php");
require_once("lib/restricted.php");

if (strlen($security["salt"]) < 128) {
        Error("Salt key is not long enought", "Please change it in the config/config.php file, and put at least 128 chars.");
} if (file_exists("temp.htaccess")) {
        Error("Not installed !", "Veloce is not installed, launch <a href='install.php'>install.php</a>.");
}

class Veloce {

    private $security;

	public function __construct($sec) {	
        $this->security = $sec;
	}

    public function hash($str) {
        return base64_encode(sha1( $str . $this->security["salt"]));
    }

    public function uniqid() {
        return uniqid($this->security["salt"]);
    }

    public function redirect($url) {
        header("Location: ".$url);
        die();
    }

    public function escape($var) {
        return htmlspecialchars($var);
    } 
}

$veloce = new Veloce($security);

foreach($plugins as $plugin => $value): 
    
    if ($value === true):

        switch($plugin):

            case "database":
                require_once("lib/database.php");

                if (!isset($databaseConf) || empty($databaseConf)) {
                    Error("Database config empty", "The database config is empty, please set it in config/config.php");
                }

                $bdd = new DatabaseCon($databaseConf);
            break;

            case "html":
                require_once("lib/html.php");

                $html = new html();
            break;

            case "cache":
                require_once("lib/cache.php");

                $cache = new Cache($cacheConf);
            break;

            case "Classloader":
                require_once("lib/vclassloader.php")

                $vclassloader = new VeloceClassLoader($CustomClasses);
                $vclassloader->init();
            break;

        endswitch;

    endif;

endforeach;

?>