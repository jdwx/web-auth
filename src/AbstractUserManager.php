<?php


declare( strict_types = 1 );


namespace JDWX\Web\Login;


abstract class AbstractUserManager implements UserManagerInterface {


    /**
     * This returns a cryptographically strong random string
     * of 180 characters with 1,080 bits on entropy, suitable
     * for use as a token. Having this here within easy reach
     * avoids "I'll just ad-hoc something for now and fix
     * it later" syndrome.
     */
    protected static function newToken() : string {
        return base64_encode( random_bytes( 135 ) );
    }


}