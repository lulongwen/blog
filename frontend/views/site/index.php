<?php
use frontend\widgets\banner\BannerWidget;
use frontend\widgets\post\PostWidget;
use frontend\widgets\chat\ChatWidget;
use frontend\widgets\hot\HotWidget;

$this->title = '卢珑文的博客';
?>

<div class="row">
  <div class="col-md-9">
    <!-- 图片轮播，文章列表  -->
    <?= BannerWidget::widget() ?>
    <?//= PostWidget::widget() ?>
  </div>
  
  <div class="col-md-3">
    <!-- 留言板，热门浏览   -->
    <?//= ChatWidget::widget() ?>
    <?//= HotWidget::widget(['title' => '浸提消息']) ?>
  </div>
</div>