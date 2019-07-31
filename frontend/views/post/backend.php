<?php
/**
 * Created by PhpStorm.
 * User: lulongwen
 * Date: 2019-07-26
 * Time: 08:26
 */

use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;

$this-> title = '后端开发'
?>


<div class="row">
	<div class="col-md-6">
		<img class="thumbnail" src="http://placehold.it/550x310">
	</div>
	<div class="col-md-6">
		<h3>WEB前端开发工具包</h3>
		<p>Chrome 、sublime（dreamweaver、atom）、nodejs、git 、gulp 、less &Sass (css预处理)</p>
		<p><mark>移动端</mark> Android Jdk（hybridAPP）前端的用户体验却给了用户直观的印象</p>
		<p>网站重构的目的仅仅是为了让网页更符合Web标准吗？不是！重构的本质是构建一个前端灵活的类MVC框架，即HTML作为信息模型（Model），CSS控制样式（View），JavaScript负责调度数据和实现某种展现逻辑（Controller）。同时，代码需要具有很好的复用性和可维护性。这是高效率、高质量开发以及协作开发的基础。</p>
	
		<div class="btn-group">
			<button class="btn btn-info">PHP</button>
			<button class="btn btn-info">MySQL</button>
			<button class="btn btn-info">Redis</button>
			<button class="btn btn-danger">ElasticSearch</button>
			<button class="btn btn-info">Kafka</button>
			<button class="btn btn-info">MongoDB</button>
			<button class="btn btn-wanring">Golang</button>
		</div>
	</div>

	<div class="col-md-12">
		<ol class="breadcrumb">
      <li>
        <a href="<?= Yii ::$app -> homeUrl ?>">珑文</a>
      </li>
      <li>
        <a href="<?= Url ::to(['post/index']) ?>">全栈开发</a>
      </li>
      <li><?= $this-> title ?></li>
    </ol>
	</div>
</div>


