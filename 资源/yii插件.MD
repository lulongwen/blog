# Yii2 博客插件


## composer require
```


```


## composer.json

```
{
	"mludvik/yii2-tags-input": "~1.0"
}

```


## easyWechat SDK 微信开发
```
Laravel
	composer require overtrue/wechat:~4.0 -vvv

Yii
	composer require jianyan74/yii2-easy-wechat
		基于最新的 overtrue/wechat 4.x
		配置文档
		https://github.com/jianyan74/yii2-easy-wechat

easyWechat文档
	https://www.easywechat.com/tutorials

微信开发常见问题
	https://www.easywechat.com/docs/4.1/troubleshooting

```


## tags-input
```
	"mludvik/yii2-tags-input": "~1.0"

	composer require mludvik/yii2-tags-input:"~1.0"
	php composer.phar require mludvik/yii2-tags-input:"~1.0"

	https://www.yiiframework.com/extension/mludvik/yii2-tags-input


	<?php use mludvik\tagsinput\TagsInputWidget; ?>
	<?= $form->field($model, 'tags')->widget(TagsInputWidget::className()) ?>

```