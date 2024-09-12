<?php
include_once("templates/header.php");
include_once("process/software.php");
?>

<div id="main-banner">
    <h1>Faça seu pedido!</h1>
</div>
<div id="main-container">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Monte seu software como desejar:</h2>
                <form action="process/software.php" method="POST" id="software-form">
                <div class="form-group">
                        <label for="investimentos">Investimentos:</label>
                        <select name="investimentos" id="investimentos" class="form-control">
                        <option value="">Selecione o investimento do software!</option>
                            <?php foreach($investimento as $investimentos): ?>
                                <option value="<?= $investimentos["id"] ?>"><?= $investimentos["tipo"]?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tipos">Tipos:</label>
                        <select name="tipos" id="tipos" class="form-control">
                        <option value="">Selecione o tipo do software!</option>
                        <?php foreach($tipo as $tipos): ?>
                                <option value="<?= $tipos["id"] ?>"><?= $tipos["tipo"]?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="pacotes_extras">Pacotes Extras: (Máximo 3)</label>
                        <select multiple name="pacotes_extras[]" id="pacotes_extras" class="form-control">
                        <?php foreach($pacotes_extra as $pacotes_extras): ?>
                                <option value="<?= $pacotes_extras["id"] ?>"><?= $pacotes_extras["nome"]?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Fazer pedido!">
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>
  
<?php
include_once("templates/footer.php");
?>



    