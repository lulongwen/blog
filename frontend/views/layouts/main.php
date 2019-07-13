<?php

/* @var $this \yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

$avatar = Yii ::$app -> params['avatar']['image'];



AppAsset ::register($this);
?>
<?php $this -> beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii ::$app -> language ?>">
<head>
  <meta charset="<?= Yii ::$app -> charset ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php $this -> registerCsrfMetaTags() ?>
  <title><?= Html ::encode($this -> title) ?></title>
  <?php $this -> head() ?>
</head>
<body class="pt-50">
<?php $this -> beginBody() ?>

<div class="wrap">
  <?php
  NavBar ::begin([
    'brandLabel' => Yii ::$app -> name,
    'brandUrl' => Yii ::$app -> homeUrl,
    // 'brandLabel' => ['style' => 'color:red;font-size:18px'],
    'options' => [
      'class' => 'navbar-inverse navbar-fixed-top',
    ],
  ]);
  
  $leftItems = [
    ['label' => '文章管理', 'url' => ['/post/index']],
    ['label' => '后端开发', 'url' => ['/site/about']],
    ['label' => '项目经理', 'url' => ['/site/index']],
    ['label' => '全栈架构', 'url' => ['/site/fullstack']],
    ['label' => '帮你学会', 'url' => ['/site/contact']],
  ];

  // 如果是个访客，显示登录注册
  if (Yii ::$app -> user -> isGuest) {
    $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
    $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
  } else {
    $menuItems[] = [
      'label' => '<img src="' . $avatar . '" alt="' . Yii ::$app -> user -> identity -> username . '"/>',
      'linkOptions' => ['class' => 'avatar'],
      'items' => [
        [
          'label' => '<i class="i-person"></i> 会员中心',
          'url' => ['site/logout'],
        ],
        [
          'label' => '<i class="i-log-out"></i> 个人中心',
          'url' => ['site/logout'],
        ],
        [
          'label' => '<i class="i-log-out"></i> 退出',
          'url' => ['site/logout'],
          'linkOptions' => ['data-method' => 'post']
        ],
      ]
    ];
  }

  echo Nav ::widget([
    'options' => ['class' => 'navbar-nav navbar-left'],
    'items' => $leftItems,
  ]);
  echo Nav ::widget([
    'options' => ['class' => 'navbar-nav pull-right'],
    'encodeLabels' => false, // 不转义HTML，显示代码
    'items' => $menuItems
  ]);
  NavBar ::end();
  ?>
  
  <div class="container">
    <?= Breadcrumbs ::widget([
      'links' => isset($this -> params['breadcrumbs']) ? $this -> params['breadcrumbs'] : [],
    ]) ?>
    <?= Alert ::widget() ?>
    <?= $content ?>
  </div>
</div>

<?php $this -> endBody() ?>
</body>
</html>
<?php $this -> endPage() ?>
