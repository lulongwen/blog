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
<body>
<?php $this -> beginBody() ?>

<div class="container">
  <?= Breadcrumbs ::widget([
    'links' => isset($this -> params['breadcrumbs']) ? $this -> params['breadcrumbs'] : [],
  ]) ?>
  <?= Alert ::widget() ?>
  <?= $content ?>
</div>

<?php $this -> endBody() ?>
</body>
</html>
<?php $this -> endPage() ?>
