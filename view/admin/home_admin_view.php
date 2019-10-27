<?php ob_start(); ?>
<?php if(isset($_SESSION['admin_connect'])): ?>
    <nav id="navAdmin">
        <ul style="list-style: none;">
            <li><a href="?action=create">Créer un chapitre</a></li>
            <li><a href="?action=logAdmin">Panel</a></li>
            <li><a href="?action=read_comments">Gérer les commentaires</a></li>
        </ul>
    </nav>
    <table id="panelAdmin">
        <tr>
            <th>Id Chapitre</th>
            <th>Titre</th>
        </tr>
        <?php foreach ($chapters as $chapter): ?>
            <tr>
                <td id="idPanel"><?= $chapter['chapter_id'] ?></td>
                <td id="chapterPanel"><?= $chapter['title'] ?></td>
                <td><button><a href="./index.php?action=displayChapter&chapter_id=<?= $chapter['chapter_id'] ?>">Lire</a></button</td>
                <td><button><a href="./index.php?action=read_comments&chapter_id=<?= $chapter['chapter_id'] ?>">Voir commentaires</a></button></td>
                <td><button><a href="./index.php?action=update_chapter&chapter_id=<?= $chapter['chapter_id'] ?>">Modifier</a></button></td>
                <td><button><a href="./index.php?action=delete&chapter_id=<?= $chapter['chapter_id'] ?>">Supprimer</a></button></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <form method='POST' action='' class='form1'>
        <p style='text-align: center'>Se connecter</p>
        <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <input type="text" name='admin' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" required>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Mot de passe</label>
            <input type="password" name='pass' class="form-control" id="exampleInputPassword1" placeholder="" required>
        </div>
        <button type="submit" class="btn btn-primary">Se connecter</button>
    </form>
<?php endif; ?>
<?php $content = ob_get_clean(); ?>
<?php require 'view/template.php'; ?>