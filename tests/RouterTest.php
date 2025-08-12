<?php


declare( strict_types = 1 );


use JDWX\Web\Auth\Router;
use JDWX\Web\Auth\Routes\AuthRoute;
use JDWX\Web\Auth\RouteTag;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;


#[CoversClass( Router::class )]
final class RouterTest extends TestCase {


    public function testAddRoute() : void {
        $router = new class() extends Router {


            public function __construct() {
                parent::__construct();
                $this->addRoute( '/test', AuthRoute::class, RouteTag::LOGIN );
            }


        };
        self::assertSame( '/test', $router->getTagUri( RouteTag::LOGIN ) );
        self::assertNull( $router->getTagUri( RouteTag::LOGOUT ) );
    }


}
