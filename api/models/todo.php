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
      array_push($todos, "id"->$row["id"], "title"->$row["title"], "completed"->$row["completed"]);
    }


    return json_encode($todos);

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