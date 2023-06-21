<?php
require_once "BaseService.php";
require_once __DIR__ . "/../dao/UserDao.php";
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class UserService extends BaseService
{

  public function __construct(UserDao $userDao)
  {
    $this->dao = $userDao;
  }

  public function login($data)
  {
    $user = $this->dao->get_user_by_email($data['email']);
    if (count($user) > 0) {
      $user = $user[0];
    }
    if (isset($user['id'])) {
      if ($user['password'] == md5($data['password'])) {
        unset($user['password']);
        $user['is_admin'] = false;
        $jwt = JWT::encode($user, Config::JWT_SECRET(), 'HS256');
        return ['token' => $jwt];
      } else {
        throw new Exception("Wrong password", 400);
      }
    } else {
      throw new Exception("User doesn't exist", 404);
    }

  }

}

?>