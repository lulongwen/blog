<?php
  use yii\helpers\Url;
  use frontend\widgets\tagCloud\TagCloudWidget;
  use frontend\widgets\chat\ChatWidget;
  
  $this-> title = $data['title'];
?>
<style>
  .row {
    margin-top: 32px;
  }
  .btn-block{
    margin-bottom: 16px;
  }
</style>
<div class="row">
  <section class="col-md-12">
    <h1 class="h3"><?= $this-> title ?></h1>
    <header>
      文章标签：
      <?php foreach($data['tags'] as $tag): ?>
        <a href="#"><strong><?= $tag ?></strong></a>
      <?php endforeach; ?>
    </header>
  </section>
  <div class="col-md-9">
    <ol class="breadcrumb">
      <li><a href="<?= Yii::$app->homeUrl ?>">首页</a></li>
      <li><a href="<?= Url::to(['post/index']) ?>">文章</a></li>
      <li><?= $this->title ?></li>
    </ol>
    
    <footer>
      <span>作者：<?= $data['username'] ?></span>
      <span>发布日期：<?= date('Y-m-d', $data['created_at']) ?></span>
      <span>浏览：<?= $data['comment']['pv'] ?> 次</span>
    </footer>
    
    <?= $data['content'] ?>
  </div>
  
  <div class="col-md-3">
    <button type="button" class="btn btn-success btn-block">创建文章</button>
    <button type="button" class="btn btn-info btn-block">修改文章</button>
    
    <?= ChatWidget::widget() ?>
    <?= TagCloudWidget::widget() ?>
  </div>
</div>