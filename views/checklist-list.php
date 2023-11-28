<?php require_once __DIR__ . '/inicio-html.php' ?>

<link rel="stylesheet" href="./public/node_modules/bootstrap/dist/css/checklist\checklist-details.css">

<div class="checklist-basic-info">
    <h1 class="checklist-title">
    <?php
        $checklistTypeId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if ($checklistTypeId == 1) {
            echo "Checklists Mensais";
        } else echo "Compras Extras";

    ?>
    </h1>
</div>

<ul class='books-container'>

    <?php
        if ($checklists !== null):
            foreach ($checklists as $checklist) : 
    ?>
    <div style="position: relative">
        <li class= 'book-item bg-primary'>
        <figure class="figure">
        <a href="/checklist?id=<?= $checklist->id ?>"><img src="/public/img/uploads/<?= $checklist->firstImagePath ?>" class="figure-img img-fluid rounded book-cover" alt="..."></a>
        </figure>
        <div style="position: relative">
        <h4><?php 
            if ($checklistTypeId == 1) {
                echo "Checklist";
            } else echo "Compras Extras";
        ?> <?= $checklist->checklistMonth; ?> de <?= $checklist->checklistYear; ?></h4>
        <p><?= 'Gasto total: ' . number_format($checklist?->totalExpense, 2); ?></p>
        <p><?= 'Gasto médio: ' . number_format($checklist?->averageExpense, 2); ?></p>
        <div class="book-actions" style=" position: absolute; bottom: 0; padding-bottom: 35px;">
                        <a href="/edit-checklist?id=<?= $checklist->id; ?>&checklistTypeId=<?= $checklist->checklistTypeId; ?>"> Data</a>
                        <?php if ($checklist->bookCount > 0): ?>
                        <a href="/refresh-checklist?id=<?= $checklist->id; ?>&checklistTypeId=<?= $checklist->checklistTypeId; ?>">Atualizar</a>
                        <?php endif ?>
                        <br>
                        
        </div>
        <div class="book-actions" style=" position: absolute; bottom: 0;">
                        <a href="/checklist?id=<?= $checklist->id;?>">Editar</a>
                        <a href="/delete-checklist?id=<?= $checklist->id; ?>&checklistTypeId=<?= $checklist->checklistTypeId; ?>">Excluir</a>
        </div>
        </div>
        </li>
    </div>

    <?php 
            endforeach;
        endif;
    ?>

    <li class= 'new-book-container bg-primary'>
            <a href="/new-checklist?checklistTypeId=<?= $checklistTypeId; ?>" class="new-book-icon" ><img src="/public/img/icons/new-book-icon.png" class="new-book-icon" alt="..."></a>
    </li>
</ul>
