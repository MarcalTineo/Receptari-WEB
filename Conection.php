<?php

class Connection
{
   private $connection = "";
   private $address = "";
   private $username = "";
   private $password = "";
   private $database = "";
   private $port = "";


   public function __construct($address, $username, $password, $database, $port = 3306)
   {
      $this->address = $address;
      $this->username = $username;
      $this->password = $password;
      $this->database = $database;
      $this->port = $port;
   }

   public function connect()
   {
      $conn = new mysqli($this->address, $this->username, $this->password, $this->database, $this->port);
      if ($conn->connect_error) {
         die("Connection failed: " . $conn->connect_error);
      }
      return $conn;
      // $this->connection = $conn;
   }

   // public function getConnection()
   // {
   //    if ($this->connection == null) {
   //       die("There is no connection initialized");
   //    } else {
   //       return $this->connection;
   //    }
   // }

   public function closeConnection()
   {
      $this->connection->close();
   }
}

?>