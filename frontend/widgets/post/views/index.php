<?php
  /**
   * Created by PhpStorm.
   * User: lulongwen
   * Date: 2019-06-03
   * Time: 21:28
   *
   * <span>留言：
   * <a href="<? Url::to(['post/detail', 'id' => $list['id']]) ?>"></a>
   * <?= isset($list['comment']['content']) ? $list['comment']['content'] : 0 ?>
   * </span>
   */

  // use Yii; Yii::$app-> params['upload_url'] .$list['thumbnail']
  use yii\helpers\Url;
  use yii\widgets\LinkPager;

  // echo '<pre>';
  // var_dump($data['body']); exit();
?>

  <header class="">
    <?= $data['title'] ?>
    <?php if ($this->context->more): ?>
      <a href="<?= $data['more'] ?>" class="small">更多</a>
    <?php endif; ?>
  </header>

<?php foreach ($data['body'] as $key => $list): ?>
  <section class="post-item">
    <h2>
      <a target="_blank"
        href="<?= Url::to(['post/detail', 'id' => $list['id']]) ?>">
        <?= $list['title'] ?>
      </a>
    </h2>
    <nav class="nav">
      <span>作者：
        <a href="<?= Url::to(['member/index', 'id' => $list['userid']]) ?>">
        <?= $list['userid'] ?>
        </a>
      </span>

      <span> 浏览：
        <?= isset($list['comment']['pv']) ? $list['comment']['pv'] : 0 ?>
      </span>
      <span>发布时间：<?= date('Y-m-d h:i', $list['created_at']) ?></span>
    </nav>
    <p><?= $list['summary'] ?></p>

    <aside class="aside">
      <img width="200"
          src="<?= ($list['thumbnail'] ?: Yii::$app->params['defaultImage']) ?>"
          alt="<?= $list['title'] ?>">
      <!-- 文章标签 -->
      <footer>
        <i class="i-pricetags"></i>
        <?php if (!empty($list['tag'])): ?>
          <?php foreach ($list['tag'] as $tag): ?>
            <a href="#"><strong><?= $tag ?></strong></a>
          <?php endforeach; ?>
        <?php endif; ?>
      </footer>
    </aside>

    <a class="btn btn-sm btn-success"
       href="<?= Url::to(['post/detail', 'id' => $list['id']]) ?>">
      阅读全文</a>
  </section>
<?php endforeach ?>

<?php if ($this->context->page): ?>
  <div class="text-right">
    <?= LinkPager::widget(['pagination' => $data['page']]); ?>
  </div>
<?php endif; ?>