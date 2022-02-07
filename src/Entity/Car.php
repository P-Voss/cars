<?php

namespace App\Entity;

/**
 * Description of Car
 * @author VPh
 */
class Car implements \JsonSerializable {

    private int $id;
    private string $brand;
    private string $model;
    private int $hp;
    private string $color;
    private float $price;

    /**
     * @return int
     */
    public function getId() : int {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Car
     */
    public function setId(int $id) : Car {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getBrand() : string {
        return $this->brand;
    }

    /**
     * @param string $brand
     * @return Car
     */
    public function setBrand(string $brand) : Car {
        $this->brand = $brand;

        return $this;
    }

    /**
     * @return string
     */
    public function getModel() : string {
        return $this->model;
    }

    /**
     * @param string $model
     * @return Car
     */
    public function setModel(string $model) : Car {
        $this->model = $model;

        return $this;
    }

    /**
     * @return int
     */
    public function getHp() : int {
        return max([$this->hp, 1]);
    }

    /**
     * @param int $hp
     * @return Car
     */
    public function setHp(int $hp) : Car {
        $this->hp = $hp;

        return $this;
    }

    /**
     * @return string
     */
    public function getColor() : string {
        return $this->color;
    }

    /**
     * @param string $color
     * @return Car
     */
    public function setColor(string $color) : Car {
        $this->color = $color;

        return $this;
    }

    /**
     * @return float
     */
    public function getPrice() : float {
        return max(round($this->price, 2), 100.00);
    }

    /**
     * @param float $price
     * @return Car
     */
    public function setPrice(float $price) : Car {
        $this->price = $price;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray() : array {
        return [
            'carId' => $this->id,
            'brand' => $this->brand,
            'model' => $this->model,
            'hp' => $this->getHp(),
            'color' => $this->color,
            'price' => $this->getPrice()
        ];
    }

    /**
     * @return string
     */
    public function __toString() {
        return $this->brand . ' - ' . $this->model . ' (' . $this->getPrice() . '€)';
    }

    /**
     * @return array
     */
    public function jsonSerialize() {
        return $this->toArray();
    }


}