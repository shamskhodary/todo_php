<?php
include("config.php");
include("dbConnection.php");
include('./models/todo.php');

$db = (new DBConnection())->getConnection();
// $db->executeSQL();

$todo = new Todo($db);
$allTodos = $todo->getAll();

echo $allTodos

  ?>