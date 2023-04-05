<?php
require_once "BaseDao.class.php";
class PetsDao extends BaseDao {

    public function __construct(){
        parent::__construct("pets");
      
    }
    public function get_all(){
        return parent::get_all();
    }

    
}
?>