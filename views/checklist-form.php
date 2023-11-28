<?php require_once __DIR__ . '/inicio-html.php'; ?>

<link rel="stylesheet" href="./public/node_modules/bootstrap/dist/css/book-form/book-form.css">

    <h1 class="new-book-form-title">Adicione um checklist!</h1>

<div class=form-container>
    <div class= 'form-items-container bg-primary'>
    <form class="form-box" enctype="multipart/form-data"
          method="post">
            <h2 class="form-title text-white bg-dark" style="border-radius:10px">Informações do checklist:</h2>
                <div class="form-fields">
                    
                    <div class="form-field">
                        <label for="month">Mês do checklist:</label>
                        <select name="month"
                               class="form-select"  
                               required
                               id='month'>
                               <?php foreach($months as $month) {
                                    $selected=" ";
                                    if ($checklist->checklistMonth == $month->month) {
                                        $selected = " selected=\"selected\" ";
                                    }
                                    echo '<option' . $selected . 'value="'. $month->id . '">' . $month->month . '</option> ';
                               } ?>
                        </select>
                    </div>
    
                    <div class="form-field">
                        <label for="year">Ano do checklist:</label>
                        <input name="year" 
                               class="form-control"
                               value="<?= $checklist?->checklistYear; ?>" 
                               type="number" min="1900" max="2099" step="1"
                               placeholder="Ex: 2024" 
                               id='year' />
                    </div>

                </div>
                <div class="send-button">
                    <input class="form-button btn btn-dark text-white" type="submit" value="Enviar" />
                </div> 
            </form>
    </div>
</div>
