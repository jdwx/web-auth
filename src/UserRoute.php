<?php


declare( strict_types = 1 );


namespace JDWX\Web\Login;


use JDWX\Web\Framework\Exceptions\ForbiddenException;
use JDWX\Web\Framework\ResponseInterface;


class UserRoute extends AuthRoute {


    public function handle( string $i_stUri, string $i_stPath ) : ?ResponseInterface {
        if ( ! $this->isUserOrHigher() ) {
            throw new ForbiddenException();
        }
        if ( ! $this->allowAccess( $this->method(), $i_stUri, $i_stPath ) ) {
            throw new ForbiddenException();
        }
        return parent::handle( $i_stUri, $i_stPath );
    }


}