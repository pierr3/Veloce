<?php
require_once("lib/veloce.inc.php");

if ($paths["root"])
    file_put_contents(".htaccess", str_replace("{PATH}", "", file_get_contents("temp.htaccess")));
else
    file_put_contents(".htaccess", str_replace("{PATH}", $paths["AppFolder"], file_get_contents("temp.htaccess")));
unlink("temp.htaccess");
Error("Installation done", "Please delete install.php");
?>