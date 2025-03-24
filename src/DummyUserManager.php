<?php


declare( strict_types = 1 );


namespace JDWX\Web\Login;


use stdClass;


class DummyUserManager extends AbstractUserManager {


    private array $rUsers = [];


    public function __construct( private readonly string $stStorageDir ) {
        // Do nothing.
    }


    public function addUser( string $i_stUserId, string $i_stPassword, int $i_uLevel ) : void {
        $x = new stdClass();
        $x->stPassword = $i_stPassword;
        $x->uLevel = $i_uLevel;
        $this->rUsers[ $i_stUserId ] = $x;
    }


    public function invalidateToken( string $stToken ) : void {
        // Do nothing.
    }


    public function newCredentialsByAuth( string  $i_stUserId, string $i_stPassword,
                                          ?string $i_nstOther = null ) : ?CredentialsInterface {
        if ( ! isset( $this->rUsers[ $i_stUserId ] ) ) {
            return null;
        }
        if ( $i_stPassword !== $this->rUsers[ $i_stUserId ] ) {
            return null;
        }

    }


}