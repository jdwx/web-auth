<?php


declare( strict_types = 1 );


namespace Routes;


use ExampleHtmlPage;
use JDWX\Web\Auth\Routes\AdminRoute;
use JDWX\Web\Framework\Response;
use JDWX\Web\Framework\ResponseInterface;


class ExampleAdminRoute extends AdminRoute {


    protected function handleGET( string $i_stUri, string $i_stPath ) : ?ResponseInterface {
        return Response::page( new ExampleHtmlPage( 'Admin' ) );
    }


}