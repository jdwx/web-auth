<?php


declare( strict_types = 1 );


namespace JDWX\Web\Login\Routes;


use JDWX\Web\Framework\Response;
use JDWX\Web\Framework\ResponseInterface;
use JDWX\Web\Login\Level;
use JDWX\Web\Login\RouteTag;


class UserRoute extends AuthRoute {


    protected const Level REQUIRED_LEVEL = Level::USER;


    protected function handleGET( string $i_stUri, string $i_stPath ) : ?ResponseInterface {
        if ( $this->isLoggedIn() ) {
            return $this->loggedInGet( $i_stUri, $i_stPath );
        }
        return $this->loggedOutGet( $i_stUri, $i_stPath );
    }


    protected function loggedInGet( string $i_stUri, string $i_stPath ) : ?ResponseInterface {
        return parent::handleGET( $i_stUri, $i_stPath );
    }


    protected function loggedOutGet( string $i_stUri, string $i_stPath ) : ?ResponseInterface {
        $nstLoginUri = $this->getTagUri( RouteTag::LOGIN );
        if ( is_string( $nstLoginUri ) ) {
            return Response::redirectTemporaryWithGet( $nstLoginUri );
        }
        $this->forbidden( $i_stUri, $i_stPath );
    }


}