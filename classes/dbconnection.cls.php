<?php
  class DbConnection
    {
      protected function connect() {
          try {
              $dbUsername = "root";
              $dbPassword = ""; // i know this is unsafe... however, this is only for demo purposes
              $dbHandler = new PDO('mysql:host=localhost;dbname=db_kfzteile', $dbUsername, $dbPassword);
              return $dbHandler;
          }
          catch (PDOException $e) {
              print "Error: " . $e->getMessage() . "<br/>";
              die();
          }
      }
    }
