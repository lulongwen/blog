<?php

  namespace common\models;

  use yii\base\Model;
  use yii\data\ActiveDataProvider;
  use common\models\Post;

  /**
   * PostSearch represents the model behind the search form of `common\models\Post`.
   */
  class PostSearch extends Post
  {
    // 添加自定义属性
    public function attributes() {
      return array_merge(parent::attributes(), ['authName', 'categoryName']);
    }

    // rules 重写了父类的方法，因为子类和父类对数据的要求不同
    public function rules() {
      return [
        [['id', 'userid', 'categoryid', 'status', 'created_at', 'updated_at', 'deleted_at'], 'integer'],
        [['title', 'summary', 'content', 'thumbnail', 'username', 'authName', 'categoryName'], 'safe'],
      ];
    }

    // 作废父类的场景，直接调用最顶级的 Model的方法
    public function scenarios() {
      // bypass scenarios() implementation in the parent class
      return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     dataProvider 是 Search 得到的结果
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params) {
      $query = Post::find();

      // add conditions that should always apply here

      $dataProvider = new ActiveDataProvider([
        // 查询数据
        'query' => $query,
        // 分页
        'pagination' => ['pageSize' => 10],
        // 排序
        'sort' => [
          'defaultOrder' => [
            'id' => SORT_DESC, // id的排序方式
          ],
          'attributes' => ['id' ,'title'], // 可以排序的字段，Post表字段排序
        ]
      ]);

      // 快赋值
      $this->load($params);

      // 如果验证失败，就不显示数据
      if (!$this->validate()) {
        // uncomment the following line if you do not want to return any records when validation fails
        // 当搜索验证失败，显示你自己定义的提示
        // $query->where('0=1');
        return $dataProvider;
      }

      // grid filtering conditions，
      // 不指定表名的错误 Column 'status' in where clause is ambiguous
      // 查询的多张表中有相同字段，不指定表名，就不知道去哪个表中查询数据
      $query->andFilterWhere([
        // 'id' => $this->id,
        'blog_post.id' => $this->id,
        'blog_userid' => $this->userid,
        'blog_post.categoryid' => $this->categoryid,
        'blog_post.status' => $this->status,
        'created_at' => $this->created_at,
        'updated_at' => $this->updated_at,
      ]);

      $query->andFilterWhere(['like', 'title', $this->title])
        ->andFilterWhere(['like', 'summary', $this->summary])
        ->andFilterWhere(['like', 'content', $this->content])
        ->andFilterWhere(['like', 'thumbnail', $this->thumbnail])
        ->andFilterWhere(['like', 'username', $this->username]);

      /* 文章作者关联查询，作者的字符串 来查询姓名
       把文章表和用户表做了一个内连接
        用文章表的字段和 用户表的字段做个比对，得出结果
       */

      // 作者是保存在 user表中的，用 join链接 user表 User::className()
      $query -> join('INNER JOIN', 'blog_user', 'blog_post.userid = blog_user.id');
      $query -> andFilterWhere(['like', 'blog_user.username', $this->authName]);

      // 关联字段排序
      $dataProvider -> sort -> attributes['authName'] = [
        'asc' => ['blog_user.username' => SORT_ASC], // 按升序排列 A-Z
        'desc' => ['blog_user.username' => SORT_DESC] // 按降序排列 (Z-A)
      ];

      $query -> join('INNER JOIN', 'blog_category', 'blog_post.categoryid = blog_category.id');
      $query -> andFilterWhere(['like', 'blog_category.name', $this->categoryName]);


      return $dataProvider;
    }
  }























