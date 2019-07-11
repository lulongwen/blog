<?php
  use yii\helpers\Url;
?>
<style>
  .hot-list {
    position: relative;
    height: 40px;
    margin-bottom: 16px;
    padding-left: 45px;
  }
  .hot-list:last-child {
    margin-bottom: 0;
  }
  .hot-aside {
    position: absolute;
    top: 0;
    left: 0;
    width: 40px;
    text-align: center;
  }
  .hot-aside span {
    display: block;
    width: 100%;
    background-color: #5db85b;
    color: #fff;
    margin-bottom: 5px;
  }
</style>
<?php if (!empty($data)): ?>
<section class="panel panel-success">
  <header class="panel-body">
    <?= $data['title'] ?><small>更多</small>
  </header>
  
  <div class="panel-footer">
    <?php foreach ($data['body'] as $list): ?>
      <div class="hot-list">
        <aside class="hot-aside">
          <span>浏览</span> <?= $list['pv'] ?>
        </aside>
        <a href="<?= Url::to(['post/detail', 'id' => $list['id']]) ?>">
          <strong><?= $list['title'] ?></strong>
        </a>
      </div>
    <?php endforeach; ?>
  </div>
</section>
<?php endif; ?>
