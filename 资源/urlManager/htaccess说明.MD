
# 如果是一个目录或者文件，就访问目录或文件
RewriteCond %{REQUEST_FILENAME} !-d

# 如果文件存在，就直接访问文件，不进行下面的RewriteRule
RewriteCond %{REQUEST_FILENAME} !-f

# RewriteRule . index.php




<IfModule mod_rewrite.c> 

RewriteEngine on 

RewriteCond %{REQUEST_URI} !^frontend

RewriteRule ^(.*)$ frontend/$1 [L]

</IfModule>



# prevent directory listings 阿里云虚拟主机 /.htaccess 设置
Options -Indexes

# follow symbolic links
Options FollowSymlinks
RewriteEngine on

RewriteCond %{REQUEST_URI} ^/admin/$
RewriteRule ^(admin)/$ /$1 [R=301,L]

RewriteCond %{REQUEST_URI} ^/admin
RewriteRule ^admin(/.+)?$ /backend/web/$1 [L,PT]

RewriteCond %{REQUEST_URI} ^.*$
RewriteRule ^(.*)$ /frontend/web/$1

