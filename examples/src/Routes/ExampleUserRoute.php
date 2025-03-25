<?php


declare( strict_types = 1 );


namespace Routes;


use ExampleHtmlPage;
use JDWX\Web\Framework\Response;
use JDWX\Web\Framework\ResponseInterface;
use JDWX\Web\Login\Routes\UserRoute;


class ExampleUserRoute extends UserRoute {


    protected function handleGET( string $i_stUri, string $i_stPath ) : ?ResponseInterface {
        $page = new ExampleHtmlPage( 'User' );
        $page->addContent(
            '<p>Welcome, ' . $this->findBestUserId() . '.</p>'
            . '<p><a href="/logout">Logout</a></p>'
        );

        return Response::page( $page );
    }


}