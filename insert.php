<?php
require_once ("rest/dao/usersDao.class.php");
$users_dao = new UsersDao();
$first_name = $_REQUEST ['first_name'];
$last_name = $_REQUEST ['last_name'];
$country = $_REQUEST ['country'];
$results = $users_dao->add($first_name, $last_name, $country );
print_r($results);


/*$servername = "localhost";
$username = "root";
$password = "";
$schema = "webapp";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$schema", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
    print_r($_REQUEST);
    $first_name = $_REQUEST ['first_name'];
    $last_name = $_REQUEST ['last_name'];
    $country = $_REQUEST ['country'];
    $stm = $conn->prepare("INSERT INTO users(first_name, last_name, country) VALUES ('$first_name', 'last_name', 'country')");
    $stm->execute();
    $result=$stm->fetchAll(PDO::FETCH_ASSOC);
    print_r($result);
  } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }*/
?>