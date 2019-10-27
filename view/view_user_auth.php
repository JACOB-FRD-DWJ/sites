<?php
    ob_start();
?>
</header>
<?php if(isset($_SESSION['error_connect'])): ?>
    <?php
        require 'view/Session_message_flash.php';
        $message_flash = new Session_message_flash();
        $message_flash->set_flash("Problème d'authentification.");
        $message_flash->flash();
    ?>
<?php endif; ?>
<form method='POST' action='./index.php' class='form1'>
    <p style='text-align: center'>Se connecter</p>
    <div class="form-group">
        <label for="exampleInputEmail1">Email</label>
        <input type="email" name='emailConnect' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" required>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Mot de passe</label>
        <input type="password" name='passwordConnect' class="form-control" id="exampleInputPassword1" placeholder="" required>
    </div>
    <button type="submit" class="btn btn-primary">Se connecter</button>

</form>
<a href="./index.php">Retour</a>
<?php $content = ob_get_clean();?>
<?php require 'template.php'?>
