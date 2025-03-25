<?php


declare( strict_types = 1 );


namespace Shims;


use JDWX\Web\Login\AbstractUserManager;
use JDWX\Web\Login\CredentialsInterface;


class MyUserManager extends AbstractUserManager {


    public static function newTokenPub() : string {
        return self::newToken();
    }


    public function logIn( string $i_stUserId,
                           array  $i_rAuthData = [] ) : CredentialsInterface|string {
        return 'Login incorrect.';
    }


    public function logOut( string $i_stToken ) : void {}


    public function resume( string $i_stToken ) : ?CredentialsInterface {
        return null;
    }


    public function signUp( string $i_stUserId, array $i_rSignUpData = [] ) : true|string {
        return 'Not implemented.';
    }


}