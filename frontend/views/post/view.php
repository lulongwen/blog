<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Post */

$this -> title = $model -> title;
$this -> params['breadcrumbs'][] = ['label' => '文章', 'url' => ['index']];
$this -> params['breadcrumbs'][] = $this -> title;
\yii\web\YiiAsset ::register($this);
?>
<header class="post-view">
  
  <h1><?= Html ::encode($this -> title) ?></h1>
</header>
  
  <p>
    <?= Html ::a('修改', ['update', 'id' => $model -> id], ['class' => 'btn btn-primary']) ?>
    <?= Html ::a('删除', ['delete', 'id' => $model -> id], [
      'class' => 'btn btn-danger',
      'data' => [
        'confirm' => 'Are you sure you want to delete this item?',
        'method' => 'post',
      ],
    ]) ?>
  </p>
  
  <?= DetailView ::widget([
    'model' => $model,
    'attributes' => [
      'id',
      'title',
      'summary:ntext',
      'content:ntext',
      'thumbnail',
      'userid',
      // [
      //   'attribute' => 'userid',
      //   'label' => '作者ID',
      //   'value'=> $model->user->nickname
      // ],
      'username',
      'categoryid',
      'status',
      // [
      //   'label' => '状态',
      //   'value' => $model->status0->name,
      // ],
      // 'created_at',
      // 'updated_at',
      // 'deleted_at',
      [
        'attribute' => 'created_at',
        'value'=> date('Y-m-d H:i:s', $model->created_at)
      ],
      [
        'attribute' => 'updated_at',
        'value'=> date('Y-m-d H:i:s', $model->updated_at)
      ]
    ],
  ]) ?>

</>
