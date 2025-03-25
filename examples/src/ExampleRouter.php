<?php


declare( strict_types = 1 );


use JDWX\KV\SqliteKV;
use JDWX\Web\Framework\Router;
use JDWX\Web\Login\AuthRoute;
use JDWX\Web\Login\DummyUserManager;
use Routes\ExampleAdminRoute;
use Routes\ExampleApiRoute;
use Routes\ExampleLoginRoute;
use Routes\ExamplePublicRoute;
use Routes\ExampleSignupRoute;
use Routes\ExampleUserRoute;


class ExampleRouter extends Router {


    public function __construct() {
        parent::__construct();
        $kv = new SqliteKV( __DIR__ . '/../tmp/example.tmp' );
        AuthRoute::setManager( new DummyUserManager( $kv ) );
        $this->addRoute( '/', ExamplePublicRoute::class );
        $this->addRoute( '/admin', ExampleAdminRoute::class );
        $this->addRoute( '/api', ExampleApiRoute::class );
        $this->addRoute( '/user', ExampleUserRoute::class );
        $this->addRoute( '/signup', ExampleSignupRoute::class );
        $this->addRoute( '/login', ExampleLoginRoute::class );
    }


}