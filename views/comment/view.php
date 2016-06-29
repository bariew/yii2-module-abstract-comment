<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model bariew\commentAbstractModule\models\Comment */

$this->title = Yii::t('modules/comment', 'Comment #{id}', ['id' => $model->id]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('modules/comment', 'Comments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comment-view">

    <h1><?= Html::encode($this->title) ?>
        <div class="pull-right">
        <?= Html::a(Yii::t('modules/comment', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary'])
         .' '. Html::a(Yii::t('modules/comment', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('modules/comment', 'Are you sure you want to delete this comment?'),
                'method' => 'post',
            ],
        ]) ?>
        </div>
    </h1>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user_id',
            'link',
            'branch_id',
            'content:ntext',
            'created_at:datetime',
            'updated_at:datetime',
            'status:boolean',
        ],
    ]) ?>
</div>
