<?php require_once __DIR__ . '/inicio-html.php'; ?>

<link rel="stylesheet" href="./public/node_modules/bootstrap/dist/css/book-form/book-form.css">

    <h1 class="new-book-form-title">Adicione um livro!</h1>

<div class=form-container>
    <div class= 'form-items-container bg-primary'>
    <form class="form-box" enctype="multipart/form-data"
          method="post">
            <h2 class="form-title text-white bg-dark" style="border-radius:10px">Informações do livro:</h2>
                <div class="form-fields">
                    <div class="form-field">
                        <label for="title">Título:</label>
                        <input name="title" 
                               class="form-control"
                               value="<?= $book?->title; ?>" 
                               required
                               placeholder="Ex: One Piece 3 em 1 - 21" 
                               id='title' />
                    </div>

                    <input type="hidden" id="checklistId" name="checklistId" value="<?= $book?->checklistId; ?>">
    
                    <div class="form-field">
                        <label for="price">Preço:</label>
                        <input name="price" 
                               class="form-control"
                               value="<?= $book?->price; ?>" 
                               required
                               placeholder="Ex: 84.90" 
                               id='price' />
                    </div>

                    <div class="form-field">
                        <label for="priority">Prioridade:</label>
                        <select name="priority"
                               class="form-select"  
                               required
                               id='priority'>
                               <?php foreach($priorities as $priority) {
                                    $selected=" ";
                                    if ($book->priority == $priority->priority) {
                                        $selected = " selected=\"selected\" ";
                                    }
                                    echo '<option' . $selected . 'value="'. $priority->id . '">' . $priority->priority . '</option> ';
                               } ?>
                        </select>
                    </div>

                    <div class="form-field">
                        <label for="book-status">Status:</label>
                        <select name="book-status"
                               class="form-select"  
                               required
                               id='book-status'>
                               <?php foreach($bookStatuses as $bookStatus) {
                                    $selected=" ";
                                    if ($book->bookStatus == $bookStatus->bookStatus) {
                                        $selected = " selected=\"selected\" ";
                                    }
                                    echo '<option' . $selected . 'value="'. $bookStatus->id . '">' . $bookStatus->bookStatus . '</option> ';
                               } ?>
                        </select>
                    </div>
    
                    <div class="form-field">
                        <label for="retailer">Lojista:</label>
                        <select name="retailer"
                               class="form-select" 
                               required
                               id='retailer'>
                               <?php foreach($retailers as $retailer) {
                                    $selected=" ";
                                    if ($book->retailer == $retailer->retailer) {
                                        $selected = " selected=\"selected\" ";
                                    }
                                    echo '<option' . $selected . 'value="'. $retailer->id . '">' . $retailer->retailer . '</option> ';
                               } ?>
                        </select>
                    </div>
    
                    <div class="form-field">
                        <label for="image">Imagem do vídeo:</label>
                        <input name="image"
                            class="form-control"
                            accept="image/*"
                            type="file"
                            id='image' />
                    </div>
                </div>
                <div class="send-button">
                    <input class="form-button btn btn-dark text-white" type="submit" value="Enviar" />
                </div> 
            </form>
    </div>
</div>
