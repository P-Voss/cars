<?php

namespace App\Repository;

use App\Entity\Car;

interface CarRepositoryInterface
{

    public function fetchAll() : array;

    public function fetch(int $carId) : Car;

    public function create(Car $car) : string;

    public function update(Car $car) : void;

    public function delete(int $carId) : void;
}