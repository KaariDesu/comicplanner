<?php require_once __DIR__ . '/inicio-html.php' ?>

<link rel="stylesheet" href="./public/node_modules/bootstrap/dist/css/checklist\checklist-details.css">

<div class="checklist-basic-info">
    <h1 class="checklist-title">Checklist <?= $checklist->checklistMonth; ?> de <?= $checklist->checklistYear; ?></h1>
    <div class="checklist-prices">
        <p class="price">Gasto Médio: R$<?= number_format($checklist->averageExpense, 2); ?></p>
        <p class="price">Gasto Total: R$<?= number_format($checklist->totalExpense, 2); ?> </p>
    </div>
</div>

<ul class='books-container'>

    <?php
        if ($checklist->books !== null):
            foreach ($checklist->books as $book) : 
    ?>
    <div style="position: relative">
        <li class= 'book-item bg-primary'>
        <figure class="figure">
        <img src="/public/img/uploads/<?= $book->imagePath ?>" class="figure-img img-fluid rounded book-cover" alt="...">
        </figure>
        <div style="position: relative">
        <h4><?= $book->title; ?></h4>
        <p><?= 'R$' . number_format($book->price, 2); ?></p>
        <p><?= 'Prioridade: ' . $book->priority; ?></p>
        <p><?= 'Status: ' . $book->bookStatus; ?></p>
        <p><?='Lojista: ' . $book->retailer; ?></p>
        <div class="book-actions" style="position: absolute; bottom: 0">
                        <a href="/edit-book?id=<?= $book->id; ?>">Editar</a>
                        <a href="/delete-book?id=<?= $book->id; ?>&checklistId=<?= $book->checklistId; ?>">Excluir</a>
        </div>
        </div>
        </li>
    </div>

    <?php 
            endforeach;
        endif;
    ?>

    <li class= 'new-book-container bg-primary'>
            <a href="/new-book?checklistId=<?=$checklist->id?>" class="new-book-icon" ><img src="/public/img/icons/new-book-icon.png" class="new-book-icon" alt="..."></a>
    </li>
</ul>
