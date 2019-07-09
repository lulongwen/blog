<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;

use frontend\components\TagsCloudWidget;
use frontend\components\RecentWidget;

use yii\common\models\Post;


/* @var $this yii\web\View */
/* @var $searchModel common\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '文章列表';
//$this->params['breadcrumbs'][] = $this->title;
?>

<style>
  .tags-cloud  a{
    display: inline-block;
    margin: 0 12px 12px 0;
  }
</style>
<main class="container">
<div class="row">
  <section class="col-md-9">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
      <?= Html::a('Create Post', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <ol class="breadcrumb">
      <li><a href="<?= Yii::$app->homeUrl ?>">首页</a></li>
      <li><?= $this->title ?></li>
    </ol>

    <?php $form= ActionForm::begin() ?>
      <?= $form-> field($model, 'status')
        -> dropDownList(['0' => '未发布', '1' => '已发布']) ?>

      <?= Html::submitButton($model-> isNewRecord ? 'Create' : 'Update', 
        ['class'=> 'form-control']) ?>

    <?php ActionForm::end() ?>


    
    <?= ListView::widget([
      'id'=> 'postList',
      'dataProvider' => $dataProvider,
      'itemView'=> '_listitem',//子视图,显示一篇文章的标题等内容.
      'layout'=> '{items} {pager}',
      'pager'=> [
        'maxButtonCount'=> 10,
        'nextPageLabel'=>Yii::t('app','下一页'),
        'prevPageLabel'=>Yii::t('app','上一页'),
      ]
    ])
    ?>


    <?= GridView::widget([
      'dataProvider' => $dataProvider,
      'filterModel' => $searchModel,
      'columns' => [
          ['class' => 'yii\grid\SerialColumn'],
          'id',
          // 超链接显示标题
          'title' => [
            'attribute' => '',
            'format' => 'raw',
            'value' => function($model) {
              return '<a href=" '. Url::to(['post/detail', 'id'=> $model->id]) .' ">'.$model->title.'</>';
            }
          ],
          'content:ntext',
          'category.name',
          'email:email',
          
          // role status
          'status' => [
            'label' => '是否发布',
            'attribute' => 'status',
            'value' => function ($model) {
              return ($model->status == 1) ? '已发布' : '未发布';
            },
            'filter' => ['0' => '未发布', '1' => '已发布']
          ],

          'create_at:datetime',
          'update_time',
          'author_id',
          ['class' => 'yii\grid\ActionColumn'],
    ]); ?>
  </section>
  
  <aside class="col-md-3">
    <section class="panel panel-success">
      <header class="panel-heading">
        <i class="i-search"></i> 搜索已发布的文章</header>
      <main class="panel-body">
        <form class="form-inline" id="w0"
          action="index.php?r=post/index" method="get">
          <div class="form-group">
            <div class="input-group">
              <input type="text" name="PostSearch[title]"
                     class="form-control" placeholder="搜素...">
            </div>
          </div>
          <button type="submit" class="btn btn-primary">搜索</button>
        </form>
      </main>
    </section>

    <section class="panel panel-success">
      <header class="panel-heading">标签云</header>
      <main class="panel-body tags-cloud">
        <?= TagsCloudWidget::widget(['tags'=> $tags]) ?>
      </main>
    </section>

    <section class="panel panel-success">
      <header class="panel-heading">评论列表</header>
      <main class="panel-body">
        <?= RecentWidget::widget(['recentComments' => $recentComments]) ?>
      </main>
    </section>
    
  </aside>
</div>
</main>
