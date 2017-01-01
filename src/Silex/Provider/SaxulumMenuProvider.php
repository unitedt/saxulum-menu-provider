<?php

namespace Saxulum\MenuProvider\Silex\Provider;

use Saxulum\MenuProvider\Provider\SaxulumMenuProvider as BaseSaxulumMenuProvider;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class SaxulumMenuProvider implements ServiceProviderInterface
{
    /**
     * @param Application $app
     */
    public function register(Container $app)
    {
        $saxulumMenuProvider = new BaseSaxulumMenuProvider();
        $saxulumMenuProvider->register($app);
    }

    /**
     * @param Application $app
     */
    public function boot(Container $app) {}
}
