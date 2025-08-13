<?php


declare( strict_types = 1 );


namespace Routes;


use ExampleHtmlPage;
use JDWX\Web\Auth\Routes\UserRoute;
use JDWX\Web\Framework\Response;
use JDWX\Web\Framework\ResponseInterface;


class ExampleUserRoute extends UserRoute {


    protected function handleGET( string $i_stUri, string $i_stPath, array $i_rUriParameters ) : ?ResponseInterface {
        $page = new ExampleHtmlPage( 'User' );
        $page->addContent(
            '<p>Welcome, ' . $this->findBestUserId() . '.</p>'
            . '<p><a href="/logout">Logout</a></p>'
        );

        return Response::page( $page );
    }


}