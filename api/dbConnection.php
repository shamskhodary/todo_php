<?php
class DBConnection
{
  private $mysqli;

  public function __construct()
  {
    include 'config.php';

    $this->mysqli = new mysqli($host, $user, $password, $db);

    if ($this->mysqli->connect_error) {
      die('Connection failed:' . $this->mysqli->connect_error);
    }

    $this->mysqli->set_charset('utf8');

    echo "Connected successfully \n";
  }


  public function getConnection()
  {
    return $this->mysqli;
  }

  public function executeSQL()
  {
    try {
      $sql = file_get_contents('db.sql');

      if ($this->mysqli->multi_query($sql)) {

        echo "SQL file executed successfully";
      }
    } catch (Exception $e) {
      echo $e->getMessage();
    }
  }

  public function close()
  {
    return $this->mysqli->close();
  }
}

?>