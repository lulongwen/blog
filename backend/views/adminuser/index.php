<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AdminuserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '管理员列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<header class="admin-index">
  <h1><?= Html::encode($this->title) ?></h1>
  <?= Html::a('新建管理员', ['create'], ['class' => 'btn btn-success btn-sm']) ?>
</header>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'nickname',
            'password_hash',
            'email:email',
            //'profile:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

