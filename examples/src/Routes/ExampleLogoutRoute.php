<?php


declare( strict_types = 1 );


namespace Routes;


use ExampleHtmlPage;
use JDWX\Web\Framework\Response;
use JDWX\Web\Framework\ResponseInterface;
use JDWX\Web\Login\Routes\PublicRoute;
use JDWX\Web\Login\RouteTag;


class ExampleLogoutRoute extends PublicRoute {


    protected function handleGET( string $i_stUri, string $i_stPath ) : ?ResponseInterface {
        $page = new ExampleHtmlPage( 'Logout' );
        if ( $this->isLoggedIn() ) {
            $this->managerEx()->logOut( $this->getTokenEx() );
            $page->addContent( '<p>Logged out.</p>' );
        } else {
            $page->addContent( '<p>You are not logged in.</p>' );
        }
        $nstNextUri = $this->getTagUri( RouteTag::AFTER_LOGOUT );
        if ( is_string( $nstNextUri ) ) {
            $page->addContent( "<p><a href=\"{$nstNextUri}\">Go to public page.</a>" );
        }
        return Response::page( $page );
    }


}
