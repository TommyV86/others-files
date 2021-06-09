<?php
include_once(__DIR__ . '/../exceptions/DAOException.php');
class CommonDAO

{
  private $dbServername = "localhost";
  private $username = "root";
  private $dbPassword = "";
  private $dbName = "fil_rouge";

  function connexion()
  {

    mysqli_report(MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ERROR);
    try {
      $conn = new mysqli($this->dbServername, $this->username, $this->dbPassword, $this->dbName);
      return $conn;
    } catch (Exception $e) {

      throw new DAOException($e->getMessage(), $e->getCode());
    }
  }
}
