<?php ob_start(); ?>
    <p id="titleChapter">Chapitres :
        <?php foreach ($chapters as $chapter_for_enum): ?>
            <a href="index.php?action=read&chapter_id=<?= $chapter_for_enum['chapter_id'] ?>" style="padding: 0.6em"><?= $chapter_for_enum['chapter_id']?></a>
        <?php endforeach; ?>
    </p>
    <div class="divArticle">
        <?= $chapter['title'] ?>
        <img src="<?= $chapter['image'] ?>" style="width: 100%;height: auto;margin: auto">
        <div id="containerChapterContain"><pre><?= $chapter['chapter_contain'] ?></pre></div>
        <div id="containerComment">
            <?php foreach ($comments as $comment): ?>
                <?php if($chapter['chapter_id'] == $comment['chapter_id']):?>
                    <?php if($comment['status'] != 1): ?>
                        <div id="div_comment" style="background-color: whitesmoke; padding: 1%">
                            <p id="commentNameDate" style="text-align: inherit">posté par : <span class="nameDate"><?= $comment['pseudo']; ?></span> le <span class="nameDate"><?= $comment['date'] ?></span></p>
                            <span class="commentChapter"><?= $comment['commentaires']; ?></span>
                            <?php if (isset($_SESSION['user_connect'])): ?>
                                <button id="signalButton">
                                    <a href="index.php?action=userSignalComment&chapter_id=<?= $chapter['chapter_id']?>&comment_id=<?= $comment['id'] ?>">signaler</a>
                                </button>
                            <?php else: ?>

                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <?php if (isset($_SESSION['user_connect'])): ?>
            <form method="post" action="index.php?action=userComment&chapter_id=<?php echo $chapter['chapter_id']?>" >
                <div class="form-group">
                    <label for="exampleFormControlTextarea1"></label>
                    <textarea class="form-control" name="commentaires" id="exampleFormControlTextarea1" rows="3"></textarea>
                    <button type="submit" class="btn btn-primary" style="margin: 5% 0;">Commentez</button>
                </div>
            </form>
        <?php else: ?>

        <?php endif; ?>
    </div>
<?php $content = ob_get_clean(); ?>
<?php require 'template.php' ?>
