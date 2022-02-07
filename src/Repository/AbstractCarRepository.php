<?php

namespace App\Repository;

use App\Entity\Car;

/**
 * Description of AbstractCarRepository
 * @author VPh
 */
abstract class AbstractCarRepository {

    /**
     * @var \PDO
     */
    protected $dbHandler;

    /**
     * AbstractCarRepository constructor.
     */
    public function __construct() {
        $this->dbHandler = $this->getDbHandler();
    }

    /**
     * @return Car[]
     */
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

    /**
     * @param int $carId
     * @return Car
     * @throws \Exception
     */
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

    /**
     * @param Car $car
     * @return string
     */
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

    /**
     * @param Car $car
     */
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

    /**
     * @param int $carId
     */
    public function delete(int $carId) : void {
        $sql = "DELETE FROM car WHERE carid = ?";
        $statement = $this->dbHandler->prepare($sql);
        $statement->execute([$carId]);
    }


    /**
     * @return \PDO
     */
    abstract protected function getDbHandler(): \PDO;

}