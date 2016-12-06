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

In terminal:

```sh
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
