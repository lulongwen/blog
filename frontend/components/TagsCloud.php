<?php
namespace frontend\components;

use Yii;
use yii\base\Widget;
// use yii\helpers\Html;

class TagsCloud extends Widget {
	public $tags;
	public function init() {
		parent::init();
	}
	
	// 标签的大小及颜色
	public function run() {
		$tagString = '';
		$style = [
      '6' => 'danger',
      '5' => 'info',
      '4' => 'warning',
      '3' => 'primary',
      '2' => 'success',
    ];
		$size = [
      '6' => '20',
      '5' => '13',
      '4' => '16',
      '3' => '24',
      '2' => '18',
    ];
		
		foreach($this->tags as $tag => $weight) {
			$url = Yii::$app-> urlManager
        -> createUrl(['post/index', 'PostSearch[tags]' => $tag]);
			
			$tagString .= '<a href="'.$url.'">'.
					'<strong class="label label-'.$style[$weight].' font-'.$size[$weight].'">'. $tag.
					'</strong></a>';
		}
		sleep(3);
		return $tagString;
	}
}











