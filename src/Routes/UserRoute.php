<?php


declare( strict_types = 1 );


namespace JDWX\Web\Auth\Routes;


use JDWX\Web\Auth\Level;
use JDWX\Web\Auth\RouteTag;
use JDWX\Web\Framework\Response;
use JDWX\Web\Framework\ResponseInterface;


class UserRoute extends AuthRoute {


    protected const Level REQUIRED_LEVEL = Level::USER;


    protected function handleGET( string $i_stUri, string $i_stPath, array $i_rUriParameters ) : ?ResponseInterface {
        if ( $this->isLoggedIn() ) {
            return $this->loggedInGet( $i_stUri, $i_stPath, $i_rUriParameters );
        }
        return $this->loggedOutGet( $i_stUri, $i_stPath, $i_rUriParameters );
    }


    /**
     * @param array<string, string|list<string>> $i_rUriParameters
     * @noinspection PhpUnusedParameterInspection
     */
    protected function loggedInGet( string $i_stUri, string $i_stPath, array $i_rUriParameters ) : ?ResponseInterface {
        return parent::handleGET( $i_stUri, $i_stPath, $i_rUriParameters );
    }


    /**
     * @param array<string, string|list<string>> $i_rUriParameters
     * @noinspection PhpUnusedParameterInspection
     */
    protected function loggedOutGet( string $i_stUri, string $i_stPath, array $i_rUriParameters ) : ?ResponseInterface {
        $nstLoginUri = $this->getTagUri( RouteTag::LOGIN );
        if ( is_string( $nstLoginUri ) ) {
            return Response::redirectTemporaryWithGet( $nstLoginUri );
        }
        $this->forbidden( $i_stUri, $i_stPath );
    }


}