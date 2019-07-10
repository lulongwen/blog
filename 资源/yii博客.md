# Yii2 博客的基础配置
1. Yii2 的安装和配置
  * composer 安装 Advanced模板
  * 创建和配置数据库
  * 路由配置
  * 配置语言包
  * params.php 默认参数配置

2. 本地虚拟主机的配置
3. 独立的前后台用户表
4. Gii 快速生成博客原型代码
  * Controller
  * Model
  * CRUD

5. 场景和事件的应用



## 博客设计思路
* 独立的用户系统，前后台用户隔离分开，相互不影响，认证不同，相互之间没有关联
  * 数据库分表处理，前台一个用户表，后台一个用户表
* 公共的部分放在 common目录里面
* 前台模块 frontend & 后台模块 backend


## 项目插件
```
EasyWeChat 开源的 微信SDK, 非官方
  https://www.easywechat.com/docs/4.1/overview

  composer require abei2017/yii2-mini-program
  composer require "abei2017/yii2-wx" -vvv


```




## Yii2 博客基础配置代码
```
composer 设置中文镜像
	composer config -g repo.packagist composer https://packagist.phpcomposer.com

删除镜像
	composer config -g --unset repos.packagist
  执行之后，composer 会利用默认值（也就是官方源）重置源地址

```



## Yii2 知识点
```
ActiveRecord 活动记录 AR类
  yii2的灵魂，将数据库和模型建立起了联系
	可以像 访问对象一样，访问到数据库的关联字段

QueryBuilder

DataProvider 数据提供者

小部件
	DetailView
	ListView
	GridView


application 要结合上下文来理解
	\Yii::$app


Controller
	yii\web\controller

Model
	yii\base\Model

Model的2种模型
  表单模型对应
	* 表单模型映射的是一个表单，比如，重复密码这个功能在表单里面有，在数据库里面就没有在这个字段

  数据模型
	* 映射的是数据表的结构


/common 
  前后台公用的 Controller & Model


入口脚本index.php 创建应用主体
	Yii::$app
  
layouts.php	布局文件用来解决页面相同部分的

```



## Yii 博客进度
1. 项目启动
2. 初期原型
3. 日志管理
4. 文章管理
5. 评论管理
6. 组件化
	* 用户菜单
	* 标签云
	* 最新评论
	* 列表组件
7. 细节优化
	* URL美化
	* 错误日志
	* 项目部署

8. 版本迭代
	SAAS会员模块



3. 文章功能
  * 文章查看
  * 文章修改和新增功能
  * 文章列表页管理功能
  * 文章的统计功能

4. 管理功能
  * 评论的查看和修改
  * 评论的列表页管理
  * 评论的审核

5. 前台会员的认证和管理
6. 后台管理员管理功能
7. RBCA权限控制

8. 前台页面的搭建
  * 首页
  * 标签云
  * 最新回复组件

9. 文章展示页面
  * 文章详情页

10. 控制台命令程序
  * 定时执行任务

11. URL美化
12. 缓存功能