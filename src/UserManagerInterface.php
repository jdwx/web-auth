<?php


declare( strict_types = 1 );


namespace JDWX\Web\Login;


interface UserManagerInterface {


    public function getCredentialsByToken( string $stToken ) : ?CredentialsInterface;


    public function newCredentialsByAuth( string  $i_stUserId, string $i_stPassword,
                                          ?string $i_nstOther = null ) : ?CredentialsInterface;


    public function invalidateToken( string $stToken ) : void;


}