<?php
/**
 * Comment class file.
 * @copyright (c) 2016, Pavel Bariev
 * @license http://www.opensource.org/licenses/bsd-license.php
 */

namespace bariew\commentAbstractModule\models;

use bariew\abstractAbstractModule\models\AbstractModel;
use bariew\yii2Tools\helpers\ModelHelper;
use bariew\yii2Tools\validators\ListValidator;
use Yii;
use yii\db\ActiveRecord;

/**
 * Description.
 *
 * Usage:

 * @property integer $id
 * @property integer $user_id
 * @property integer $owner_id
 * @property string $parent_class
 * @property integer $parent_id
 * @property integer $branch_id
 * @property string $content
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $status
 *
 * @author Pavel Bariev <bariew@yandex.ru>
 *
 */
class Comment extends AbstractModel
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 1;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
            ['status', 'default', 'value' => static::STATUS_ACTIVE],
            [['status'], ListValidator::className()],
            ['user_id', 'filter', 'filter' => function(){
                return $this->isNewRecord ? \Yii::$app->user->id : $this->user_id;
            }]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('modules/comment', 'ID'),
            'user_id' => Yii::t('modules/comment', 'User'),
            'owner_id' => Yii::t('modules/comment', 'Owner'),
            'parent_class' => Yii::t('modules/comment', 'Parent Class'),
            'parent_id' => Yii::t('modules/comment', 'Parent ID'),
            'branch_id' => Yii::t('modules/comment', 'Branch ID'),
            'content' => Yii::t('modules/comment', 'Content'),
            'created_at' => Yii::t('modules/comment', 'Created At'),
            'updated_at' => Yii::t('modules/comment', 'Updated At'),
            'status' => Yii::t('modules/comment', 'Active'),
            'link' => Yii::t('modules/comment', 'Link'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors() 
    {
        return [
            \yii\behaviors\TimestampBehavior::className(),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        $class = Yii::$app->user->identityClass;
        return static::hasOne($class, ['id' => 'user_id']);
    }

    /**
     * @return array
     */
    public function userList()
    {
        /** @var \yii\db\ActiveRecord $class */
        $class = Yii::$app->user->identityClass;
        return $class::find()->select('username')->orderBy('username')
            ->indexBy('id')->column();
    }

    /**
     * @return array
     */
    public function statusList()
    {
        return [
            static::STATUS_ACTIVE => Yii::t('modules/comment', 'Active'),
            static::STATUS_INACTIVE => Yii::t('modules/comment', 'Inactive'),
        ];
    }

    /**
     * @return string
     */
    public function getLink()
    {
        return ModelHelper::getLink($this->parent_class, $this->parent_id, []);
    }

    /**
     * @param ActiveRecord $parent
     * @param array $options
     * @return static
     */
    public static function create(ActiveRecord $parent, $options = [])
    {
        return new static(array_merge([
            'parent_class' => get_class($parent),
            'parent_id'     => $parent->primaryKey,
        ], $options));
    }
}
