<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;

use common\models\Comment;
use frontend\components\TagsCloud;

// use frontend\widgets\tagCloud\TagCloudWidget;
// use frontend\widgets\chat\ChatWidget;

// echo '<pre>';
// var_dump($model);exit();
?>

<div class="row">
  <section class="col-md-12 post-header">
    <h1><?= Html ::encode($model['title']) ?></h1>
    <header class="mb-10">
      标签：
      <?php foreach ($model['tags'] as $item): ?>
        <i class="label label-success"><?= $item ?></i>
      <?php endforeach; ?>
    </header>
    <footer class="post-header-footer mb-10">
      <span>作者：<?= $model['userid']?></span>
      <span>浏览：<?= $model['pv'] ?></span>
      <span>
        发布日期：
        <?= date('Y-m-d', $model['updated_at']) ?>
      </span>
    </footer>
  </section>
  <div class="col-md-9">
    <ol class="breadcrumb">
      <li>
        <a href="<?= Yii ::$app -> homeUrl ?>">首页</a>
      </li>
      <li>
        <a href="<?= Url ::to(['post/index']) ?>">文章</a>
      </li>
      <li><?= $model['title'] ?></li>
    </ol>

    <article class="post-main">
      <?= HTMLPurifier ::process($model['content']) ?>
    </article>

    <footer class="clearfix post-about">
      <span class="pull-left">上一篇：
        <a href="<?= $prev['url']?>"><?=$prev['title']?></a></span>
      <span class="pull-right">下一篇：
        <a href="<?= $next['url']?>"><?=$next['title']?></a></span>
    </footer>
  </div>

  <div class="col-md-3">
    <button type="button" class="btn btn-info btn-block mb-20">
      <i class="glyphicon glyphicon-edit"></i>
      修改文章
    </button>
    <button type="button" class="btn btn-success btn-block mb-20">
      <i class="glyphicon glyphicon-pencil"></i>
      创建文章
    </button>

    <div class="panel panel-success">
      <div class="panel-heading">
        <i class="glyphicon glyphicon-cloud"></i> 标签云
      </div>
      <div class="panel-body tags-cloud">
        <?= TagsCloud::widget(['tags' => $tags])?>
      </div>
    </div>

  </div>
</div>
