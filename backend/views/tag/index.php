<?php

  use yii\helpers\Html;
  use yii\grid\GridView;

  /* @var $this yii\web\View */
  /* @var $searchModel common\models\TagSearch */
  /* @var $dataProvider yii\data\ActiveDataProvider */

  $this->title = '标签';
  $this->params['breadcrumbs'][] = $this->title;
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
      'contentOptions' => ['width' => '60px']
    ],
    'name',
    'frequency',

    [
      'class' => 'yii\grid\ActionColumn',
      'header' => '操作',
      'contentOptions' => ['width' => '80px']
    ],
  ],
]); ?>
