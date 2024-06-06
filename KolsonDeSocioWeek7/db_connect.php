   <!--
      Week 7 Assignment

      Author: Kolson 
      Date: 2-29-24

      Filename: db_connect.php
   -->

<?php

$dsn = 'mysql:host=localhost;dbname=my_guitar_shop1'; // replace my_guitar_shop1 with your database name
$username = 'root';
$password = '';

try {
    $db = new PDO($dsn, $username, $password); //creates PDO
    echo '<p> You are connected. </p>';
}
catch (PDOException $e){
    $error_message = $e->getMessage();
    echo '<p> Connection failed due to error : $error_message </p>';
}
?>