<?php


declare( strict_types = 1 );


namespace Routes;


use JDWX\Web\Framework\Response;
use JDWX\Web\Framework\ResponseInterface;
use JDWX\Web\Login\ApiRoute;


class ExampleApiRoute extends ApiRoute {


    protected function handleGET( string $i_stUri, string $i_stPath ) : ?ResponseInterface {
        return Response::json( [ 'message' => 'API Route' ] );
    }


}