NameVirtualHost *
<VirtualHost *>
ServerName files.example.ru
DocumentRoot /www
Options -Indexes
<Directory "/www">
AddDefaultCharset UTF-8
</Directory>
ErrorLog /var/log/apache2/files.log
LogLevel debug
CustomLog /var/log/apache2/files.log combined
ServerSignature On
</VirtualHost>

