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
}

?>