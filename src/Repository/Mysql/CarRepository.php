<?php

namespace App\Repository\Mysql;

/**
 * Description of CarRepository
 * @author VPh
 */
class CarRepository extends \App\Repository\AbstractCarRepository {

    protected function getDbHandler() : \PDO {
        return new \PDO("....");
    }


}