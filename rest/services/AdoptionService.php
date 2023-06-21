<?php
require_once 'BaseService.php';
require_once __DIR__ . "/../dao/AdoptionDao.class.php";
class AdoptionService extends BaseService
{
    private $adoption_dao;
    public function __construct()
    {
        parent::__construct(new AdoptionDao);
    }
}
?>