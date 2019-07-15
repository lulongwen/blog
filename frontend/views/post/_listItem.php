<?php
  /**
   * Created by PhpStorm.
   * User: 卢珑文
   * Date: 2019-07-15
   * Time: 8:08
   * description:
   */

  use yii\helpers\Html;

?>
<section class="post-items">
  <h2 class="title">
    <a href="<?= $model->url ?>"><?= Html::encode($model->title) ?></a>
  </h2>
  <p class="subtags">
    <span>
      <i class="glyphicon glyphicon-time"></i>
      <?= date('Y-m-d H:i:s', $model->updated_at) ?>
    </span>
    <span>
      <i class="glyphicon glyphicon-user"></i>
      <?= $model->user->username ?>
    </span>
  </p>

  <section class="content">
    <?= $model->beginning ?>
  </section>

  <footer class="subtags">
  <span>
    <i class="glyphicon glyphicon-tag"></i>
    <?= implode(',', $model->taglink) ?>
  </span>

    <span>
    <i class="glyphicon glyphicon-comment"></i>
    <?= Html::a("评论 ({$model->commentCount})", $model->url . '#comments') ?>
  </span>

    <span>
    <i class="glyphicon glyphicon-time"></i> 更新时间
    <?= date('Y-m-d H:i:s', $model->updated_at) ?>
  </span>
  </footer>
</section>