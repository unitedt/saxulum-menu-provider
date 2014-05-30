<?php

namespace Saxulum\MenuProvider\Provider;

use Knp\Menu\Matcher\Matcher;
use Knp\Menu\Silex\Voter\RouteVoter;

class SaxulumMenuProvider
{
    public function register(\Pimple $container)
    {
        $container['knp_menu.route.voter'] = $container->share(function (\Pimple $container) {
            $voter = new RouteVoter();
            $voter->setRequest($container['request']);

            return $voter;
        });

        $container['knp_menu.matcher.configure'] = $container->protect(function (Matcher $matcher) use ($container) {
            $matcher->addVoter($container['knp_menu.route.voter']);
        });
    }
}
