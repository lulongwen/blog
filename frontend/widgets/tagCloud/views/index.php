<?php
  use yii\helpers\Url;

?>
<style>
  .btn-xs {
    margin-bottom: 10px;
  }
  h3.panel-body {
    margin: 0;
    padding: 10px;
    font-size: 14px;
    background-color: #d6e9c6;
  }
</style>
<section class="panel panel-success">
  <h3 class="panel-body"><?= $data['title'] ?></h3>
  <div class="panel-footer">
    <?php foreach($data['list'] as $key=> $list): ?>
      <a href="<?= Url::to(['post/index', 'tag' => $list['name']]) ?>"
        class="btn btn-xs <?= 'btn-'. $data['style'][rand(0,4)]?>">
        <?= $list['name'] ?>
      </a>
    <?php endforeach ?>
  </div>
</section>




















