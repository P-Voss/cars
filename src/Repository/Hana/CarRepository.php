<?php

namespace App\Repository\Hana;

/**
 * Description of CarRepository
 * @author VPh
 */
class CarRepository extends \App\Repository\AbstractCarRepository {

    protected function getDbHandler() : \PDO {
        return new \PDO("odbc:host=localhost;port=5432;dbname=cars;user=user;password=password");
    }


}