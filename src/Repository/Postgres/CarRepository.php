<?php

namespace App\Repository\Postgres;

/**
 * Description of CarRepository
 * @author VPh
 */
class CarRepository extends \App\Repository\AbstractCarRepository {

    protected function getDbHandler() : \PDO {
        return new \PDO("pgsql:host=localhost;port=5432;user=user;password=password;dbname=cars");
    }


}