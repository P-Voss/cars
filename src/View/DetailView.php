<?php

namespace App\View;

use App\Repository\AbstractCarRepository;

/**
 * Class ListView
 * @package App\View
 */
class DetailView {

    private AbstractCarRepository $carRepository;

    public function __construct(AbstractCarRepository $carRepository) {
        $this->carRepository = $carRepository;
    }

    /**
     * @param int $carId
     * @return string
     * @throws \Exception
     */
    public function render(int $carId): string {
        $car = $this->carRepository->fetch($carId);

        ob_start();
        include __DIR__ . '/../../templates/DetailView.phtml';
        $html = ob_get_contents();
        ob_end_clean();
        return $html;
    }

}

