<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AdminuserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this -> title = '管理员列表';
$this -> params['breadcrumbs'][] = $this -> title;
?>
<header class="admin-index">
  <h1><?= Html ::encode($this -> title) ?></h1>
  <?= Html ::a('新建管理员', ['create'], ['class' => 'btn btn-success btn-sm']) ?>
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
    ],
    'username',
    'nickname',
    // 'password_hash',
    'email:email',
    'profile:ntext',
    
    [
      'class' => 'yii\grid\ActionColumn',
      'header' => '操作',
      'headerOptions' => ['style' => 'width:90px'],
      'template' => '{view} {update} {resetpwd} {privilege}',
      'buttons' => [
        'resetpwd'=> function($url,$model,$key) {
          $options=[
            'title'=>Yii::t('yii','重置密码'),
            'aria-label'=>Yii::t('yii','重置密码'),
            'data-pjax'=>'0',
          ];
          return Html::a('<i class="glyphicon glyphicon-lock"></i>',$url,$options);
        },
  
        'privilege'=> function($url,$model,$key) {
          $options=[
            'title'=>Yii::t('yii','权限'),
            'aria-label'=>Yii::t('yii','权限'),
            'data-pjax'=>'0',
          ];
          return Html::a('<i class="glyphicon glyphicon-user"></i>',$url,$options);
        },
      ]
    ],
  ],
]); ?>

