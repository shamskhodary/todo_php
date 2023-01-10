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
    $query_result = $this->db->query($query);

    $this->checkQueryErrors($query, $query_result);

    $todos = array();

    while ($row = $query_result->fetch_assoc()) {
      $todos[] = ["id" => $row["id"], "title" => $row["title"], "completed" => $row["completed"]];
    }

    return json_encode($todos);

  }

  public function create($title, $completed)
  {
    //* using string concatenation to include the value in a string
    $query = "INSERT INTO todos (title, completed) VALUES('" . $title . "','" . $completed . "')";
    $query_result = $this->db->query($query);

    $this->checkQueryErrors($query, $query_result);

    return $query_result;
  }

  public function edit($title, $id)
  {
    $query = "UPDATE todos SET title='" . $title . "' WHERE id= . $id";
    $query_result = $this->db->query($query);

    $this->checkQueryErrors($query, $query_result);

    return $query_result;
  }

  public function delete($id)
  {
    $query = "DELETE FROM todos WHERE id = . $id";
    $query_result = $this->db->query($query);

    $this->checkQueryErrors($query, $query_result);

    echo $query_result;

    echo "Task deleted successful";
  }

  //check if the query is successful or not 
  private function checkQueryErrors($query, $query_result)
  {
    if (!$query_result) {
      throw new ErrorException("Query Error:" . $query . "\nError:" . $this->db->error);
    }
  }
}

?>