<?php


declare( strict_types = 1 );


namespace JDWX\Web\Login;


use RuntimeException;


abstract class AbstractCredentials implements CredentialsInterface {


    public function getTokenEx() : string {
        $nst = $this->getToken();
        if ( is_string( $nst ) ) {
            return $nst;
        }
        throw new RuntimeException( 'Required token not found' );
    }


    public function getUserIdEx() : string {
        $nst = $this->getUserId();
        if ( is_string( $nst ) ) {
            return $nst;
        }
        throw new RuntimeException( 'Required user ID not found' );
    }


}