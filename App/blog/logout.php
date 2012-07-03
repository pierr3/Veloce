<?php
$session->flush("id");
$session->destroy();

$veloce->redirect("admin.php");
?>