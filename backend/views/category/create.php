<?php

  use yii\helpers\Html;

  /* @var $this yii\web\View */
  /* @var $model common\models\Category */

  $this->title = '新建分类';
  $this->params['breadcrumbs'][] = ['label' => '分类', 'url' => ['index']];
  $this->params['breadcrumbs'][] = $this->title;
?>
<header class="admin-index">
  <h1><?= Html::encode($this->title) ?></h1>
</header>

<?= $this->render('_form', [
  'model' => $model,
]) ?>
