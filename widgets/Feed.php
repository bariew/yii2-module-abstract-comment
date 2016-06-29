<?php
/**
 * Feed class file.
 * @copyright (c) 2015, Pavel Bariev
 * @license http://www.opensource.org/licenses/bsd-license.php
 */
namespace bariew\commentAbstractModule\widgets;


use bariew\commentAbstractModule\models\Comment;
use yii\base\Widget;
use yii\db\ActiveRecord;
/**
 * This is for displaying some model comments.
 *
 * @author Pavel Bariev <bariew@yandex.ru>
 *
 */
class Feed extends Widget
{
    public $viewFile = 'feed';
    /**
     * @var ActiveRecord the comment owner model
     */
    public $parent;

    public function run()
    {
        $comments = Comment::childClass(true)->search()
            ->orderBy(['created_at' => SORT_DESC])
            ->where([
                'parent_class' => $this->parent->className(),
                'parent_id' => $this->parent->primaryKey,
                'status' => Comment::STATUS_ACTIVE,
            ])->with('user')
            ->all();
        if (!$comments) {
            return;
        }
        return $this->render($this->viewFile, compact('comments'));
    }

}