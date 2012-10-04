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
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program. If not, see <http://www.gnu.org/licenses/>.
*/

//
// SECURITY
//

/*
The salt key is an security key, that is used for unique id, and safety
YOU MUST CHANGE IT, IT MUST BE AT LEAST 128 CHARS
Please put a secure one, with upper case, lower case and numbers.
Set checkBannedIps to true to lock the acces to your website to all banned ips.
The update key is an security key, that is used for automatique updates with update.php
YOU MUST CHANGE IT, IT MUST BE AT LEAST 20 CHARS
*/

$security = array(
    "salt" => "MmCdwKkpfm62Y4GnZx6RSj9tAGejXkXxLLDD2HaiwkY9iFR3hfFdSLbz2MP2ftbhqgc85vxTUVSJDabbT4M6eN5DFbBmYgBQXyK6kBYWfvrsSaDyivek9VpFTTwzx8cB2y6Hqy3DuKnCSxR3zT7QVqt4yK76G4NkiY4aHHKp7c5abGjjLrYh4NCYykiN79fQ3hyjCKtoboFqttYPHJAkkG972YRKtQmuyvupUQJi85Bg4JvBxhdNGixKTtzra3jH",
    "checkBannedIps" => true,
    "updateKey" => "GejXkXxLLDD2HaiwkY9iFR3hfFdSLb"
    );


//
// PLUGINS
//

/*
Here you cant set the active plugins in veloce, to do that, set to true the plugins that you want to activate,
and to false the others.
We recomand you disable the plugins that you dont use.
*/

$plugins = array(
    "database" => true,
    "html" => true,
    "cache" => false,
    "Classloader" => false
    );

//
// Custom classes
//

/*
If you added custom classes in the lib folder, Veloce can include them in your php files
Just add them here
*/

$CustomClasses = array(
    "myclass.php",
    "youtubeApi.php"
    );

//
// DATABASE
//

/*
In this section, you can set your MySQL database infos
The first parameter is the host of your database, it can be an ip or a domain name (eg: localhost or bdd.exemple.com)
The second is the user of the database, we recommand you create a new one, with the SELECT, UPDATE, DELETE, INSERT permissions
The password is the password for your database, please user an strong one, like 6494F6y6D5w2y581143I0736mFgx3g (Dont use this one)
You can set the charset of the database if you want. By default, even if field is commented, its UTF-8.
Finally, set the database that you are going to work on.
*/

$databaseConf = array(
"host" => "localhost",
"user" => "root",
"password" => "",
//"charset" => "UTF-8",
"database" => "veloce"
);

//
// PATH
//

/*
THIS MUST BE SET !
Here, set the path where your application is, for example, if your application is in a folder called "Blog", set this to /Blog
The root value is a boolean, if your app is at the root folder of your server, set this to true.
*/

$paths = array(
    "root" => true,
    "AppFolder" => "/veloce"
    );

//
// CACHE
//

/*
In this section, you can set the cache configuration
The directory is the directory witch will content all the veloce cache files
MAKE SURE YOUR DIRECTORY IS IN CHMOD 777
The duration parameter is the life time of your cache in minutes.
*/

$cacheConf = array(
    'directory' => 'cache',
    'duration' => 120
    );
?>