<?php
require_once "BaseDao.class.php";

class UserDao extends BaseDao
{
  /**
   * constructor of dao class
   */
  public function __construct()
  {
    parent::__construct("users");
  }

  public function get_user_by_email($email)
  {
    return $this->execute_query("SELECT * FROM users WHERE email = :email", ['email' => $email]);
  }
}

?>