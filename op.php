<?php
require_once ("rest/dao/usersDao.class.php");
$users_dao = new usersDao();
$type  = $_REQUEST ['type'];
switch ($type) {
     case 'add':
        $first_name = $_REQUEST ['first_name'];
        $last_name = $_REQUEST ['last_name'];
        $country = $_REQUEST ['country'];
        $results = $users_dao->add($first_name, $last_name, $country);
        print_r($results);
        break;
     case 'delete':
        $id = $_REQUEST ['id'];
        $users_dao->delete($id);
        break;
     case 'update':
        $first_name = $_REQUEST ['first_name'];
        $last_name = $_REQUEST ['last_name'];
        $country = $_REQUEST ['country'];
        $id = $_REQUEST ['id'];
        $users_dao->update($first_name, $last_name, $country, $id);
        break;
     case 'get':
     default:
         $results = $users_dao->get_all();
         print_r($results);
         break;
}
?>