#SlimPower - Example

[![Latest version][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]

An extension to [Slim Framework][1] that allows you use to dynamically
instantiated controllers with action methods wherever you would use a
closure or callback when routing.

The controller can optionally be loaded from Slim's DI container,
allowing you to inject dependencies as required.

Additionally, this extension implements json API's with great ease.

[1]: http://www.slimframework.com/

##Installation

Create folder /var/www/slimpower and download this repository

In terminal:

```sh
    mkdir /var/www/slimpower
    cd /var/www/slimpower
    composer require matiasnamendola/slimpower-slim-example
```

Or you can add use this as your composer.json:

```json
    {
        "require": {
            "slim/slim": "2.*",
            "matiasnamendola/slimpower-slim-example": "dev-master"
        }
    }

```

###.htaccess sample
Here's an .htaccess sample for simple RESTful API's

```
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^ index.php [QSA,L]
```

###Apache VirtualHost

Create conf file '000-slimpower.conf' in folder '/etc/apache2/sites-available'
with this content:

```conf
<VirtualHost *:80>
        ServerAdmin             webmaster@localhost
        ServerName              dev.slimpower.com.ar
        DocumentRoot            /var/www/slimpower
        ErrorLog               /var/log/apache2/slimpower-custom-error.log
        CustomLog              /var/log/apache2/slimpower-custom.log common
        #TransferLog            /var/log/apache2/slimpower-custom.log
        <Directory /var/www/slimpower/>
                Options -Indexes
                AllowOverride AuthConfig FileInfo
                AddOutputFilterByType DEFLATE text/html
                AddOutputFilterByType DEFLATE text/css
                AddOutputFilterByType DEFLATE application/x-javascript
                AddOutputFilterByType DEFLATE image/gif
        </Directory>
        <files "*.conf">
            order allow,deny
            deny from all
        </files>
        <files "*.ini">
            order allow,deny
            deny from all
        </files>
        <files "*.json">
            order allow,deny
            deny from all
        </files>
        <DirectoryMatch "^/.*/(\.svn|CVS)/">
            Order deny,allow
            Deny from all
        </DirectoryMatch>
</VirtualHost>
```

Next, copy this in terminal:

```sh
    sudo a2ensite 000-slimpower
    sudo /etc/init.d/apache2 restart
```

or 

```sh
    sudo a2ensite 000-slimpower
    sudo service apache2 restart
```

##Security

If you discover any security related issues, please email [soporte.esolutions@gmail.com](mailto:soporte.esolutions@gmail.com?subject=[SECURITY] Config Security Issue) instead of using the issue tracker.


##Credits

- [Matías Nahuel Améndola](https://github.com/matiasnamendola)
- [Franco Soto](https://github.com/francosoto)


##License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/MatiasNAmendola/slimpower-slim-example.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/MatiasNAmendola/slimpower-slim-example.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/matiasnamendola/slimpower-slim-example
[link-downloads]: https://packagist.org/packages/matiasnamendola/slimpower-slim-example

##Project

Look at [slimpower-slim](https://github.com/matiasnamendola/slimpower-slim).
