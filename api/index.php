<?php
include("config.php");
include("dbConnection.php");
include('./models/todo.php');

$db = (new DBConnection())->getConnection();
// $db->executeSQL();

$todo = new Todo($db);
$method = $_SERVER["REQUEST_METHOD"];
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);


if ($path === '/todos') {
  if ($method === 'GET') {
    try {

      $allTodos = $todo->getAll();
      echo json_encode($allTodos);

    } catch (Exception $err) {
      echo $err->getMessage();
      exit();
    }

  } else if ($method === 'POST') {
    try {
      //extract data from request.body
      $json = file_get_contents('php://input');
      // Convert the encoded json into php variable and the returned value is an associative array
      $data = json_decode($json, true);

      $myTask = $todo->create($data["title"], $data["completed"]);

      echo 'Task created successfully';

    } catch (Exception $e) {
      echo $e->getMessage();
      exit();
    }
  } else if ($method === 'PUT') {

  } else if ($method === 'DELETE') {

  }
}
?>