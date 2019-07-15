<?php

  use yii\helpers\Html;
  use yii\grid\GridView;

  /* @var $this yii\web\View */
  /* @var $searchModel common\models\PostSearch */
  /* @var $dataProvider yii\data\ActiveDataProvider */

  $this->title = '文章列表';
  $this->params['breadcrumbs'][] = $this->title;

  $status = ['0' => '草稿', '1' => '已发布', '2' => '已归档'];

?>
<header class="admin-index">
  <h1><?= Html::encode($this->title) ?></h1>

  <?= Html::a('新建文章', ['create'], ['class' => 'btn btn-success btn-sm']) ?>
</header>

<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<?= GridView::widget([
  // 数据提供者
  'dataProvider' => $dataProvider,
  // 搜索的表单
  'filterModel' => $searchModel,

  // 展示那些列，用什么格式来展示
  'columns' => [
    // ['class' => 'yii\grid\SerialColumn'], // 序号
    [
      'attribute' => 'id',
      'contentOptions' => ['width' => '60px']
    ],
    'title',
    [
      // 'attribute' => 'userid',
      'attribute' => 'authName',
      'label' => '作者',
      'value' => 'user.username' // getUser 关联表的 username字段
    ],
    'tags',
    'summary:ntext',
    [
      'attribute' => 'categoryName',
      'label' => '分类',
      'value' => 'category.name'
    ],

    [
      'attribute' => 'status',
      'filter' => $status,
      'contentOptions' => ['width' => '90px'],
      'value' => function ($model, $key, $status) {
        return $model->statusArray[$model->status];
      },

    ],
    [
      'attribute' => 'updated_at',
      'format' => ['date', 'php:Y-m-d H:i:s'],
      'contentOptions' => ['width' => '90px']
    ],

    // 'id',
    // 'categoryid',
    // 'userid',
    // 'content:ntext',
    // 'thumbnail',
    //'username',
    // 'status',
    // 'created_at:datetime',
    //'updated_at',
    //'deleted_at',
    [
      'class' => 'yii\grid\ActionColumn',
      'contentOptions' => ['width' => '70px']
    ],
  ],
]); ?>


