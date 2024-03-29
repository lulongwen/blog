# Yii 博客项目知识点

1. Yii核心思想
  * 快速开发
  * 避免重复劳动，提升代码重用可扩展，使用 Gii快速生成代码
  * 数据库改变，如何用 Gii生成代码

2. 扩展的使用
  * 编辑器扩展
  * 图片上传扩展
  * 标签的扩展
  
3. Yii框架的应用
  * 场景应用，事件，rule规则，挂件等
  * ActiveRecord 和 Model
  * Yii2 注册登录及完整的前台功能
  * Yii2 框架的基础配置和数据库配置



## 博客流程
```
1 项目启动
2 初期原型
3 日志管理
4 文章管理
5 评论管理
6 组件化
	用户菜单
	标签云
	最新评论
	列表组件
	
7 细节优化
	URL美化
	错误日志
	项目部署

8 版本迭代
	SAAS会员模块
```



## 博客功能分析
```
前台项目
	用户登录
		注册先不开放，后期可以做个会员，注册会员可以登录，发表文章
		会员表
	发表文章
	留言
	
	文章首页，列表页，详情页
	tags 标签云

后台项目
	内容管理
		分类管理
		文章管理
		文章审核

	系统设置
		菜单
		路由
	
	权限设置
		权限
		角色
		授权
	
	账户管理
		管理员
		会员
		审核文章

	统计
```



## 1 Yii2 框架的基础配置
1. Yii2 的安装
2. 创建和配置数据库
3. 路由配置
4. 配置语言包
5. 独立的前后台用户表

```
yii migration
	数据库自动新增 user 和 migration表

	链接数据库很慢
	把数据库默认的 localhost 改为127.0.0.1, 速度马上就正常了
	
// 设置 id 自动增长序号
  alter table comment AUTO_INCREMENT=9;

```



## 2 博客系统前台

1. 前台UI界面
2. 前台用户注册登录
	* 注册添加验证码和重复密码验证
3. 数据库表的设计
4. 文章控制器和模型
	* 创建文章表单页面
	* 分类下拉选择
	* 添加标签功能，select2
	* 富文本编辑器
	* 上传文章缩略图

5. 定义场景与创建文章逻辑
	* create方法实现
	* update方法实现
	
6. 文章详情表
	* 文章统计
7. 文章列表
	* 列表组件
	* 侧边栏组件
8. 博客首页
	* 图片轮播效果
	* 热门浏览
	* 留言板
	* 标签云
```

```


## 3 博客系统后台

1. 后台管理员登录
2. 后台整体布局
3. 会员管理
4. 文章评论审核
5. 优化CMS系统
```

```


## Gii工具的使用

```
	ActiveRecord 关联数据库的表，数据的增删查改
	增删查改都是后台的功能，放在 backend models 里面

Gii CRUD
	使用 Gii backend/web/index.php?r=gii

	Model Class
		common\models\Post

	Search Model Class
		common\models\PostSearch

	Controller Class
		common\controllers\PostController

	View Path
		@app/views/post

```











