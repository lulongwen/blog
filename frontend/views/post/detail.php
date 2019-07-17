<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;

use common\models\Comment;
use frontend\components\TagsCloud;

// use frontend\widgets\tagCloud\TagCloudWidget;
// use frontend\widgets\chat\ChatWidget;
// echo '<pre>';
// var_dump($model -> comments);exit();
?>
<div class="row">
  <section class="col-md-12">
    <h1 class="h3"><?= Html ::encode($model -> title) ?></h1>
    <header>
      文章标签：
      <?php foreach ($model -> tagLink as $item): ?>
        <?= $item ?><?php endforeach; ?>
    </header>
    <footer>
      <span>作者：<?= $model -> user -> username ?></span>
      <span>浏览：<?= $model -> postStatus -> pv ?> 次</span>
      <span>发布日期：<?= date('Y-m-d', $model['created_at']) ?></span>
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
      <li><?= $model -> title ?></li>
    </ol>
    
    <?= HTMLPurifier ::process($model['content']) ?>
    
    <div class="comments" id="comments">
      <!-- 提交的评论   -->
      <?php if ($added): ?>
        <div class="alert alert-warning alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert">
            <span>&times;</span>
          </button>
          <h5>谢谢您的回复，我们会尽快审核后发布出来！</h5>
          <p><?= nl2br($comment -> content); ?></p>
          <footer>
            <span>留言：<?= $model -> user -> username ?></span>
            <span>发布日期：<?= date('Y-m-d H:i:s', $model['created_at']) ?></span>
          </footer>
        </div>
      <?php endif; ?>
      
      <!-- 显示评论-->
      <?php if ($model -> commentCount > 0): ?>
        <h5>评论 <?= $model -> commentCount ?> 条</h5>
        <?= $this -> render('_comment',
          ['post' => $model, 'comments' => $model -> auditComments]); ?>
      <?php endif; ?>
      
      <!-- 发表评论-->
      <?php
        $comment = new Comment();
        echo $this-> render('_commentForm',
          ['id' => $model-> id, 'comment' => $comment]);
      ?>
    </div>
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