<?php
  use yii\helpers\Url;
?>

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