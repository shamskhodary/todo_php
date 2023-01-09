<?php
class DBConnection
{
  private $connection;

  public function __construct()
  {
    include 'config.php';
    $dsn = "mysql:host=localhost;dbname=react_php;charset=UTF8";

    try {
      $this->connection = new PDO($dsn, $user, $password);
      $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      echo "Connected successfully";

    } catch (PDOException $error) {

      die('Connection failed:' . $error->getMessage());
    }

  }

  public function getConnection()
  {
    return $this->connection;
  }
}

?>