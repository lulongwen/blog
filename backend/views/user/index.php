<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this -> title = '前台用户管理';
$this -> params['breadcrumbs'][] = $this -> title;
?>
<header class="admin-index">
  <h1><?= Html ::encode($this -> title) ?></h1>
  <?= Html ::a('新建用户', ['create'], ['class' => 'btn btn-success btn-sm']) ?>
</header>
  
  <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
  
  <?= GridView ::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
      // ['class' => 'yii\grid\SerialColumn'],
      [
        'attribute' => 'id',
        'headerOptions' => ['style'=>'width:60px'],
        // 'contentOptions' => ['width' => '50px'] 不推荐的用法
      ],
      'username',
      // 'auth_key',
      // 'password_hash',
      // 'password_reset_token',
      'email:email',
      [
        'attribute' => 'status',
        'value' => 'statusStr'
      ],
      //'avatar',
      [
        'attribute' => 'created_at',
        'format' => ['date', 'php:Y-m-d H:i:s'],
      ],
      [
        'attribute' => 'updated_at',
        'format' => ['date', 'php:Y-m-d H:i:s']
      ],
      //'verification_token',
      //'deleted_at',
      [
        'class' => 'yii\grid\ActionColumn',
        'template' => '{view} {update}',
        'header' => '操作',
        // 'headerContent' => ''
        'headerOptions' => ['style' => 'width:60px']
      ],
    ],
  ]); ?>

