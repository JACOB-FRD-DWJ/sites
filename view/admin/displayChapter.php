<?php ob_start(); ?>
<?php if (!isset($_SESSION['admin_connect'])): ?>
    <form method='POST' action='./index.php' class='form1'>
        <p style='text-align: center'>ADMIN</p>
        <div class="form-group">
            <label for="exampleInputEmail1"></label>
            <input type="text" name='admin' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" required>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1"></label>
            <input type="password" name='pass' class="form-control" id="exampleInputPassword1" placeholder="" required>
        </div>
        <button type="submit" class="btn btn-primary">Se connecter</button>
    </form>
<?php elseif($_SESSION['admin_connect'] == 1): ?>
    <nav id="navAdmin">
        <ul style="list-style: none;">
            <li><a href="?action=create">Créer un chap.</a></li>
            <li><a href="?action=displayChapter">Voir les chap.</a></li>
            <li><a href="?action=read_comments">Commentaires</a></li>
        </ul>
    </nav><br>
    <p id="titleChapter">Chapitres :
        <?php foreach ($chapters as $chapter_for_enum): ?>
            <a href="index.php?action=displayChapter&chapter_id=<?= $chapter_for_enum['chapter_id'] ?>" style="padding: 0.6em"><?= $chapter_for_enum['chapter_id']?></a>
        <?php endforeach; ?>
    </p>
    <div class="divArticle">
        <p><?= $chapter['title']; ?></p>
        <p>
            <img src="<?= $chapter['image']; ?>">
            <?= $chapter['chapter_contain']; ?>
        </p>
    </div>
<?php endif; ?>
<?php $content = ob_get_clean(); ?>
<?php require 'view/template.php'; ?>