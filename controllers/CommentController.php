<?php

namespace bariew\commentAbstractModule\controllers;

use bariew\abstractAbstractModule\controllers\AbstractModelController;
use Yii;
use yii\filters\VerbFilter;

/**
 * CommentController implements the CRUD actions for Comment model.
 */
class CommentController extends AbstractModelController
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }
}
