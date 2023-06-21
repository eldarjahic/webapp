<?php

require_once __DIR__ . '/../rest/services/UserService.php';
require_once __DIR__ . '/../rest/dao/UserDao.php';
use PHPUnit\Framework\TestCase;


class UserServiceTest extends TestCase
{
    private UserDao $dao;
    private UserService $service;

    protected function setUp(): void
    {
    }

    protected function tearDown(): void
    {
    }

    public function testLoginForUnknownUser()
    {
        $this->dao = $this->createConfiguredMock(UserDao::class, ['get_user_by_email' => []]);
        $this->service = new UserService($this->dao);

        $this->expectExceptionMessage("User doesn't exist");
        $this->service->login(['email' => 'example@gmail.com', 'password' => 'password']);
    }

    public function testLoginWithWrongPassword()
    {
        $this->dao = $this->createConfiguredMock(UserDao::class, ['get_user_by_email' => [['id' => 123, 'password' => 'wrongPassword']]]);
        $this->service = new UserService($this->dao);

        $this->expectExceptionMessage("Wrong password");
        $this->service->login(['email' => 'example@gmail.com', 'password' => 'password']);
    }

    public function testLoginWithCorrectPassword()
    {
        $password = 'testPassword';
        $hasedPassword = md5($password);
        $this->dao = $this->createConfiguredMock(UserDao::class, ['get_user_by_email' => [['id' => 123, 'password' => $hasedPassword]]]);
        $this->service = new UserService($this->dao);

        $result = $this->service->login(['email' => 'example@gmail.com', 'password' => $password]);
        $this->assertArrayHasKey('token', $result);
    }

    public function testLoginWrongPassExceptionCode()
    {
        $this->dao = $this->createConfiguredMock(UserDao::class, ['get_user_by_email' => [['id' => 123, 'password' => 'wrongPassword']]]);
        $this->service = new UserService($this->dao);

        $this->expectExceptionCode(400);
        $this->service->login(['email' => 'example@gmail.com', 'password' => 'password']);

    }

    public function testLoginForUnknownUserExceptionCode()
    {
        $this->dao = $this->createConfiguredMock(UserDao::class, ['get_user_by_email' => []]);
        $this->service = new UserService($this->dao);

        $this->expectExceptionCode(404);
        $this->service->login(['email' => 'example@gmail.com', 'password' => 'password']);
    }
}