<?php

namespace Saxulum\Tests\MenuProvider\Silex\Provider;

use Knp\Menu\MenuFactory;
use Knp\Menu\Integration\Silex\KnpMenuServiceProvider;
use Knp\Menu\Matcher\Voter\RouteVoter;
use Saxulum\MenuProvider\Silex\Provider\SaxulumMenuProvider;
use Silex\Application;
use Silex\Provider\UrlGeneratorServiceProvider;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SaxulumMenuProviderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider provideData
     */
    public function testRequestVoter($route, array $parameters, $itemRoute, array $itemRouteParameters, $expected)
    {
        $app = $this->createApplication();

        $app->get($this->prepareMatch($route, $parameters), function () { return new Response('valid route'); })->bind($route);

        $request = new Request();
        $request->attributes->set('_route', $route);
        $request->attributes->set('_route_params', $parameters);
        $app['request'] = $request;

        /** @var MenuFactory $menuFactory */
        $menuFactory = $app['knp_menu.factory'];
        $menu = $menuFactory->createItem('root');
        $item = $menu->addChild($itemRoute, array(
            'route' => $itemRoute,
            'routeParameters' => $itemRouteParameters
        ));

        /** @var RouteVoter $voter */
        $voter = $app['knp_menu.route.voter'];

        try {
            $this->assertSame($expected, $voter->matchItem($item));
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function createApplication()
    {
        $app = new Application();
        $app['debug'] = true;

        $app->register(new KnpMenuServiceProvider());
        $app->register(new SaxulumMenuProvider());
        $app->register(new UrlGeneratorServiceProvider());

        return $app;
    }

    /**
     * @param  string $route
     * @param  array  $parameters
     * @return string
     */
    protected function prepareMatch($route, array $parameters)
    {
        $return = '/' . $route;

        foreach (array_keys($parameters) as $parameterKey) {
            $return .= '/{' . $parameterKey . '}';
        }

        return $return;
    }

    public function provideData()
    {
        return array(
            'same route' => array('foo', array(), 'foo', array(), true),
            'same route same parameter' => array('foo', array('bar' => '1'), 'foo', array('bar' => '1'), true),
            'same route diffrent parameter' => array('foo', array(), 'foo', array('bar' => '1'), null),
        );
    }
}
