<?php
namespace frontend\components;

use yii\base\Widget;
use yii\helpers\Html;

class ReplyComment extends Widget {
	public $comments;
	
	// 用来处理数据
	public function init() {
		parent::init();
	}
	
	// run 方法渲染数据
	public function run() {
		// 保存结果
		$commentString = '';
		
		foreach($this -> comments as $item) {
			// echo '<pre>';
			// var_dump($item->post);exit();
      $url = $item -> url ?: '';
      // $name = Html::encode($item -> user -> username);
      $name = Html::encode($item -> post -> title);
      $time = date('Y-m-d H:i', $item-> created_at);
      
      $commentString .= '<section class="post-comment-item">'.
				'<h6 class="title"><a href="'.$url.'">'.nl2br($item -> content) .'</a></h6>'.
				'<p><i class="glyphicon glyphicon-hand-right"></i> '.$name.'</p>'.
        '<span><i class="glyphicon glyphicon-time"></i> '.$time.'</span>
      </section>';
		}
		
		return $commentString;
	}
}














