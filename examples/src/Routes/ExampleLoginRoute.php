<?php


declare( strict_types = 1 );


namespace Routes;


use ExampleHtmlPage;
use JDWX\Web\Framework\Response;
use JDWX\Web\Framework\ResponseInterface;
use JDWX\Web\Login\LoginRoute;


class ExampleLoginRoute extends LoginRoute {


    protected function handleGET( string $i_stUri, string $i_stPath ) : ?ResponseInterface {
        $page = new ExampleHtmlPage( 'Login' );
        $page->addContent( "This is the login page." );
        return Response::page( $page );
    }


}