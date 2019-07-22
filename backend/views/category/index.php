<?php

  use yii\helpers\Html;
  use yii\grid\GridView;

  /* @var $this yii\web\View */
  /* @var $searchModel common\models\CategorySearch */
  /* @var $dataProvider yii\data\ActiveDataProvider */

  $this->title = '网站分类';
  $this->params['breadcrumbs'][] = $this->title;
?>

<header class="admin-index">

  <h1><?= Html::encode($this->title) ?></h1>
  <?= Html::a('新建分类', ['create'], ['class' => 'btn btn-success btn-sm']) ?>
</header>

<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<?= GridView::widget([
  'dataProvider' => $dataProvider,
  'filterModel' => $searchModel,
  'columns' => [
    // ['class' => 'yii\grid\SerialColumn'],

    [
      'attribute' => 'id',
      'contentOptions' => ['width' => '60px']
    ],
    'name',
    'position',

    [
      'class' => 'yii\grid\ActionColumn',
      'header' => '操作',
      'contentOptions' => ['width' => '80px']
    ],
  ],
]); ?>

