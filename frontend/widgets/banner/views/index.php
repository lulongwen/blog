<?php
  /**
   * Created by PhpStorm.
   * User: lulongwen
   * Date: 2019-06-02
   * Time: 20:45
   */
  use yii\helpers\Url;
  ?>

<div class="panel">
  <div class="carousel slide" id="carousel">
    <div class="carousel-inner home-banner">
      <?php foreach($data['items'] as $key => $val): ?>
      <div class="item <?= (isset($val['active']) && $val['active']) ? 'active' : '' ?>">
        <a href="<?= Url::to($val['url'])?>">
          <img src="<?= $val['img']?>" alt="<?= $val['label']?>">
          <div class="carousel-caption"><?= $val['html']?></div>
        </a>
      </div>
      <?php endforeach ?>
    </div>
    
    <ol class="carousel-indicators">
      <?php foreach($data['items'] as $key => $val): ?>
      <li data-target="#carousel"
        data-slide-to="<?= $key ?>"
        class="<?= (isset($val['active']) && $val['active']) ? 'active' : '' ?>"></li>
      <?php endforeach ?>
    </ol>
  
    <a href="#carousel" class="left carousel-control" data-slide="prev">
      <i class="i-return-left arrow"></i>
    </a>
    <a href="#carousel" class="right carousel-control" data-slide="next">
      <i class="i-return-right arrow"></i>
    </a>
  </div>
</div>