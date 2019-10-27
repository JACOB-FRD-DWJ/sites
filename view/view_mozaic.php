<?php ob_start(); ?>
<p id="titleChapter">Chapitres :
    <?php foreach ($chapters as $chapter_for_enum): ?>
        <a href="index.php?action=read&chapter_id=<?= $chapter_for_enum['chapter_id'] ?>" style="padding: 0.6em"><?= $chapter_for_enum['chapter_id']?></a>
    <?php endforeach; ?>
</p>
<div id="mozaicDiv"">
    <?php foreach ($chapters as $chapter): ?>
    <a id="divChapter" href="index.php?action=read&chapter_id=<?= $chapter['chapter_id']?>">
        <?= $chapter['title'] ?>
        <img src="<?= $chapter['image'] ?>" style="width: 100%;">
    </a>
    <?php endforeach; ?>
</div>
<?php $content = ob_get_clean(); ?>
<?php require 'template.php'; ?>
