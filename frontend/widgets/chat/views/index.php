<?php
  /**
   * Created by PhpStorm.
   * User: lulongwen
   * Date: 2019-06-03
   * Time: 21:20
   */
  use yii\helpers\Url;

?>
<style>
  header.panel-body {
    position: relative;
    margin: 0;
    padding: 10px;
    font-size: 14px;
    background-color: #d6e9c6;
  }
  header.panel-body small {
    position: absolute;
    top: 12px;
    right: 10px;
  }
  
  nav.chat {
    position: relative;
    padding-right: 53px;
    margin-bottom: 16px;
  }
  nav.chat .form-control {
    border-radius: 4px 0 0 4px;
  }
  nav.chat .btn {
    position: absolute;
    top: 0;
    right: 0;
    border-radius: 0 4px 4px 0;
  }
  
  .chat-list {
    margin-bottom: 16px;
    padding-left: 45px;
    position: relative;
  }
  .chat-list:last-child {
    margin-bottom: 0;
  }
  .chat-list h6 {
    margin: 5px 0;
  }
  .chat-list .img {
    position: absolute;
    top: 0;
    left: 0;
    width: 40px;
  }
</style>

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
            src="<?= ($list['user']['avatar'] ?: '/Blog/frontend/web/images/default/avatar.png') ?>">
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
    chat.addEventListener('click', ()=> {
      const value = document.getElementById('content').value
      if (!value) return false
      
      fnList({url, value})
    }, false)
    
    function fnList({url, value}) {
      axios.post(url, {value}).then(res => {
        console.log(res.data)
      })
      .catch(err => {
      
      })
    }
  })();

</script>



















