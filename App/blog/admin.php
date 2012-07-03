<?php
//Here we are going to make an very simple non SQL login systeme

//Here we are storing the usernames
$logins = array("admin", "TheCakeIsALie", "MyDearFriend");

//And here the passwords
// You should hash the password first and put the hashed value in there.
$passwords = array(
	"admin" => $veloce->hash("thisisansupersecretpassw0rd"),
	"TheCakeIsALie" => $veloce->hash("CakePHPIsBad:p"),
	"MyDearFriend" => $veloce->hash("Thisframeworkisthebest")
	);

//Login section
if ($_POST["login"]) {
	if (in_array($_POST["login"], $logins) && $passwords[$_POST["login"]] === $veloce->hash($_POST["password"])) {
		$_SESSION["id"] = $veloce->uniqid();
		$content = "<a href='logout.php' class='button danger'>Logout</a><br /><form action='' method='post'><form action='' method='POST'><br /><input type='text' name='title' value='Title' /><br /><textarea name='content'>Content</textarea><br /><input type='submit' value='Publish !' class='button big' />";
		Error("Welcome !", $content);
	} else {
		Error("Wrong login", "Woups, you cant go there with those logins !");
	}
} else if(!empty($_POST["title"]) && !empty($_POST["content"]) && !empty($_SESSION["id"])) {
	$bdd->setActiveTable("post");
	$bdd->put("?, ?, ?", array("NULL", $_POST["title"], $_POST["content"]));
	$veloce->redirect("admin.php");
} else if(!empty($_SESSION["id"])) {
		$content = "<a href='logout.php' class='button danger'>Logout</a><br /><form action='' method='post'><form action='' method='POST'><br /><input type='text' name='title' value='Title' /><br /><textarea name='content'>Content</textarea><br /><input type='submit' value='Publish !' class='button big' />";
		Error("Welcome !", $content);
} else {
	Error("Please login", "<form action='' method='POST'><br /><input type='text' name='login' value='Login' /><br /><input type='password' name='password' value='password'/><br /><input type='submit' value='Login' class='button big' />");
}