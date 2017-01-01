<?php

namespace Saxulum\MenuProvider\Silex\Provider;

use Saxulum\MenuProvider\Provider\SaxulumMenuProvider as BaseSaxulumMenuProvider;
use Silex\Application;
use Pimple\ServiceProviderInterface;

class SaxulumMenuProvider implements ServiceProviderInterface
{
    /**
     * @param Application $app
     */
    public function register(Application $app)
    {
        $saxulumMenuProvider = new BaseSaxulumMenuProvider();
        $saxulumMenuProvider->register($app);
    }

    /**
     * @param Application $app
     */
    public function boot(Application $app) {}
}
