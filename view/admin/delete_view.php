<?php ob_start(); ?>
<nav id="nav">
    <ul style="list-style: none;">
        <li><a href="?action=create">Créer un chap.</a></li>
        <li><a href="?action=displayChapter">Voir les chap.</a></li>
        <li><a href="?action=update">Mettre à jour</a></li>
        <li><a href="?action=delete">Supprimer</a></li>
        <li><a href="?action=list">Commentaires</a></li>
    </ul>
</nav>
<p style="text-align: center">Chapitres :
    <?php for ($i = 1 ; $i <= $number_rows; $i++): ?>
        <a href="?action=delete&chapter=<?php echo $i ?>" style="padding: 0.6em"><?= $i;?></a>
    <?php endfor; ?>
</p>
<table style="background-color: white">
    <?php foreach ($chapters as $chapter): ?>
    <thead style="font-size: 2em">Titre du chapitre</thead>
        <?= $chapter['title'] ?>
    <?php endforeach; ?>
</table>
<?php $content = ob_get_clean(); ?>
<?php require 'view/template.php'; ?>
