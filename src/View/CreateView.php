<?php

namespace App\View;

use App\Repository\AbstractCarRepository;

/**
 * Class CreateView
 * @package App\View
 */
class CreateView {

    public function render(): string {
        ob_start();
        include __DIR__ . '/../../templates/CreateView.phtml';
        $html = ob_get_contents();
        ob_end_clean();
        return $html;
    }

}

