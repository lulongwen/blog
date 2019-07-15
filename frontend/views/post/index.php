<?php

use yii\helpers\Html;
use yii\grid\GridView;

use yii\widgets\ListView;
use common\models\Post;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

// $this->title = 'Posts';
// $this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
  <div class="col-md-9">
    <ol class="breadcrumb">
      <li><a href="<?= Yii::$app->homeUrl;?>">首页</a></li>
      <li>文章列表</li>
    </ol>

    <?= ListView::widget([
      'id' => 'postList',
      'options' => [ // 针对整个 ListView
        'class' => 'clearfix',
      ],
      'dataProvider' => $dataProvider,
      'itemView' => '_listItem', //子视图,显示一篇文章的标题等内容
      'itemOptions' => ['tag' => null], // 去掉 data-key，针对渲染的单个item
      'layout' => '{items} <footer class="footer-pager">{summary} {pager}</footer>',
      'pager' => [
        // 设置 class
        // 'options' => [
        //   'class' => 'pagination pull-right'
        // ],
        // 分页按钮设置
        'maxButtonCount' => 10,
        'nextPageLabel' => Yii::t('app', '下一页'),
        'prevPageLabel' => Yii::t('app', '上一页'),
      ]
    ]) ?>
  </div>

  <div class="col-md-3">
    <button class="btn btn-success btn-block">
      <i class="glyphicon glyphicon-edit"></i> 发表文章
    </button>
  </div>
</div>




























