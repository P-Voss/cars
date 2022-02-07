<?php

namespace App\View;

use App\Repository\AbstractCarRepository;

/**
 * Class ListView
 * @package App\View
 */
class ListView {

    private AbstractCarRepository $carRepository;

    public function __construct(AbstractCarRepository $carRepository) {
        $this->carRepository = $carRepository;
    }

    public function render(): string {
        $cars = $this->carRepository->fetchAll();

        ob_start();
        include __DIR__ . '/../../templates/ListView.phtml';
        $html = ob_get_contents();
        ob_end_clean();
        return $html;
    }

}

