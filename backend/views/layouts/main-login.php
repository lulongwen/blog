<?php
use backend\assets\AppAsset;
use yii\helpers\Html;

use dmstr\web\AdminLteAsset;

/* @var $this \yii\web\View */
/* @var $content string */

// echo '<pre>';
// print_r($this);

dmstr\web\AdminLteAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
  <link rel="stylesheet" href="css/AdminLTE.css">
  <link rel="stylesheet" href="css/index.css">
</head>
<body class="login-page">

<?php $this->beginBody() ?>

    <?= $content ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
