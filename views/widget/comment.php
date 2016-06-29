<?php 
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>
<div class="comment-form">

    <?php $form = ActiveForm::begin(['id' => 'comment-form']); ?>

    <?= $form->field($model, 'content')->label(false)->textarea(['rows' => 6]) ?>

    <div class="form-group text-right">
        <?= Html::submitButton(Yii::t('modules/comment', 'Comment it'), ['class' => 'btn btn-success']) ?>
    </div>
    
    <?php ActiveForm::end(); ?>

</div>
