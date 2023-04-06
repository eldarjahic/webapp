<?php
require_once "BaseService.php";
require_once __DIR__."/../dao/usersDao.class.php";

class UserService extends BaseService{
    private  $user_dao;
    public function __construct(){
        parent::__construct(new UserDao);
        
 }

}

?>