<?php
include("config.php");
include("dbConnection.php");

// $db = (new DBConnection())->getConnection();
$db = new DBConnection();
$pdo = $db->getConnection();
$result = $pdo->query("select * from todos");

?>