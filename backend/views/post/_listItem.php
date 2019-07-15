<?php
use yii\helpers\Html;

?>

<div class="post" style="margin-bottom: 32px">
  <header class="title">
    <h2 class="h4">
      <a href="<?= $model->url ?>">
        <?= Html::encode($model->title) ?>
      </a>
    </h2>
    
    <!-- 发表时间及 作者 -->
    <footer class="author">
      <i><?= date('Y-m-d H:i:s', $model->created_at) ?></i>
      <i><?= Html::encode($model->author->nickname) ?></i>
    </footer>
  </header>
  
  <section class="content">
    <?= $model->beginning ?>
  </section>
  
  <footer>
    <?=Html::a("评论 ({$model->commentCount})", $model->url.'#comments') ?>
    <span>更新：<?=date('Y-m-s H:i:s', $model->update_time) ?></span>
  </footer>
</div>
