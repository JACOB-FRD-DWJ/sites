<?php ob_start(); ?>
<nav id="navAdmin">
    <ul style="list-style: none;">
        <li><a href="?action=create">Créer un chap.</a></li>
        <li><a href="?action=displayChapter">Voir les chap.</a></li>
        <li><a href="?action=list">Commentaires</a></li>
        <li><a href="?action=logAdmin">Retour</a></li>
    </ul>
</nav>
<?php if ($_GET['action'] === "create"): ?>
    <div id="formChapter">
        <form method="post" action="">
            <hr class="separaterChapter">
            <h3>Titre du chapitre</h3>
            <textarea id="title" name="title"></textarea>
            <hr class="separaterChapter">
            <h3>Insertion de l'image de présentation</h3>
            <label>
                Image<input type="file" name="image" style="visibility: hidden">
            </label>
            <hr class="separaterChapter">
            <h3>Contenu du chapitre</h3>
            <textarea id="contain" name="contain"></textarea>
            <button type="submit">POSTER LE CHAPITRE</button>
        </form>
    </div>
<?php endif; ?>
<?php $content = ob_get_clean(); ?>
<?php require 'view/template.php'; ?>
