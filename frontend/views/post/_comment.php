<?php
/**
 * Created by PhpStorm.
 * User: lulongwen
 * Date: 2019-07-16
 * Time: 22:05
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

// var_dump('coment', $comments);
// exit();
?>

<?php foreach($comments as $item) :?>
<div class="alert alert-info">
  <?= nl2br($item-> content)?>
  <p class="small">
    <span>
      <i class="glyphicon glyphicon-user"></i> 留言：
      <?= $item -> user -> username ?>
    </span>
    <span>
      <i class="glyphicon glyphicon-time"></i> 发布日期：
      <?= date('Y-m-d H:i:s', $item['created_at']) ?>
    </span>
  </p>
</div>
<?php endforeach;?>