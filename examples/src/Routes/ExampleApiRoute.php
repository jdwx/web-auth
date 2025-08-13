<?php


declare( strict_types = 1 );


namespace Routes;


use JDWX\Web\Auth\Routes\AuthRoute;
use JDWX\Web\Framework\Response;
use JDWX\Web\Framework\ResponseInterface;


class ExampleApiRoute extends AuthRoute {


    protected function handleGET( string $i_stUri, string $i_stPath, array $i_rUriParameters ) : ?ResponseInterface {
        return Response::json( [ 'message' => 'API Route' ] );
    }


}