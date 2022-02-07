<?php
ini_set('display_errors', 1);

include './../vendor/autoload.php';

$repository = new \App\Repository\Postgres\CarRepository();
$request = $_SERVER['REDIRECT_URL'] ?? $_SERVER['REQUEST_URI'];

switch ($request) {
    case '/show' :
        try {
            $view = new \App\View\DetailView($repository);
            echo $view->render((int) $_GET['car'] ?? 1);
            exit;
        } catch (Exception $exception) {
            header('Location:/list');
            exit;
        }

    case '/new':
        $view = new \App\View\CreateView();
        echo $view->render();
        exit;

    case '/create':
        $car = new \App\Entity\Car();
        $car->setBrand($_POST['brand'])
            ->setModel($_POST['model'])
            ->setColor($_POST['color'])
            ->setHp((int) $_POST['hp'])
            ->setPrice($_POST['price']);
        $repository->create($car);
        header('Location:/list');
        exit;

    case '/update':
        $car = new \App\Entity\Car();
        $car->setId((int) $_POST['carId'])
            ->setBrand($_POST['brand'])
            ->setModel($_POST['model'])
            ->setColor($_POST['color'])
            ->setHp((int) $_POST['hp'])
            ->setPrice($_POST['price']);
        $repository->update($car);
        header('Location:/list');
        exit;

    case '/delete':
        $repository->delete((int) $_POST['car']);
        header('Location:/list');
        exit;

    case '/list':
    default:
        $view = new \App\View\ListView($repository);
        echo $view->render();
        exit;
}


