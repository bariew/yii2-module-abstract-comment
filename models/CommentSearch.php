<?php
/**
 * CommentSearch class file.
 * @copyright (c) 2016, Pavel Bariev
 * @license http://www.opensource.org/licenses/bsd-license.php
 */

namespace bariew\commentAbstractModule\models;

use bariew\abstractModule\models\AbstractModelExtender;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * Description.
 *
 * Usage:
 *
 * @mixin Comment
 * @author Pavel Bariev <bariew@yandex.ru>
 *
 */
class CommentSearch extends AbstractModelExtender
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'owner_id', 'parent_id', 'branch_id', 'status'], 'integer'],
            [[ 'created_at', 'updated_at', 'parent_class', 'content'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * @inheritdoc
     */
    public function search($params = [])
    {
        $query = parent::search();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['created_at' => SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'owner_id' => $this->owner_id,
            'parent_id' => $this->parent_id,
            'branch_id' => $this->branch_id,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'parent_class', $this->parent_class])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere([
                'like', 'DATE_FORMAT(FROM_UNIXTIME(created_at), "%Y-%m-%d")', $this->created_at
            ])->andFilterWhere([
                'like', 'DATE_FORMAT(FROM_UNIXTIME(updated_at), "%Y-%m-%d")', $this->updated_at
            ]);

        return $dataProvider;
    }
}
