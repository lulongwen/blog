<?php

  use yii\helpers\Html;

  /* @var $this yii\web\View */
  /* @var $model common\models\Tag */

  $this->title = '更新标签：' . $model->name;
  $this->params['breadcrumbs'][] = ['label' => '标签', 'url' => ['index']];
  $this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
  $this->params['breadcrumbs'][] = '更新';
?>
<header class="admin-index">

  <h1><?= Html::encode($this->title) ?></h1>
</header>

<?= $this->render('_form', [
  'model' => $model,
]) ?>


