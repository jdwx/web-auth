<?php


declare( strict_types = 1 );


namespace JDWX\Web\tests\Shims;


use JDWX\Web\Login\AbstractUserManager;
use JDWX\Web\Login\CredentialsInterface;


class MyUserManager extends AbstractUserManager {


    public static function newTokenPub() : string {
        return self::newToken();
    }


    public function getCredentialsByToken( string $stToken ) : ?CredentialsInterface {
        return null;
    }


    public function newCredentialsByAuth( string  $i_stUserId, string $i_stPassword,
                                          ?string $i_nstOther = null ) : ?CredentialsInterface {
        return null;
    }


    public function invalidateToken( string $stToken ) : void {
    }


}