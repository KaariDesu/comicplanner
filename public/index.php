<?php

declare(strict_types=1);

use ComicPlanner\Controller\ChecklistDetailsController;
use ComicPlanner\Controller\BookFormController;
use ComicPlanner\Controller\EditBookController;
use ComicPlanner\Controller\NewBookController;
use ComicPlanner\Controller\DeleteBookController;
use ComicPlanner\Controller\ChecklistListController;
use ComicPlanner\Controller\ChecklistFormController;
use ComicPlanner\Controller\EditChecklistController;
use ComicPlanner\Controller\NewChecklistController;
use ComicPlanner\Controller\DeleteChecklistController;
use ComicPlanner\Controller\RefreshChecklistController;
use ComicPlanner\Controller\Error404Controller;

require_once __DIR__ . '/../vendor/autoload.php';

$pdo = new PDO('mysql:host=db;port=3307;dbname=comicplanner', 'root', 'root');

$routes = require_once __DIR__ . '/../config/routes.php';

$pathInfo = $_SERVER['PATH_INFO'] ?? '/';
$httpMethod = $_SERVER['REQUEST_METHOD'];

$key="$httpMethod|$pathInfo";
if (array_key_exists($key,$routes)) {
$controllerClass = $routes["$httpMethod|$pathInfo"];
$controller = new $controllerClass($pdo);
} else {
    $controller = new Error404Controller();
}
$controller->processaRequisicao();