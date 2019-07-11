<?php
namespace frontend\components;

use Yii;
use yii\Base\Widget;
//use yii\helpers\Html;

class TagsCloudWidget extends Widget {
	public $tags;
	public function init() {
		parent::init();
	}
	
	// 标签的大小及颜色
	public function run() {
		$tagString = '';
		$fontStyle = array(
			'6' => 'danger',
			'5' => 'info',
			'4' => 'warning',
			'3' => 'primary',
			'2' => 'success',
		);
		
		foreach($this->tags as $tag => $weight) {
			$url = Yii::$app-> urlManager-> createUrl(['post/index', 'PostSearch[tags]' => $tag]);
			$tagString .= '<a href="'.$url.'">'.
					'<strong class="label label-'.$fontStyle[$weight].'">'. $tag.
					'</strong></a>';
		}
		sleep(3);
		return $tagString;
	}
}











