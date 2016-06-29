<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model bariew\commentAbstractModule\models\Comment */

$this->title = Yii::t('modules/comment', 'Create Comment');
$this->params['breadcrumbs'][] = ['label' => Yii::t('modules/comment', 'Comments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
