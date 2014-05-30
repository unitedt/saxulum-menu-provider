saxulum-menu-provider
=====================

[![Build Status](https://api.travis-ci.org/saxulum/saxulum-menu-provider.png?branch=master)](https://travis-ci.org/saxulum/saxulum-menu-provider)
[![Total Downloads](https://poser.pugx.org/saxulum/saxulum-menu-provider/downloads.png)](https://packagist.org/packages/saxulum/saxulum-menu-provider)
[![Latest Stable Version](https://poser.pugx.org/saxulum/saxulum-menu-provider/v/stable.png)](https://packagist.org/packages/saxulum/saxulum-menu-provider)

Features
--------

* Register the request voter on [knp-menu][1]

Requirements
------------

 * PHP 5.3+
 * KnpMenu ~2.0
 * Symfony Http Foundation ~2.3

Installation
------------

Through [Composer](http://getcomposer.org) as [saxulum/saxulum-menu-provider][1].

```{.php}
use Knp\Menu\Silex\KnpMenuServiceProvider;
use Saxulum\MenuProvider\Silex\Provider\SaxulumMenuProvider;

$app->register(new KnpMenuServiceProvider());
$app->register(new SaxulumMenuProvider());
```

Copyright
---------
* Dominik Zogg <dominik.zogg@gmail.com>

[1]: https://github.com/KnpLabs/KnpMenu
[2]: https://packagist.org/packages/saxulum/saxulum-menu-provider