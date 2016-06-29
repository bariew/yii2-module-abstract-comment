<?php
/* @var $this yii\web\View */
/* @var $searchModel bariew\commentAbstractModule\models\CommentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>
<?php foreach($dataProvider->getModels() as $comment): ?>
    <div class="comment">
        <strong class="author"><?= $comment->user->username ?></strong>
        <em class="date text-muted small"><?= Yii::$app->formatter->asDatetime($comment->created_at) ?></em>
        <blockquote class="content small"><?= $comment->content ?></blockquote>
    </div>
<?php endforeach; ?>