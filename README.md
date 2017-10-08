# testCompaneoSilex
Test Would-You-REST avec le framework Silex

Installation: 
Exécuter "composer install" depuis la console.

La configuration à la base de données se trouve dans app/config/dev.php

httpd.conf:

`<VirtualHost *:80>
    DocumentRoot "E:\www\WouldYouRestSilex\web"
    ServerName WouldYouRestSilex
    <Directory "E:\www\WouldYouRestSilex\web">
        Options Indexes MultiViews FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>`