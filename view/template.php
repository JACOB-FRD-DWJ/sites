<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <title>Billet pour l'Alaska</title>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Caesar+Dressing&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/1dd905adb3.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Cookie|Satisfy&display=swap" rel="stylesheet">
        <script src="https://cdn.tiny.cloud/1/sk8yds8yerjs5fum10u6w81fyknmw3v0z86dlx9bm9pe62lb/tinymce/5/tinymce.min.js"></script>
        <link rel="stylesheet" type="text/css" href="media/css/desktop.css">
        <link rel="stylesheet" type="text/css" href="media/css/tab.css">
        <link rel="stylesheet" type="text/css" href="media/css/phone.css">
        <script type="text/javascript" src="js/flash_message_effect.js"></script>
    </head>
    <body>
    <header>
        <a href="#" onclick="location.href = 'index.php'" id="titleSite">Billet Pour L'Alaska</a>
        <?php if(isset($_SESSION['user_connect'])): ?>
            <div id="divConnectRegistration">
             <a href="./index.php?action=logout" id="buttonArticle" class="hvr-sweep-to-left">Se déconnecter</a>
            </div>
        <?php elseif(isset($_SESSION['admin_connect'])): ?>
            <div id="divConnectRegistration" style="width: 30%">
                <a href="?action=logoutAdmin" id="buttonArticle">Se déconnecter</a>
            </div>
        <?php elseif(!isset($_SESSION['user_connect'])): ?>
            <div id="divConnectRegistration">
                <a href="index.php?action=registration">S'inscrire</a>
                <a href="index.php?action=login">Se connecter</a>
            </div>
        <?php endif; ?>
    </header>
        <?= $content ?>
    </body>
    <footer>

    </footer>
    <script type="text/javascript" src="js/displayChapters.js"></script>
    <script type="text/javascript" src="js/commentPadding.js"></script>
    <script type="text/javascript" src="js/focus_chapter.js"></script>
    <script type="text/javascript" src="js/flash_message_effect.js"></script>
    <script type="text/javascript" src="tinymce.js"></script>
</html>