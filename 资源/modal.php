<?php
/**
 * Created by PhpStorm.
 * User: lulongwen
 * Date: 2019-07-26
 * Time: 22:25
 */

use yii\bootstrap\Modal;

// 模态框组件
Modal::begin([
  'id' => 'page-modal',
  'header' => '<h4>弹窗标题</h4>',
  'toggleButton' => ['label' => '点击'],
]);

echo '弹窗内容';

Modal::end();
?>

<!--触发模态框的按钮-->
<?= Html::a('确认', '#', [
  'class' => 'btn btn-success',
  'data-toggle' => 'modal',
  // 对应Modal组件中设置的id
  'data-target' => '#page-modal'
]);?>