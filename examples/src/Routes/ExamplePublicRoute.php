<?php


declare( strict_types = 1 );


namespace Routes;


use ExampleHtmlPage;
use JDWX\Web\Auth\Routes\PublicRoute;
use JDWX\Web\Framework\Response;
use JDWX\Web\Framework\ResponseInterface;


class ExamplePublicRoute extends PublicRoute {


    protected function handleGET( string $i_stUri, string $i_stPath ) : ?ResponseInterface {
        return Response::page( new ExampleHtmlPage( 'Public' ) );
    }


}