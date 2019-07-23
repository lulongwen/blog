<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Comment */

$this -> title = '评论ID：' . $model -> id;
$this -> params['breadcrumbs'][] = ['label' => '评论', 'url' => ['index']];
$this -> params['breadcrumbs'][] = $this -> title;
\yii\web\YiiAsset ::register($this);
?>
  
  <header class="admin-index">
    <h1><?= Html ::encode($this -> title) ?></h1>
    <div class="btn-group btn-group-sm extra">
      <?= Html ::a('修改', ['update', 'id' => $model -> id], ['class' => 'btn btn-primary']) ?>
      <?= Html ::a('删除', ['delete', 'id' => $model -> id], [
        'class' => 'btn btn-danger',
        'data' => [
          'confirm' => '您确定删除这表评论吗?',
          'method' => 'post',
        ],
      ]) ?>
    </div>
  </header>

<?= DetailView ::widget([
  'model' => $model,
  'attributes' => [
    'id',
    'content:ntext',
    [
      'attribute' => 'userid',
      'label' => '用户',
      'value' => $model -> user -> username
    ],
    'email:email',
    'url:url',
    [
      'attribute' => 'postid',
      'label' => '评论文章',
      'value' => $model -> post -> title
    ],
    
    [
      'attribute' => 'remind',
      'label' => '是否提醒',
      'value' => ($model -> remind == 1) ? '已提醒' : '未提醒',
    ],
    [
      'attribute' => 'status',
      'label' => '审核状态',
      'value' => ($model -> status == 1) ? '已审核' : '未审核',
    ],
    [
      'attribute' => 'created_at',
      'format' => ['date', 'php:Y-m-d H:i:s']
    ],
    [
      'attribute' => 'updated_at',
      'format' => ['date', 'php:Y-m-d H:i:s']
    ],
    
    // 'status',
    // 'userid',
    // 'postid',
    // 'remind',
    // 'created_at',
    // 'updated_at',
  ],
]) ?>