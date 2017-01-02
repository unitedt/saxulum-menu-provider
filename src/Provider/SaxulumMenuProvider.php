<?php

namespace Saxulum\MenuProvider\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Silex\Application;
use Silex\Api\BootableProviderInterface;
use Knp\Menu\Matcher\Matcher;
use Knp\Menu\Matcher\Voter\RouteVoter;

class SaxulumMenuProvider implements ServiceProviderInterface, BootableProviderInterface
{
    public function register(Container $container)
    {
//         $container['knp_menu.route.voter'] = function (Container $container) {
//             $voter = new RouteVoter();
//             $voter->setRequest($container['request_stack']->getCurrentRequest());

//             return $voter;
//         };

//         $container['knp_menu.matcher.configure'] = $container->protect(function (Matcher $matcher) use ($container) {
//             $matcher->addVoter($container['knp_menu.route.voter']);
//         });
    }
    
    public function boot(Application $app)
    {
    	$app['knp_menu.route.voter'] = function (Application $app) {
    		$voter = new RouteVoter();
    		$voter->setRequest($app['request_stack']->getCurrentRequest());
    	
    		return $voter;
    	};
    	
    	$app['knp_menu.matcher.configure'] = $app->protect(function (Matcher $matcher) use ($app) {
    		$matcher->addVoter($app['knp_menu.route.voter']);
    	});
    }
}
