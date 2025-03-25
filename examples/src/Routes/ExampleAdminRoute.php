<?php


declare( strict_types = 1 );


namespace Routes;


use ExampleHtmlPage;
use JDWX\Web\Framework\Response;
use JDWX\Web\Framework\ResponseInterface;
use JDWX\Web\Login\Routes\AdminRoute;


class ExampleAdminRoute extends AdminRoute {


    protected function handleGET( string $i_stUri, string $i_stPath ) : ?ResponseInterface {
        return Response::page( new ExampleHtmlPage( 'Admin' ) );
    }


}