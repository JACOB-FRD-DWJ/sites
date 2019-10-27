<?php ob_start(); ?>
    <nav id="navAdmin">
        <ul style="list-style: none;">
            <li><a href="?action=logAdmin">Panel</a></li>
            <li><a href="?action=create">Créer un chapitre</a></li>
            <li><a href="?action=read_comments">Gérer les commentaires</a></li>
        </ul>
    </nav><br>
    <table id="panelAdmin">
        <tr>
            <th>Chapitre </th>
            <th>Status</th>
            <th>Commentaire</th>
        </tr>
    <?php foreach ($comments as $comment): ?>
    <tr>
        <?php if ($comment['status'] > 0): ?>
            <td><?= $comment['chapter_id'] ?></td>
            <td><?= $comment['status'] ?></td>
            <td><?= $comment['commentaires'] ?></td>
            <td><button><a href="./index.php?action=valid_comment&comment_id=<?= $comment['id'] ?>">Valider</a></button></td>
            <td><button><a href="./index.php?action=delete_comment&comment_id=<?= $comment['id'] ?>">Supprimer</a></button></td>
        <?php endif; ?>
    </tr>
    <?php endforeach; ?>
    </table>
<?php $content = ob_get_clean(); ?>
<?php require_once 'view/template.php'; ?>