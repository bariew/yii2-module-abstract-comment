<?php
use bariew\commentAbstractModule\models\Comment;
/**
 * @var Comment[] $comments
 */
?>
<?php foreach($comments as $comment): ?>
    <div class="comment">
        <strong class="author"><?= $comment->user->username ?></strong>
        <em class="date text-muted small"><?= Yii::$app->formatter->asDate($comment->created_at) ?></em>
        <blockquote class="content small"><?= $comment->content ?></blockquote>
    </div>
<?php endforeach; ?>