<?php ob_start(); ?>
<form method='POST' action='#' class='form0'>
    <p style='text-align: center'>S'inscrire</p>
    <div class="form-group">
        <label for="exampleInputEmail1">Email</label>
        <input type="email" name="emailRegistration" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" required>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Pseudo</label>
        <input type="text" name="pseudoRegistration" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" required>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Mot de passe</label>
        <input type="password" name="passwordRegistration" class="form-control" id="exampleInputPassword1" placeholder="" required>
    </div>
    <button type="submit" class="btn btn-primary">S'inscrire</button>
</form>
<a href="./index.php">Retour</a>
<?php $content = ob_get_clean();?>
<?php require 'template.php'?>
