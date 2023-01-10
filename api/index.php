<?php
include("config.php");
include("dbConnection.php");
include('./models/todo.php');

// $db = (new DBConnection())->getConnection();
$db = new DBConnection();
$pdo = $db->getConnection();

$todo = new Todo($pdo);
echo $todo->getAll();

?>