<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '用户列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<header class="admin-index">
  <h1><?= Html::encode($this->title) ?></h1>

  <?= Html::a('新建用户', ['create'], ['class' => 'btn btn-success btn-sm']) ?>
</header>

<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        'id',
        'username',
        'auth_key',
        'password_hash',
        'password_reset_token',
        //'email:email',
        //'status',
        //'created_at',
        //'updated_at',
        //'verification_token',

        ['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>