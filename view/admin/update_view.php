<?php ob_start(); ?>
<nav id="navAdmin">
    <ul style="list-style: none;">
        <li><a href="?action=create">Créer un chap.</a></li>
        <li><a href="?action=delete">Supprimer</a></li>
        <li><a href="?action=read_comments">Commentaires</a></li>
        <li><a href="?action=logAdmin">Retour</a></li>
    </ul>
</nav>
<p style="text-align: center">Chapitres :
    <?php foreach ($chapters as $chapter_for_enum): ?>
        <a href="index.php?action=update_chapter&chapter_id=<?= $chapter_for_enum['chapter_id'] ?>" style="padding: 0.6em"><?= $chapter_for_enum['chapter_id'];?></a>
    <?php endforeach; ?>
</p>
<div id="formChapter">
    <form method="post" action="">
        <hr class="separaterChapter">
        <h3>Titre du chapitre</h3>
        <textarea id="title" name="title"><?= $chapter['title'] ?></textarea>
        <hr class="separaterChapter">
        <h3>Insertion de l'image de présentation</h3>
        <label>
            Image<input type="file" name="image" style="visibility: hidden">
        </label>
        <hr class="separaterChapter">
        <h3>Contenu du chapitre</h3>
        <textarea id="contain" name="contain"><?= $chapter['chapter_contain'] ?></textarea>
        <button type="submit">POSTER LE CHAPITRE</button>
    </form>
</div>
<?php $content = ob_get_clean(); ?>
<?php require 'view/template.php'; ?>


