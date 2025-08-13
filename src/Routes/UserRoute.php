<?php


declare( strict_types = 1 );


namespace JDWX\Web\Auth\Routes;


use JDWX\Web\Auth\Level;
use JDWX\Web\Auth\RouteTag;
use JDWX\Web\Framework\Response;
use JDWX\Web\Framework\ResponseInterface;


class UserRoute extends AuthRoute {


    protected const Level REQUIRED_LEVEL = Level::USER;


    /**
     * @param array<string, string|list<string>> $i_rUriParameters
     */
    protected function forbidden( string $i_stUri, string $i_stPath, array $i_rUriParameters ) : ?ResponseInterface {
        $nstLoginUri = $this->getTagUri( RouteTag::LOGIN );
        if ( is_string( $nstLoginUri ) ) {
            return Response::redirectTemporaryWithGet( $nstLoginUri );
        }
        return parent::forbidden( $i_stUri, $i_stPath, $i_rUriParameters );
    }


}