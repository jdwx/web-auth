<?php


declare( strict_types = 1 );


namespace JDWX\Web\Login;


/**
 * Please do not use this class in production.
 */
class DummyCredentials extends AbstractCredentials {


    private readonly Level $level;


    public function __construct( private readonly ?string $nstUserId = null,
                                 private readonly ?string $nstToken = null,
                                 Level|int                $level = Level::PUBLIC ) {
        $this->level = $level instanceof Level ? $level : Level::from( $level );
    }


    public function aaa( string $i_stMethod, string $i_stUri, string $i_stPath ) : string|true {
        return true;
    }


    public function getExpirationTime() : int {
        return 2 ** 31 - 1;
    }


    public function getLevel() : Level {
        return $this->level;
    }


    public function getToken() : ?string {
        return $this->nstToken;
    }


    public function getUserId() : ?string {
        return $this->nstUserId;
    }


    public function isLoggedIn() : bool {
        return $this->level->isAbove( Level::PUBLIC );
    }


}