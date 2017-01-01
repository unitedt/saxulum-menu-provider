<?php

namespace Saxulum\MenuProvider\Provider;

use Pimple\Container;
use Knp\Menu\Matcher\Matcher;
use Knp\Menu\Matcher\Voter\RouteVoter;

class SaxulumMenuProvider
{
    public function register(Container $container)
    {
        $container['knp_menu.route.voter'] = function (Container $container) {
            $voter = new RouteVoter();
            $voter->setRequest($container['request_stack']->getCurrentRequest());

            return $voter;
        };

        $container['knp_menu.matcher.configure'] = $container->protect(function (Matcher $matcher) use ($container) {
            $matcher->addVoter($container['knp_menu.route.voter']);
        });
    }
}
