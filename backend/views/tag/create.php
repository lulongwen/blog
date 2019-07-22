<?php

  use yii\helpers\Html;

  /* @var $this yii\web\View */
  /* @var $model common\models\Tag */

  $this->title = '新建标签';
  $this->params['breadcrumbs'][] = ['label' => '标签', 'url' => ['index']];
  $this->params['breadcrumbs'][] = $this->title;
?>
<header class="admin-index">
  <h1><?= Html::encode($this->title) ?></h1>
</header>

<?= $this->render('_form', [
  'model' => $model,
]) ?>
