<?php
require_once 'BaseService.php';
require_once __DIR__ . "/../dao/PetsDao.class.php";
class PetService extends BaseService
{
    private $pet_dao;
    public function __construct()
    {
        parent::__construct(new PetsDao);
    }
}
?>