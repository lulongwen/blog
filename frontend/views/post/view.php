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
      'summary:ntext', // 设置内容显示的格式
      'content:ntext',
      'thumbnail',
      // 'userid',
      // 'status',
      // 'categoryid',
      [
        // 'attribute' => 'userid',
        'label' => '作者ID', // 覆盖 attributeLabel
        'value'=> $model->user->username
      ],
     [
       'attribute' => 'categoryid',
       'value' => $model->category->name
     ],
      [
        'label' => '状态',
        'value' => $model->status ? '已发布' : '草稿',
      ],
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
    'template' => '<tr><th style="width: 120px;">{label}</th><td>{value}</td></tr>',
    // 设置 table的 class
    'options' => ['class' => 'table table-striped table-bordered table-hover']
  ]) ?>

</>
