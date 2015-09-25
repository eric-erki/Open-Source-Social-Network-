<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2015 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use humhub\modules\space\models\Space;


/**
 * Description of UserSearch
 *
 * @author luke
 */
class SpaceSearch extends Space
{

    public function attributes()
    {
        // add related fields to searchable attributes
        return array_merge(parent::attributes(), ['type.item_title']);
    }
    
    public function rules()
    {
        return [
            [['id', 'visibility', 'join_policy'], 'integer'],
            [['name'], 'safe'],
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
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Space::find()->joinWith('type');
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 50],
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'id',
                'name',
                'visibility',
                'join_policy',
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['id' => $this->id]);
        $query->andFilterWhere(['join_policy' => $this->join_policy]);
        $query->andFilterWhere(['visibility' => $this->visibility]);
        $query->andFilterWhere(['like', 'name', $this->name]);
     #   $query->andFilterWhere(['space_type.item_title' => $this->getAttribute('space_type.item_title')]);
        return $dataProvider;
    }

}
