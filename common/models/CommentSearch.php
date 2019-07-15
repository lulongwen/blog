<?php

  namespace common\models;

  use yii\base\Model;
  use yii\data\ActiveDataProvider;
  use common\models\Comment;

  /**
   * CommentSearch represents the model behind the search form of `common\models\Comment`.
   */
  class CommentSearch extends Comment
  {
    /**
     * {@inheritdoc}
     */
    public function rules() {
      return [
        [['id', 'userid', 'postid', 'remind', 'status', 'created_at', 'updated_at', 'deleted_at'], 'integer'],
        [['content', 'email', 'url'], 'safe'],
      ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios() {
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
    public function search($params) {
      $query = Comment::find();

      // add conditions that should always apply here

      $dataProvider = new ActiveDataProvider([
        'query' => $query,
      ]);

      $this->load($params);

      if (!$this->validate()) {
        // uncomment the following line if you do not want to return any records when validation fails
        // $query->where('0=1');
        return $dataProvider;
      }

      // grid filtering conditions
      $query->andFilterWhere([
        'comment.id' => $this->id,
        'comment.userid' => $this->userid,
        'postid' => $this->postid,
        'remind' => $this->remind,
        'status' => $this->status,
        'created_at' => $this->created_at,
        'updated_at' => $this->updated_at,
        'deleted_at' => $this->deleted_at,
      ]);

      $query->andFilterWhere(['like', 'content', $this->content])
        ->andFilterWhere(['like', 'email', $this->email])
        ->andFilterWhere(['like', 'url', $this->url]);

      // 未审核的状态排在前面，相同状态的，再按 id 倒序排列
      $dataProvider -> sort-> defaultOrder = [
        'status' => SORT_ASC,
        'id' => SORT_DESC
      ];

      return $dataProvider;
    }
  }
