<?php
namespace frontend\components;

use yii\base\Widget;
use yii\helpers\Html;

class RecentWidget extends Widget {
	public $recentComments;
	
	// 用来处理数据
	public function init() {
		parent::init();
	}
	
	// run 方法渲染数据
	public function run() {
		// 保存结果
		$commentString = '';
		
		foreach($this -> recentComments as $comment) {
			//echo '<pre>';
			//var_dump($comment);exit();
			
			$commentString .= '<section class="post">'.
				'<h6 class="title">'.nl2br($comment -> content) .'</h6>'.
				//'<p>'.Html::encode($comment -> user -> user_name).'</p>'.
				'<a href=".$comment -> post -> url.">'
					.date('Y-m-d H:i', $comment-> create_time).'</a><hr></section>';
		}
		
		return $commentString;
	}
}














