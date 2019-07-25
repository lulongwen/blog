<?php
  /**
   * Created by PhpStorm.
   * User: lulongwen
   * Date: 2019-06-03
   * Time: 21:20
   */
  use yii\helpers\Url;

?>

<section class="panel panel-success">
  <header class="panel-body">
    <?= $data['title'] ?><small>更多</small>
  </header>
  <div class="panel-footer">
    <nav class="chat">
      <input type="text" name="content" id="content"
        class="form-control" placeholder="输入现在的想法...">
      <button class="btn btn-success" id="chat" data-url="<?= Url::to(['site/chat-create']) ?>">发布</button>
    </nav>
    
    <?php if (!empty($data['chat'])): ?>
      <?php foreach ($data['chat'] as $key => $list): ?>
        <section class="chat-list">
          <h6><?= $list['content'] ?></h6>
          <img class="img"  alt=""
            src="<?= ($list['user']['avatar'] ?: Yii::$app-> params['avatar']['image']) ?>">
          <footer><?= date('Y-m-d h:i:s', $list['created_at']) ?></footer>
        </section>
      <?php endforeach ?>
    <?php endif ?>
  </div>
</section>

<script>
  (function () {
    const chat = document.getElementById('chat')
    const url = chat.dataset.url
    // chat.addEventListener('click', ()=> {
    //   const value = document.getElementById('content').value
    //   if (!value) return false
    //
    //   fnList({url, value})
    // }, false)
    
    function fnList({url, value}) {
      axios.post(url, {value}).then(res => {
        console.log(res.data)
      })
      .catch(err => {
      
      })
    }
  })();

</script>