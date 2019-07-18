<?php

  use yii\helpers\Html;
  use yii\grid\GridView;

  use common\models\Comment;

  /* @var $this yii\web\View */
  /* @var $searchModel common\models\CommentSearch */
  /* @var $dataProvider yii\data\ActiveDataProvider */

  $this->title = '评论管理';
  $this->params['breadcrumbs'][] = $this->title;

  // 评论有用户产生，不需要新增
  //  Html::a('Create Comment', ['create'], ['class' => 'btn btn-success'])
?>
<header class="admin-index">
  <h1><?= Html::encode($this->title) ?></h1>
</header>


<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<?= GridView::widget([
  'dataProvider' => $dataProvider,
  'filterModel' => $searchModel,
  'columns' => [
    // ['class' => 'yii\grid\SerialColumn'],

    [
      'attribute' => 'id',
      'label' => 'ID',
      'contentOptions' => ['width' => '60px']
    ],
    [
      'attribute' => 'content',
      'value' => 'beginning' // 调用的是 getBeginning 方法，只读的属性
    ],
    [
      // 'attribute' => 'user.username',
      // 'value' => 'user.username',
      'label' => '用户'
    ],

    [
      'attribute' => 'post.title',
      'label' => '文章标题'
    ],
    'email:email',
    'url:url',
    [
      'label' => '状态',
      'attribute' => 'status',
      'value' => function ($model) {
        return Comment::getStatusStr($model->status);
      },
      'filter' => Comment::getStatusArr(),
      'contentOptions' => function ($model, $key, $index, $column) {
        return ($model->status == 0) ? ['class' => 'bg-danger'] : [];
      }
    ],
    [
      'attribute' => 'updated_at',
      'format' => ['date', 'php:Y-m-d H:i']
    ],

    // 'id',
    // 'userid',
    // 'content:ntext',
    //'postid',
    //'remind',
    //'status',
    //'created_at',
    //'updated_at',
    //'deleted_at',

    [
      'class' => 'yii\grid\ActionColumn',
      'contentOptions' => ['width' => '100px'],
      'template' => '{view} {update} {delete} {approve}',
      'buttons' => [
        'approve' => function ($url, $model, $key) {
          $options = [
            'title' => Yii::t('yii', '审核'),
            'aria-label' => Yii::t('yii', '审核'),
            'data-confirm' => Yii::t('yii', '您确定通过这条评论吗'),
            'data-method' => 'post',
            'data-pjax'=>'0',
          ];

          return Html::a('<i class="glyphicon glyphicon-check"></i>', $url, $options);
        }
      ],
    ],
  ],
]); ?>
















