<?php

class Todo
{
  private $db;

  public function __construct($db_conn)
  {
    $this->db = $db_conn;
  }

  public function getAll()
  {
    $query = 'SELECT * FROM todos';
    $stmt = $this->db->query($query);

    $this->checkQueryErrors($query, $stmt);

    $todos = array();

    while ($row = $stmt->fetch_assoc()) {
      $todos[] = ["id" => $row["id"], "title" => $row["title"], "completed" => $row["completed"]];
    }

    return $todos;

  }

  public function create($title, $completed)
  {
    $query = "INSERT INTO todos (title, completed) VALUES(?, ?)";
    $stmt = $this->db->prepare($query);

    $this->checkQueryErrors($query, $stmt);

    //specifying variables types I want to bind,then the values sent to the server separately from the query
    // good to avoid query injection
    $stmt->bind_param("si", $title, $completed);

    $stmt->execute();

    return array("title" => $title, "completed" => $completed);
  }

  public function edit($title, $id)
  {
    //* using string concatenation to include the value in a string
    $query = "UPDATE todos SET title = ? WHERE id = ?";
    $stmt = $this->db->prepare($query);

    $this->checkQueryErrors($query, $stmt);

    $stmt->bind_param("si", $title, $id);

    $stmt->execute();

    return $stmt;
  }

  public function delete($id)
  {
    $query = "DELETE FROM todos WHERE id = ?";
    $stmt = $this->db->prepare($query);

    $this->checkQueryErrors($query, $stmt);

    $stmt->bind_param("i", $id);

    $stmt->execute();
    echo $stmt;

    return "Task deleted successful";
  }

  //check if the query is successful or not 
  private function checkQueryErrors($query, $stmt)
  {
    if (!$stmt) {
      throw new ErrorException("Query Error:" . $query . "\nError:" . $this->db->error);
    }
  }
}

?>