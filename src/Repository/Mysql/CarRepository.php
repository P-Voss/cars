<?php

namespace App\Repository\Mysql;

use App\Entity\Car;
use App\Repository\CarRepositoryInterface;

/**
 * Description of CarRepository
 * @author VPh
 */
class CarRepository implements CarRepositoryInterface {

    private \PDO $dbHandler;

    public function __construct()
    {
        return new \PDO("....");
    }

    public function fetchAll() : array {
        $cars = [];
        $result = $this->dbHandler->query("SELECT * FROM car ORDER BY carid ASC")->fetchAll();
        foreach ($result as $row) {
            $car = new Car();
            $car->setId($row['carid'])
                ->setBrand($row['brand'])
                ->setModel($row['model'])
                ->setHp($row['hp'])
                ->setColor($row['color'])
                ->setPrice($row['price']);
            $cars[] = $car;
        }

        return $cars;
    }

    public function fetch(int $carId) : Car {
        $sql = "SELECT * FROM car WHERE carid = ?";
        $statement = $this->dbHandler->prepare($sql);
        $statement->execute([$carId]);

        $row = $statement->fetch();

        if (!$row) {
            throw new \Exception("Car with id " . $carId ." does not exist");
        }

        $car = new Car();
        $car->setId($row['carid'])
            ->setBrand($row['brand'])
            ->setModel($row['model'])
            ->setHp($row['hp'])
            ->setColor($row['color'])
            ->setPrice($row['price']);

        return $car;
    }

    public function create(Car $car) : string {
        $sql = "INSERT INTO car (brand, model, hp, color, price) VALUES (?, ?, ?, ?, ?)";
        $statement = $this->dbHandler->prepare($sql);
        $statement->execute([
            $car->getBrand(),
            $car->getModel(),
            $car->getHp(),
            $car->getColor(),
            $car->getPrice()
        ]);

        return $this->dbHandler->lastInsertId();
    }

    public function update(Car $car) : void {
        $sql = "UPDATE car SET brand = ?, model = ?, hp = ?, color = ?, price = ? WHERE carid = ?";
        $statement = $this->dbHandler->prepare($sql);
        $statement->execute([
            $car->getBrand(),
            $car->getModel(),
            $car->getHp(),
            $car->getColor(),
            $car->getPrice(),
            $car->getId()
        ]);
    }

    public function delete(int $carId) : void {
        $sql = "DELETE FROM car WHERE carid = ?";
        $statement = $this->dbHandler->prepare($sql);
        $statement->execute([$carId]);
    }

}