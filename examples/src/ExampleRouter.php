<?php


declare( strict_types = 1 );


use JDWX\KV\JsonWrapper;
use JDWX\KV\SqliteKV;
use JDWX\Web\Auth\DummyUserManager;
use JDWX\Web\Auth\Router;
use JDWX\Web\Auth\Routes\AuthRoute;
use JDWX\Web\Auth\RouteTag;
use Routes\ExampleAdminRoute;
use Routes\ExampleApiRoute;
use Routes\ExampleLoginRoute;
use Routes\ExampleLogoutRoute;
use Routes\ExamplePublicRoute;
use Routes\ExampleSignupRoute;
use Routes\ExampleUserRoute;


class ExampleRouter extends Router {


    public function __construct() {
        parent::__construct();
        $kv = new JsonWrapper( new SqliteKV( __DIR__ . '/../tmp/example.tmp' ) );
        AuthRoute::setManager( new DummyUserManager( $kv ) );
        $this->addRoute( '/', ExamplePublicRoute::class, RouteTag::AFTER_LOGOUT );
        $this->addRoute( '/admin', ExampleAdminRoute::class );
        $this->addRoute( '/api', ExampleApiRoute::class );
        $this->addRoute( '/user', ExampleUserRoute::class );
        $this->addRoute( '/signup', ExampleSignupRoute::class, RouteTag::SIGNUP );
        $this->addRoute( '/login', ExampleLoginRoute::class, RouteTag::LOGIN );
        $this->addRoute( '/logout', ExampleLogoutRoute::class, RouteTag::LOGOUT );
    }


}