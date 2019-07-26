<?php
  use yii\helpers\Url;

?>
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




















