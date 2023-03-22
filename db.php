<?php
require_once ("rest/dao/usersDao.class.php");
$users_dao = new usersDao();
$results = $users_dao->get_all();
print_r($results);
/*
$servername = "localhost";
$username = "root";
$password = "";
$schema = "webapp";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$schema", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
    $stm = $conn->prepare("SELECT * FROM users");
    $stm->execute();
    $result=$stm->fetchAll(PDO::FETCH_ASSOC);
    print_r($result);
  } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }*/
?>