# Yii高级版 虚拟主机设置

* Advanced和 basic 的区别就是分离了前后台 分别是 /backend目录和 /frontend目录
* 公用的比如 Model存放在Common目录
* Advanced版本适用于比较复杂大型的项目用于彻底分离开前后台业务逻辑，访问前后台就相当于访问两个不同的应用

* Yii2隐藏frontend/web和backend/web的方法
  1. /.htaccess 文件设置
  2. /common/components/Request.php 创建文件
  3. frontend & backend/config/main.php 设置
  4. frontend & backend/web/.htaccess 设置


## 1 根目录 .htaccess 文件

```bash

Options +FollowSymlinks
RewriteEngine On

# deal with admin first
RewriteCond %{REQUEST_URI} ^/(admin)

RewriteRule ^admin/assets/(.*)$ backend/web/assets/$1 [L]
RewriteRule ^admin/css/(.*)$ backend/web/css/$1 [L]
RewriteCond %{REQUEST_URI} !^/backend/web/(assets|css)/

RewriteCond %{REQUEST_URI} ^/(admin)
RewriteRule ^.*$ backend/web/index.php [L]


RewriteCond %{REQUEST_URI} ^/(assets|css)
RewriteRule ^assets/(.*)$ frontend/web/assets/$1 [L]
RewriteRule ^css/(.*)$ frontend/web/css/$1 [L]

RewriteCond %{REQUEST_URI} !^/(frontend|backend)/web/(assets|css)/
RewriteCond %{REQUEST_URI} !index.php

RewriteCond %{REQUEST_FILENAME} !-f [OR]
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^.*$ frontend/web/index.php 

```

* 根目录设置好 htaccess文件后，要在 frontend/config/main.php 开启 urlManager设置伪静态
```php

'urlManager' => [
  //是否美化url
  'enablePrettyUrl' => true,
  //是否隐藏入口文件index.php
  'showScriptName' => false,
  //url后缀
  'suffix' => '.shtml',
  'rules' => [
    '/' => 'site/index'
  ],
],
```



## 2 /common/ 目录新建 components/Request.php

* 用 ^/ 代替 ^/frontend/web/ 目录，需要在 /common 目录下，新建 components/Requset.php
* 例如 www.lulongwen.com/index.php，代替 www.lulongwen.com/frontend/web/index.php  

```php

namespace common\components;

class Request extends \yii\web\Request {
  public $web;
  public $adminUrl;

  public function getBaseUrl(){
    return str_replace($this->web, "", parent::getBaseUrl()) . $this->adminUrl;
  }

  /*
    如果没有这个函数，/admin 访问 404
    If you don't have this function, the admin site will 404 if you leave off 
    the trailing slash.
    E.g.:
    Wouldn't work: site.com/admin
    Would work: site.com/admin/
    Using this function, both will work.
  */
  public function resolvePathInfo(){
    if($this->getUrl() === $this->adminUrl){
      return "";
    }
    else{
      return parent::resolvePathInfo();
    }
  }
} 

```


## 3 frontend/config/main.php

```php

//frontend, under components array
'request'=>[
  'class' => 'common\components\Request',
  'web'=> '/frontend/web'
],
'urlManager' => [
    'enablePrettyUrl' => true,
    'showScriptName' => false,
],

```




## 4 backend/config/main.php 

```php

// backend, under components array
'request'=>[
  'class' => 'common\components\Request',
  'web'=> '/backend/web',
  'adminUrl' => '/admin'
],
'urlManager' => [
    'enablePrettyUrl' => true,
    'showScriptName' => false,
],

```



## frontend/web/ & backend/web/ 目录下，.htaccess 配置

```bash

RewriteEngine On 
RewriteCond %{REQUEST_FILENAME} !-f 
RewriteCond %{REQUEST_FILENAME} !-d 
RewriteRule ^(.*)$ /index.php?/$1 [L] 

```


## 访问目录

```php

前台
  www.lulongwen.com

后台
  www.lulongwen.com/admin
```