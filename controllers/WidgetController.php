<?php
/**
 * WidgetController class file.
 * @copyright (c) 2015, bariew
 * @license http://www.opensource.org/licenses/bsd-license.php
 */

namespace bariew\commentAbstractModule\controllers;

use bariew\abstractModule\controllers\AbstractModelController;
use yii\web\Controller;
use \bariew\commentAbstractModule\models\Comment;
use \yii\db\ActiveRecord;

/**
 * This actions render content for widgets.
 * You can get it with url query or with UrlView widget.
 * This is for controlling widget content access by rbac.
 * 
 * 
 * @example 
    <?= \bariew\yii2Tools\widgets\UrlView::widget([
        'url' => '/comment/widget/comment', 
        'params' => ['parent' => $model]
    ]); ?> 
    
    <?= \bariew\yii2Tools\widgets\UrlView::widget([
        'url' => '/comment/widget/list', 
        'params' => ['parent' => $model]
    ]); ?> 
 * 
 * @author Pavel Bariev <bariew@yandex.ru>
 */
class WidgetController extends AbstractModelController
{
    public $modelName = 'Comment';

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [];
    }

    public function actionComment(ActiveRecord $parent)
    {
        /** @var Comment $model */
        $model = $this->findModel();
        $model->parent_class = get_class($parent);
        $model->parent_id = $parent->primaryKey;
        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            $model = $this->findModel();
            \Yii::$app->session->setFlash('success', \Yii::t('modules/comment', "Comment added"));
        }
        return $this->renderPartial('comment', compact('model'));
    }
    
    public function actionList(ActiveRecord $parent)
    {
        $comments = $this->findModel()->search()->where([
            'parent_class' => get_class($parent),
            'parent_id' => $parent->primaryKey,
        ])->orderBy(['created_at' => SORT_DESC])->all();
        return $this->renderPartial('list', [
            'dataProvider' => new \yii\data\ArrayDataProvider([
                'allModels' => $comments,
            ])
        ]);
    }
}
