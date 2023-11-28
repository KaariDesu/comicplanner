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

return [
    'GET|/checklist' => ChecklistDetailsController::class,
    'GET|/edit-book' => BookFormController::class,
    'POST|/edit-book' => EditBookController::class,
    'GET|/new-book' => BookFormController::class,
    'POST|/new-book' => NewBookController::class,
    'GET|/delete-book' => DeleteBookController::class,
    'GET|/checklist-list' => ChecklistListController::class,
    'GET|/edit-checklist' => ChecklistFormController::class,
    'GET|/new-checklist' => ChecklistFormController::class,
    'POST|/edit-checklist' => EditChecklistController::class,
    'POST|/new-checklist' => NewChecklistController::class,
    'GET|/delete-checklist' => DeleteChecklistController::class,
    'GET|/refresh-checklist' => RefreshChecklistController::class,
];