<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel bariew\commentAbstractModule\models\CommentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('modules/comment', 'Comments');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comment-index">

    <h1><?= Html::encode($this->title) ?>
        <?= Html::a(Yii::t('modules/comment', 'Create Comment'), ['create'], ['class' => 'btn btn-success pull-right']) ?>
    </h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'link:raw',
            \bariew\yii2Tools\helpers\GridHelper::listFormat($searchModel, 'user_id'),
            \bariew\yii2Tools\helpers\GridHelper::dateFormat($searchModel, 'created_at'),
            'content:ntext',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
