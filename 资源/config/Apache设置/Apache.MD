# Apache 服务器设置

* 修改 Apache的 httpd.conf

```php

1. 开启 apache的mod_rewrite模块去掉 LoadModule rewrite_module modules/mod_rewrite.so 前的 # 号
2. 确保 <Directory "..."></Directory> 中有 AllowOverride All
  AllowOverride在Apache的配置文件出现三次，但是只有一个地方需要 All，其他两个地方都是None

4. frontend & backend/web/.htaccess 文件设置
3. 重启Apache 

```